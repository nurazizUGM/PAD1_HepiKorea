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
        $customers = User::where('role', Role::USER)->count();

        $uncompletedOrder = Order::whereIn('status', ['paid', 'processing', 'shipment_unpaid', 'shipment_paid', 'sent'])->count();
        $completedOrder = Order::where('status', 'finished')->count();
        $totalOrder = $uncompletedOrder + $completedOrder;
        $completionRate = $totalOrder > 0 ? ($completedOrder / ($totalOrder)) * 100 : 0;
        $completionRate = number_format($completionRate, 2);

        // Get total order for each category
        $categories = Category::with('products', 'products.orders')->get();
        foreach ($categories as $category) {
            $category['total_order'] = $category->products
                ->sum(function ($product) {
                    return $product->orders
                        ->whereIn('status', ['paid', 'processing', 'shipment_unpaid', 'shipment_paid', 'sent', 'finished'])
                        ->count();
                });
        }
        return view('admin.dashboard', compact('products', 'customers', 'totalOrder', 'uncompletedOrder', 'completedOrder', 'completionRate', 'categories'));
    }
}
