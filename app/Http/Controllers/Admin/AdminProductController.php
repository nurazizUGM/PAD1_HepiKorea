<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // product list
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
        $tab = 'product';
        return view('admin.product.index', compact('products', 'categories', 'category', 'tab'));
    }

    // create product
    public function create()
    {
        $categories = Category::all();
        $tab = 'create';
        return view('admin.product.index', compact('categories', 'tab'));
    }

    // store product
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

        // store images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->hashName();
                $image->storeAs('products', $filename, 'public');
                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }

    // edit product page
    public function edit(Request $request, string $product)
    {
        $product = Product::find($product);
        if (!$product) {
            return redirect()->route('admin.product.index')->with('error', 'Product not found');
        }

        $tab = 'edit';
        return view('admin.product.index', compact('product', 'tab'));
    }

    // update product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'images' => 'array',
            'deleted_images' => 'array',
        ]);

        $data['category_id'] = $data['category'];
        $product->update($data);

        // store images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->hashName();
                $image->storeAs('products', $filename, 'public');
                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }

        // delete images
        if ($request->has('deleted_images')) {
            foreach ($request->input('deleted_images') as $image) {
                $image = $product->images()->find($image);
                if ($image && Storage::exists('public/products/' . $image->path)) {
                    Storage::delete('public/products/' . $image->path);
                }
                if ($image) {
                    $image->delete();
                }
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    // delete product
    public function destroy(string $product)
    {
        $product = Product::find($product);
        if (!$product) {
            return redirect()->route('admin.product.index')->with('error', 'Product not found');
        }

        $product->update(['is_deleted' => true]);
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
    }
}
