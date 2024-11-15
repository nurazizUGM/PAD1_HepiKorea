<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $category = $request->query('category', null);
        $sortBy = $request->query('sort_by', 'name');
        $maxPrice = $request->query('max_price', null);
        $minPrice = $request->query('min_price', null);

        $products = Product::where('name', 'like', "%$search%");
        if ($category) {
            $products = $products->where('category_id', $category);
        }
        if ($sortBy == 'lowest_price') {
            $products = $products->orderBy('price', 'asc');
        } else if ($sortBy == 'highest_price') {
            $products = $products->orderBy('price', 'desc');
        } else if ($sortBy == 'most_ordered') {
            $products = $products->withCount('orders')->orderBy('orders_count', 'desc');
        }

        if ($minPrice) {
            $products = $products->where('price', '>=', intval($minPrice));
        }
        if ($maxPrice) {
            $products = $products->where('price', '<=', intval($maxPrice));
        }

        $products = $products->with(['category', 'images'])->get();

        return view('customer.product.index', compact('products'));
    }
}
