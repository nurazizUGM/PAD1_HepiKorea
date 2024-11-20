<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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
            $total += $products[$i]->price * $data['quantity'][$i];
            $items[] = [
                'product' => $products[$i],
                'quantity' => $data['quantity'][$i],
            ];
        }

        return [
            'total' => $total,
            'items' => $items,
        ];
    }

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
            'items.*.image' => 'required|image'
        ]);

        dd($data);

        $order = Order::create([
            'total' => $data['total'],
            'status' => 'pending',
        ]);

        $order->products()->attach($data['products'], ['quantity' => $data['quantity']]);

        return redirect()->route('order.show', $order);
    }
}
