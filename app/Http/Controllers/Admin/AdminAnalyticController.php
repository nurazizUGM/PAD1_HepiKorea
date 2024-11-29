<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminAnalyticController extends Controller
{
    // Business analytic page
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'chart');
        $totalOrder = Order::count();
        $completedOrder = Order::where('status', 'finished')->count();

        // Get total order for each category
        $categories = Category::with('products', 'products.orders')->get();
        foreach ($categories as $category) {
            $category['total_order'] = $category->products->sum(function ($product) {
                return $product->orders->count();
            });
        }

        // Get monthly order
        $month = [];
        $monthlyOrders = [];
        for ($i = 11; $i >= 0; $i--) {
            $month[] = now()->subMonths($i)->format('F');
            $monthlyOrders[] = Order::whereMonth('created_at', now()->subMonths($i)->month)->count();
        }

        // Get all orders for table
        $orders = Order::with('orderItems', 'orderItems.product', 'customOrderItems', 'user');
        $search = $request->query('search');
        if ($search) {
            $orders = $orders->where('status', 'like', "%$search%")
                ->orWhereHas('orderItems.product', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orWhereHas('customOrderItems', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        }
        $orders = $orders->get();

        return view('admin.analytic', compact('totalOrder', 'completedOrder', 'categories', 'month', 'monthlyOrders', 'orders', 'tab'));
    }

    // Export all orders to excel
    public function export(Request $request)
    {
        $orders = Order::with('orderItems', 'orderItems.product', 'customOrderItems', 'user')->get();
        $filename = 'orders_' . now()->format('Y-m-d_His') . '.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        return view('admin.analytic-export', compact('orders'));
    }
}
