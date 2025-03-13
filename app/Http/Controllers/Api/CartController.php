<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // customer cart page
    public function findAll()
    {
        $carts = Cart::with(['product', 'product.images'])
            ->where('user_id', Auth::id())
            ->whereHas('product', function ($query) {
                $query->where('is_deleted', false);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        $carts->map(function ($cart) {
            // get the first image of the product
            $cart->product->image = $cart->product->images->first()->path;
            unset($cart->product->images);
            return $cart;
        });

        return response()->json($carts);
    }

    // add product to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ])->first();

        // if the product is already in the cart, update the quantity
        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json(['message' => 'Product added to cart']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where([
            'id' => $id,
            'user_id' => Auth::id(),
        ])->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Cart updated']);
    }

    public function delete(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|array',
            'id.*' => 'required|exists:carts,id'
        ]);

        Cart::where('user_id', Auth::id())->whereIn('id', $data['id'])->delete();
        return response()->json(['message' => 'Cart deleted']);
    }

    public function synchronize(Request $request)
    {
        $carts = $request->validate([
            'carts' => 'required|array',
            'carts.*.product_id' => 'required|exists:products,id',
            'carts.*.quantity' => 'required|integer|min:1',
        ]);

        // add or update the cart
        foreach ($carts['carts'] as $cart) {
            $cart = Cart::where([
                'user_id' => Auth::id(),
                'product_id' => $cart['product_id'],
            ])->first();

            if ($cart) {
                $cart->update([
                    'quantity' => $cart->quantity + $cart['quantity'],
                ]);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $cart['product_id'],
                    'quantity' => $cart['quantity'],
                ]);
            }
        }

        return response()->json(['message' => 'Cart synchronized']);
    }
}
