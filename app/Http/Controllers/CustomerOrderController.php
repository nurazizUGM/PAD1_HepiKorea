<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
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
}
