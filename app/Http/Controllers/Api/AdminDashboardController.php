<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
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
                        ->whereNotIn('status', ['unpaid', 'canceled', 'unconfirmed', 'confirmed'])
                        ->count();
                });
            unset($category->products);
        }

        return response()->json([
            'products' => $products,
            'customers' => $customers,
            'uncompleted_order' => $uncompletedOrder,
            'completed_order' => $completedOrder,
            'total_order' => $totalOrder,
            'completion_rate' => $completionRate,
            'categories' => $categories,
        ]);
    }
}
