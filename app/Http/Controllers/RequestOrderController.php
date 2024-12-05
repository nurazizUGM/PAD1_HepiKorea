<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\CustomOrderItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestOrderController extends Controller
{


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
            $user = Auth::user();
        } else {
            $user = User::where('email', User::$guestEmail)->first();
        }

        $order = Order::create([
            'user_id' => $user->id,
            'type' => 'custom',
            'status' => 'unconfirmed',
            'total_items_price' => 0,
        ]);

        if ($user->role == Role::GUEST) {
            $order->orderDetail()->create([
                'fullname' => $data['fullname'],
                'email' => $data['email'],
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
        return redirect()->route('order.show', $order->id)->with('success', 'Order has been requested');
    }

    public function show(Request $request)
    {
        $data = $request->validate([
            'orderId' => 'nullable|integer|exists:orders,id'
        ]);

        if (!Auth::check() && !isset($data['orderId'])) {
            return redirect()->route('auth.login')->withErrors('You must login to view your orders');
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

        $items = $items->get();
        return view('customer.order.custom', compact('items'));
    }
}
