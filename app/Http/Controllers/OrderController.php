<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $data = $request->validate([
            'products' => 'required|array|exists:products,id',
            'quantity' => 'required|array|min:1',
        ]);

        $items = $this->calculateTotal($data);
        return view('customer.order.checkout', $items);
    }

    public function calculateTotal($data)
    {
        $products = Product::findMany($data['products']);
        $total = 0;
        $items = [];
        for ($i = 0; $i < count($products); $i++) {
            $products[$i]->image = $products[$i]->images->first()->path;
            $subTotal = $products[$i]->price * $data['quantity'][$i];
            $total += $subTotal;
            $items[] = (object)[
                'product' => $products[$i],
                'quantity' => $data['quantity'][$i],
                'total' => $subTotal,
            ];
        }

        return [
            'total' => $total,
            'items' => $items,
        ];
    }

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
            'items.*.image' => 'required|image'
        ]);

        if (Auth::check()) {
            $user = User::find(Auth::id());
        } else {
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
        if ($order->type == 'custom') {
            $order->load('customOrderItems');
            return view('customer.order.custom', compact('order'));
        } else {
            $order->load(['orderItems', 'orderItems.product', 'orderItems.product.images']);
            return view('customer.order.show', compact('order'));
        }
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('customer.order.history', compact('orders'));
    }
}
