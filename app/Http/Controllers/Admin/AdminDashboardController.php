<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // admin dashboard page
    public function index()
    {
        // get total products, orders and customers
        $products = Product::where('is_deleted', false)->count();
        $orders = Order::where('status', '!=', 'cancelled')->count();
        $customers = User::where('role', Role::USER)->count();

        $uncompletedOrder = Order::whereNotIn('status', ['canceled', 'finised'])->count();
        $completedOrder = Order::where('status', 'finished')->count();
        $completionRate = $uncompletedOrder + $completedOrder > 0 ? ($completedOrder / ($uncompletedOrder + $completedOrder)) * 100 : 0;
        $completionRate = number_format($completionRate, 2);

        // Get total order for each category
        $categories = Category::with('products', 'products.orders')->get();
        foreach ($categories as $category) {
            $category['total_order'] = $category->products
                ->sum(function ($product) {
                    return $product->orders
                        ->where('status', '!=', 'cancelled')
                        ->count();
                });
        }
        return view('admin.dashboard', compact('products', 'orders', 'customers', 'uncompletedOrder', 'completedOrder', 'completionRate', 'categories'));
    }
}
