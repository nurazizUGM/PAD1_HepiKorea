<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $paymentService;
    public function __construct()
    {
        $this->paymentService = App::make('paymentService');

        // mark order as cancelled if payment expired
        $orders = Order::where('status', 'unpaid')->with('orderPayment')->get();
        foreach ($orders as $order) {
            $payment = $order->orderPayment->first();
            if ($payment && $payment->status == 'pending' && $payment->expired_at < Carbon::now()) {
                $order->status = 'cancelled';
                $order->save();

                OrderLog::create([
                    'order_id' => $order->id,
                    'status' => 'cancelled',
                    'description' => 'Order cancelled due to payment expired',
                ]);
            }
        }
    }

    // checkout page
    public function checkout(Request $request)
    {
        $data = $request->validate([
            'products' => 'required|array|exists:products,id',
            'quantity' => 'required|array|min:1',
        ]);

        $items = [];
        for ($i = 0; $i < count($data['products']); $i++) {
            $items[] = [
                'productId' => $data['products'][$i],
                'quantity' => $data['quantity'][$i],
            ];
        }

        $order = $this->calculateTotal($items);
        foreach ($order['items'] as $item) {
            $item->product->load('images');
            $item->product->image = $item->product->images->first();
            if ($item->product->image) {
                $item->product->image = $item->product->image->path;
            }
        }
        return view('customer.order.checkout', $order);
    }

    // calculate total price of the order
    public function calculateTotal($data)
    {
        $total = 0;
        $items = [];
        foreach ($data as $item) {
            $product = Product::find($item['productId']);
            $total += $product->price * $item['quantity'];
            $items[] = (object)[
                'product' => $product,
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity'],
            ];
        }

        return [
            'total' => $total,
            'items' => $items,
        ];
    }

    // custom request order
    public function requestOrder(Request $request)
    {
        DB::beginTransaction();
        $data = $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.url' => 'required|url',
            'items.*.description' => 'required|string',
            'items.*.image' => 'nullable|image'
        ]);

        if (Auth::check()) {
            $user = User::find(Auth::id());
        } else {
            // create a guest user
            $user = User::create([
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'role' => Role::GUEST
            ]);
            Auth::login($user);
        };

        $order = $user->orders()->create([
            'type' => 'custom',
            'status' => 'unconfirmed',
            'total_items_price' => 0,
        ]);

        foreach ($data['items'] as $item) {
            if ($item['image']) {
                $item['image'] = $item['image']->store('orders');
            }

            $order->customOrderItems()->create([
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'estimated_price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
                'url' => $item['url'],
                'description' => $item['description'],
                'image' => $item['image'],
            ]);

            $order->total_items_price += $item['price'] * $item['quantity'];
        }

        $order->save();

        DB::commit();
        return redirect()->route('order.history', ['tab' => 'confirmation']);
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        // render page depending on the order type
        if ($order->type == 'custom') {
            $order->load('customOrderItems');
            return view('customer.order.custom', compact('order'));
        } else {
            $order->load(['orderItems', 'orderItems.product', 'orderItems.product.images']);
            return view('customer.order.show', compact('order'));
        }
    }

    // transaction history
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc');
        $confirmation = $orders->clone()->whereIn('status', ['unconfirmed', 'confirmed'])->with(['customOrderItems'])->get();

        $orders->with(['orderItems', 'orderItems.product', 'orderItems.product.images']);
        $unpaid = $orders->clone()->where('status', 'unpaid')->with('orderPayment')->get();
        $processed = $orders->clone()->whereIn('status', ['paid', 'processing'])->get();
        $sent = $orders->clone()->whereIn('status', ['shipment_unpaid', 'shipment_paid', 'sending', 'sent'])->get();
        $finished = $orders->clone()->where('status', 'finished')->get();
        $cancelled = $orders->clone()->where('status', 'cancelled')->get();

        return view('customer.order.history', compact('confirmation', 'unpaid', 'processed', 'sent', 'finished', 'cancelled'));
    }

    // create order
    public function store(Request $request)
    {
        $data = $request->validate([
            'paymentMethod' => 'required|string',
            'items' => 'required|array',
            'items.*.productId' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $user = User::find(Auth::id());
        DB::beginTransaction();

        $total = $this->calculateTotal($data['items']);

        $order = Order::create([
            'user_id' => $user->id,
            'type' => 'order',
            'status' => 'unpaid',
            'total_items_price' => $total['total'],
        ]);

        foreach ($data['items'] as $item) {
            $product = Product::find($item['productId']);
            $order->orderItems()->create([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        $orderPayment = new OrderPayment([
            'order_id' => $order->id,
            'payment_type' => 'items',
            'status' => 'pending',
            'amount' => $total['total'],
        ]);


        $res = $this->paymentService->post('/v2/charge', [
            "payment_type" => "qris",
            "transaction_details" => [
                "gross_amount" => intval($total['total']),
                "order_id" => "hk-" . Carbon::now()->timestamp,
            ],
            "custom_expiry" => [
                "expiry_duration" => 24,
                "unit" => "hour"
            ],
            'qris' => [
                'acquirer' => 'airpay shopee',
                // 'acquirer' => 'gopay',
            ]
        ]);


        $orderPayment->payment_code = $res['actions'][0]['url'];
        $orderPayment->expired_at = Carbon::parse($res['expiry_time']);
        $orderPayment->transaction_id = $res['transaction_id'];
        $orderPayment->save();

        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully',
            'payment' => $orderPayment,
            'response' => $res,
        ]);
    }

    // check payment status
    public function checkPaymentStatus(Request $request)
    {
        $data = $request->validate([
            'paymentId' => 'required|string|exists:order_payments,id',
        ]);

        $payment = OrderPayment::with('order')->find($data['paymentId']);

        $res = $this->paymentService->get("/v2/{$payment->transaction_id}/status");
        if ($res['transaction_status'] == 'settlement') {
            $payment->status = 'success';
            $payment->paid_at = Carbon::now();
            $payment->save();

            $payment->order->status = 'paid';
            $payment->order->save();

            OrderLog::create([
                'order_id' => $payment->order->id,
                'status' => 'paid',
                'description' => 'Order has been paid',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Payment status checked',
            'payment' => $payment,
        ]);
    }

    public function cancel(string $id)
    {
        $order = Order::findOrFail($id);
        if (array_search($order->status, Order::$status) >= array_search('paid', Order::$status)) {
            return redirect()->back()->with('error', 'Order cannot be cancelled');
        }

        $order->status = 'cancelled';
        $order->save();

        OrderLog::create([
            'order_id' => $order->id,
            'status' => 'cancelled',
            'description' => 'Order has been cancelled',
        ]);

        return redirect()->route('order.history', ['tab' => 'cancelled'])->with('success', 'Order has been cancelled');
    }
}
