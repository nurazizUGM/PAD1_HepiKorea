<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // customer cart page
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with(['product'])->get();
        $carts->map(function ($cart) {
            // get the first image of the product
            $cart->product->image = $cart->product->images->first()->path;
            return $cart;
        });
        return view('customer.cart', compact('carts'));
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

        return redirect()->back()->with('success', 'Product added to cart');
    }
}
