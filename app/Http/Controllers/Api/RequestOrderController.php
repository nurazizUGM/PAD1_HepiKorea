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
            $query->where('type', 'custom');
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

    public function calculateItems(Request $request)
    {
        $data = $request->validate([
            'itemsId' => 'required|array|exists:custom_order_items,id',
        ]);

        $items = CustomOrderItem::whereIn('id', $data['itemsId']);
        $unconfirmed = $items->clone->whereHas('order', function ($query) {
            $query->where('status', 'unconfirmed');
        })->count();

        if ($unconfirmed > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'There are unconfirmed items in the order',
            ]);
        }

        $items = $items->with('order')->get();
        return  response()->json($items);
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.itemId' => 'required|exists:custom_order_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:qris,bca,bni,bri,mandiri',
        ]);

        DB::beginTransaction();
        $order = Order::create([
            'user_id' => Auth::id(),
            'type' => 'custom',
            'status' => 'unpaid',
            'total_items_price' => 0,
            'service_price' => 0,
        ]);

        $totalPrice = 0;
        foreach ($data['items'] as $item) {
            $orderItem = CustomOrderItem::find($item['itemId']);
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
            $orderItem->quantity -= $item['quantity'];
            $orderItem->order_id = $order->id;
            $orderItem->save();

            $totalPrice += $orderItem->total_price * $item['quantity'];
            if ($orderItem->order->service_price > $order->service_price) {
                $order->service_price = $orderItem->order->service_price;
            }
        }

        $order->total_items_price = $totalPrice;
        $order->save();

        $orderPayment = new OrderPayment([
            'order_id' => $order->id,
            'payment_type' => 'items',
            'status' => 'pending',
            'amount' => $totalPrice,
            'payment_method' => $data['payment_method'],
        ]);


        $paymentData = [
            "payment_type" => "qris",
            "transaction_details" => [
                "gross_amount" => intval($totalPrice),
                "order_id" => "hk-" . Carbon::now()->timestamp,
            ],
            "custom_expiry" => [
                "expiry_duration" => 24,
                "unit" => "hour"
            ]
        ];

        if ($data['payment_method'] == 'qris') {
            $paymentData['qris'] = [
                "acquirer" => "gopay"
            ];
            $res = $this->paymentService->post('/v2/charge', $paymentData);
            $orderPayment->payment_code = $res['actions'][0]['url'];
        } else {
            $paymentData['bank_transfer'] = [
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
