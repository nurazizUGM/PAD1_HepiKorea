<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\CustomOrderItem;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestOrderController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = App::make('paymentService');
    }
    // custom request order
    public function requestOrder(Request $request)
    {
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
            $user = Auth::user();
        } else {
            $user = User::where('email', User::$guestEmail)->first();
        }

        DB::beginTransaction();
        $order = Order::create([
            'user_id' => $user->id,
            'type' => 'custom',
            'status' => 'unconfirmed',
            'total_items_price' => 0,
        ]);

        if (!Auth::check()) {
            $order->orderDetail()->create([
                'customer_name' => $data['fullname'],
                'customer_email' => $data['email'],
            ]);
        }

        foreach ($data['items'] as $item) {
            if (isset($item['image'])) {
                $item['image'] = $item['image']->store('orders');
            } else {
                $item['image'] = null;
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
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully',
            'order' => $order,
        ]);
    }

    public function show(Request $request)
    {
        $data = $request->validate([
            'orderId' => 'nullable|integer|exists:orders,id'
        ]);

        if (!Auth::check() && !isset($data['orderId'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to view the order',
            ]);
        }

        $items = CustomOrderItem::whereHas('order', function ($query) {
            $query->where('type', 'custom')->whereIn('status', ['unconfirmed', 'confirmed']);
        })->with('order');

        if (isset($data['orderId'])) {
            $items->where('order_id', $data['orderId']);
        } else if (Auth::check()) {
            $items->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }

        $items = $items->get()
            ->sortBy(function ($item) {
                return $item->order->status == 'unconfirmed' ? 1 : 0;
            });

        return response()->json($items->values());
    }

    public function getOne(string $itemId)
    {
        $item = CustomOrderItem::with('order')->findOrFail($itemId);
        if ($item->order->status != 'confirmed') {
            return response()->json([
                'status' => 'error',
                'message' => 'Item is not unconfirmed',
            ]);
        }
        return response()->json($item);
    }

    public function checkout(Request $request)
    {
        $user = User::find(Auth::id());
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.productId' => 'required|exists:custom_order_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:qris,bca,bni,bri,mandiri',
            'addressId' => 'integer|exists:addresses,id',
        ]);

        DB::beginTransaction();
        $order = Order::create([
            'user_id' => $user->id,
            'type' => 'custom',
            'status' => 'unpaid',
            'total_items_price' => 0,
            'service_price' => 0,
        ]);

        foreach ($data['items'] as $item) {
            $orderItem = CustomOrderItem::find($item['productId']);
            if (!$orderItem) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Item not found',
                ]);
            } else if ($orderItem->order->status != 'confirmed') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Item is not confirmed',
                ]);
            }

            $orderItem->update([
                'order_id' => $order->id,
                'quantity' => $item['quantity'],
            ]);

            $order->total_items_price += $orderItem->total_price * $item['quantity'];
        }

        $order->save();
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
            'amount' => $order->total_items_price,
            'payment_method' => $data['payment_method'],
        ]);

        $paymentData = [
            "transaction_details" => [
                "gross_amount" => intval($order->total_items_price),
                "order_id" => "hk-" . Carbon::now()->timestamp,
            ],
            "custom_expiry" => [
                "expiry_duration" => 24,
                "unit" => "hour"
            ],
        ];

        if ($data['payment_method'] == 'qris') {
            $paymentData['payment_type'] = 'qris';
            $paymentData['qris'] = [
                'acquirer' => 'airpay shopee',
                // 'acquirer' => 'gopay',
            ];

            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['actions'][0]['url'];
        } else if ($data['payment_method'] == 'mandiri') {
            $paymentData['payment_type'] = 'echannel';
            $paymentData["echannel"] = [
                "bill_info1" => "Payment for hepikorea order",
                "bill_info2" => "Thank you for your purchase!"
            ];

            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['biller_code'] . '-' . $res['bill_key'];
        } else {
            $paymentData['payment_type'] = 'bank_transfer';
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
}
