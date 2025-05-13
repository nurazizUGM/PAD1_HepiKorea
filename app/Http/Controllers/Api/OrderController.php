<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function show(string $id)
    {
        $order = Order::with([
            'orderDetail',
            'orderItems',
            'orderItems.product',
            'orderItems.product.images',
            'orderPayment',
            'orderShipment',
            'reviews',
            'orderLogs',
        ])->findOrFail($id);
        return response()->json($order);
    }

    // transaction history
    public function history(Request $request)
    {
        $status = $request->query('status', 'unpaid');
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc');

        $orders->with(['orderItems', 'orderItems.product', 'orderItems.product.images', 'customOrderItems']);
        if ($status == 'unpaid') {
            $orders->where('status', 'unpaid')->with('orderPayment');
        } else if ($status == 'processed') {
            $orders = $orders->whereIn('status', ['paid', 'processing']);
        } else if ($status == 'sent') {
            $orders->whereIn('status', ['shipment_unpaid', 'shipment_paid', 'sent'])->with('orderShipment');
        } else if ($status == 'finished') {
            $orders->whereIn('status', ['finished', 'cancelled'])
                ->with('reviews')
                ->orderByRaw("FIELD(status, 'finished', 'cancelled')")
                ->orderBy('created_at', 'desc');
        }

        $orders = $orders->get()->each(function ($order) {
            if ($order->type == 'custom') {
                $order->title = $order->customOrderItems->first()?->name;
                $order->image = $order->customOrderItems->first()?->image;
                unset($order->customOrderItems);
                return;
            } else {
                $order->title = $order->orderItems->first()?->product?->name;
                $order->image = $order->orderItems->first()?->product?->images?->first()?->path;
                unset($order->orderItems);
            }
        });

        return response()->json($orders);
    }

    // calculate total price of the order
    public function calculate($data)
    {
        $total = 0;
        $items = [];
        foreach ($data as $item) {
            $product = Product::find($item['productId']);
            $subTotal = $product->price * $item['quantity'];

            $total += $subTotal;
            $items[] = (object)[
                'product' => $product,
                'quantity' => $item['quantity'],
                'total' => $subTotal,
            ];
        }

        return [
            'items' => $items,
            'total' => $total,
        ];
    }

    public function calculateItems(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.productId' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        $result = $this->calculate($data['items']);

        foreach ($result['items'] as $item) {
            $item->product->load('images');
            $item->product->image = $item->product->images->first();
            if ($item->product->image) {
                $item->product->image = $item->product->image->path;
            }
        }

        return response()->json($result);
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'payment_method' => 'required|string|in:qris,bca,bni,bri,mandiri',
            'items' => 'required|array',
            'items.*.productId' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'addressId' => 'required|exists:addresses,id',
        ]);

        $user = User::find(Auth::id());
        $total = $this->calculate($data['items']);

        DB::beginTransaction();
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

        $address = $user->addresses()->find($data['addressId']);

        $order->orderDetail()->create([
            'customer_name' => $address->name ?? $user->fullname,
            'customer_email' => $address->email ?? $user->email,
            'customer_phone' => $address->phone ?? $user->phone,
            'customer_address' => $address->address,
            'province' => $address->province,
            'city' => $address->city,
            'postal_code' => $address->postal_code,
        ]);

        $orderPayment = new OrderPayment([
            'order_id' => $order->id,
            'payment_type' => 'items',
            'status' => 'pending',
            'amount' => $total['total'],
            'payment_method' => $data['payment_method'],
        ]);

        $paymentData = [
            "payment_type" => "qris",
            "transaction_details" => [
                "gross_amount" => intval($total['total']),
                "order_id" => "hk-" . Carbon::now()->timestamp,
            ],
            "custom_expiry" => [
                "expiry_duration" => 24,
                "unit" => "hour"
            ],
        ];

        if ($data['payment_method'] == 'qris') {
            $paymentData['qris'] = [
                'acquirer' => 'airpay shopee',
                // 'acquirer' => 'gopay',
            ];
            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['actions'][0]['url'];
        } else {
            $paymentData["bank_transfer"] = [
                "bank" => $data['payment_method']
            ];

            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['va_numbers'][0]['va_number'];
        }

        $orderPayment->expired_at = Carbon::parse($res['expiry_time']);
        $orderPayment->transaction_id = $res['transaction_id'];
        $orderPayment->save();

        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully',
            'payment' => $orderPayment,
        ]);
    }

    public function paymentStatus($paymentId)
    {
        $payment = OrderPayment::with('order')->find($paymentId);

        if (!$payment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment not found',
            ], 404);
        }

        $res = $this->paymentService->get("/v2/{$payment->transaction_id}/status");
        if ($res['transaction_status'] == 'settlement') {
            $payment->status = 'success';
            $payment->paid_at = Carbon::now();
            $payment->save();

            if ($payment->payment_type == 'shipment') {
                $payment->order->status = 'shipment_paid';
                $payment->order->save();
                OrderLog::create([
                    'order_id' => $payment->order->id,
                    'status' => 'shipment_paid',
                    'description' => 'Shipment has been paid',
                ]);
            } else {
                $payment->order->status = 'paid';
                $payment->order->save();
                OrderLog::create([
                    'order_id' => $payment->order->id,
                    'status' => 'paid',
                    'description' => 'Order has been paid',
                ]);
            }
        }

        return response()->json($payment);
    }

    public function cancel(string $id)
    {
        $order = Order::findOrFail($id);
        if (array_search($order->status, Order::$status) >= array_search('paid', Order::$status)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order cannot be cancelled',
            ], 400);
        }

        $order->status = 'cancelled';
        $order->save();

        OrderLog::create([
            'order_id' => $order->id,
            'status' => 'cancelled',
            'description' => 'Order has been cancelled',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order has been cancelled',
        ]);
    }

    public function payShipment(Request $request, string $orderId)
    {
        $data = $request->validate([
            'payment_method' => 'required|string|in:qris,bca,bni,bri,mandiri',
        ]);

        $order = Order::with(['orderShipment'])->findOrFail($data['orderId']);
        if ($order->status != 'shipment_unpaid') {
            return response()->json([
                'status' => 'error',
                'message' => 'Order cannot be paid',
            ]);
        }

        $orderPayment = new OrderPayment([
            'order_id' => $order->id,
            'payment_type' => 'shipment',
            'status' => 'pending',
            'amount' => $order->orderShipment->price,
            'payment_method' => $data['payment_method'],
        ]);

        $paymentData = [
            "payment_type" => "qris",
            "transaction_details" => [
                "gross_amount" => $order->orderShipment->price,
                "order_id" => "hk-" . Carbon::now()->timestamp,
            ],
            "custom_expiry" => [
                "expiry_duration" => 24,
                "unit" => "hour"
            ]
        ];

        if ($data['payment_method'] == 'qris') {
            $paymentData['qris'] = [
                'acquirer' => 'airpay shopee',
                // 'acquirer' => 'gopay',
            ];
            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['actions'][0]['url'];
        } else {
            $paymentData["bank_transfer"] = [
                "bank" => $data['payment_method']
            ];
            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['va_numbers'][0]['va_number'];
        }

        $orderPayment->expired_at = Carbon::parse($res['expiry_time']);
        $orderPayment->transaction_id = $res['transaction_id'];
        $orderPayment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Shipment has been paid',
            'payment' => $orderPayment,
        ]);
    }

    public function arrived(string $id)
    {

        $order = Order::findOrFail($id);
        if ($order->status != 'sent') {
            return response()->json([
                'status' => 'error',
                'message' => 'Order cannot be marked as arrived',
            ]);
        }

        $order->status = 'finished';
        $order->save();

        OrderLog::create([
            'order_id' => $order->id,
            'status' => 'finished',
            'description' => 'Order has been marked as arrived',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order has been marked as arrived',
        ]);
    }

    public function review(Request $request)
    {
        $userId = Auth::id();
        $data = $request->validate([
            'orderId' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string',
            'photo' => 'nullable|image',
        ]);

        $order = Order::findOrFail($data['orderId']);
        $order->load('orderItems');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('review');
        }

        foreach ($order->orderItems as $item) {
            Review::create([
                'order_id' => $order->id,
                'user_id' => $userId,
                'product_id' => $item->product_id,
                'rating' => $data['rating'],
                'content' => $data['content'] ?? '',
                'photo' => $data['photo'] ?? null,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Review has been submitted',
        ]);
    }
}
