<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    public function edit(Product $product)
    {
        return view('admin.product_edit', compact('product'));
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
