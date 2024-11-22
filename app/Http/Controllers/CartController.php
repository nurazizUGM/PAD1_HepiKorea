<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = User::with('carts')->find(Auth::id());
        $carts = $user->carts;

        return view('customer.cart', compact('carts'));
    }
}
