<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::where('is_deleted', false);
        $category = $request->has('category') ? Category::find(request()->query('category')) : null;

        if (!empty(request()->query('category'))) {
            $products = $products->where('category_id', request()->query('category'));
        }
        if (!empty(request()->query('search'))) {
            $products = $products->where('name', 'like', '%' . request()->query('search') . '%');
        }

        $products = $products->get();
        return view('admin.product.index', compact('products', 'categories', 'category'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'images' => 'array',
        ]);

        $data['category_id'] = $data['category'];
        $product  = Product::create($data);

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->hashName();
                $image->storeAs('products', $filename, 'public');
                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }

        return redirect()->route('admin.product')->with('success', 'Product created successfully');
    }

    public function edit(Request $request, string $product)
    {
        $product = Product::find($product);
        if (!$product) {
            return redirect()->route('admin.product')->with('error', 'Product not found');
        }

        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'images' => 'array',
        ]);

        $data['category_id'] = $data['category'];
        $product->update($data);

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->hashName();
                $image->storeAs('products', $filename, 'public');
                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }

        return redirect()->route('admin.product')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Product deleted successfully');
    }
}
