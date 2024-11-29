<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // list of categories
        $categories = Category::all();

        // 10 latest products
        $newProducts = Product::with('category')->orderBy('created_at', 'desc')->limit(10)->get()->map(function ($product) {
            return (object)[
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'price' => $product->price
            ];
        });

        // 10 most ordered products
        $popularProducts = Product::with(['orders', 'category'])
            ->withCount('orders')->orderBy('orders_count', 'desc')->limit(10)->get()->map(function ($product) {
                return (object)[
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category->name,
                    'price' => $product->price,
                    'total_orders' => $product->orders_count
                ];
            });

        return view('customer.home', compact('categories', 'newProducts', 'popularProducts'));
    }
}
