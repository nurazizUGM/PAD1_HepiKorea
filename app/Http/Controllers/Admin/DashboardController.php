<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted', false)->count();
        $orders = Order::all()->count();
        $customers = User::where('role', Role::USER)->count();
        return view('admin.dashboard', compact('products', 'orders', 'customers'));
    }
}
