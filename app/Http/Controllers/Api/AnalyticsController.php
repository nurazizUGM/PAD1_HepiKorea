<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AnalyticsController extends Controller
{
    public function overview(Request $request)
    {
        $users = User::where('role', Role::USER)->count();
        $guests = Order::where('type', 'custom')
            ->whereHas('user', function ($user) {
                $user->where('email', 'guest@guest.com');
            })
            ->whereHas('orderDetail', function ($query) {
                $query->whereNotNull('customer_email');
            })
            ->get()
            ->pluck('orderDetail.customer_email')
            ->unique()
            ->count();

        $ongoingOrdersStatus = ['paid', 'processing', 'shipment_unpaid', 'shipment_paid', 'sent', 'finished'];
        $totalOrder = Order::whereNotIn('status', $ongoingOrdersStatus)->count();
        $completedOrder = Order::where('status', 'finished')->count();

        // Get total order for each category
        $categories = Category::with('products', 'products.orders')->get();
        foreach ($categories as $category) {
            $category['total_order'] = $category->products->sum(function ($product) use ($ongoingOrdersStatus) {
                return $product->orders->whereIn('status', $ongoingOrdersStatus)->count();
            });
            unset($category['products']);
        }

        // Get monthly order
        $month = [];
        $monthlyOrders = [];
        for ($i = 11; $i >= 0; $i--) {
            $month[] = now()->subMonths($i)->format('F');
            $monthlyOrders[] = Order::whereMonth('created_at', now()->subMonths($i)->month)->count();
        }

        $orders = Order::with('orderItems', 'orderItems.product', 'customOrderItems', 'user')
            ->whereIn('status', $ongoingOrdersStatus)
            ->orderBy('created_at', 'desc');

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

        return response()->json([
            'totalOrder' => $totalOrder,
            'completedOrder' => $completedOrder,
            'categories' => $categories,
            'month' => $month,
            'monthlyOrders' => $monthlyOrders,
            'orders' => $orders,
            'user' => [
                'users' => $users,
                'guests' => $guests,
                'total' => $users + $guests
            ]
        ]);
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
