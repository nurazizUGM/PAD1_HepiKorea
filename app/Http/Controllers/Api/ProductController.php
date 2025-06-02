<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function latest()
    {
        // 10 latest products
        $products = Product::where('is_deleted', false)->with(['images', 'category'])->orderBy('created_at', 'desc')->limit(10)->get();
        $result = $products->map(function ($product) {
            return (object)[
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category?->name,
                'price' => $product->price,
                'image' => $product->images->first()->path
            ];
        });

        return response()->json($result);
    }

    public function popular()
    {
        // 10 latest products
        $result = Product::where('is_deleted', false)->with(['images', 'orders', 'category'])
            ->withCount('orders')->orderBy('orders_count', 'desc')->limit(10)->get()->map(function ($product) {
                return (object)[
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category->name,
                    'price' => $product->price,
                    'total_orders' => $product->orders_count,
                    'image' => $product->images->first()->path
                ];
            });


        return response()->json($result);
    }

    public function findAll(Request $request)
    {
        $search = $request->query('search', '');
        $category = $request->query('category', null);
        $sortBy = $request->query('sort_by', 'name');
        $maxPrice = $request->query('max_price', null);
        $minPrice = $request->query('min_price', null);
        $perPage = $request->query('per_page', 50);

        $products = Product::where('is_deleted', false)->with('images');

        // search by name
        if (!empty($search)) {
            $products = $products->where('name', 'like', "%$request->search%");
        }

        // filter by category
        if ($category) {
            $products = $products->where('category_id', $category);
        }

        // product sorting
        if ($sortBy == 'lowest_price') {
            $products = $products->orderBy('price', 'asc');
        } else if ($sortBy == 'highest_price') {
            $products = $products->orderBy('price', 'desc');
        } else if ($sortBy == 'most_ordered') {
            $products = $products->withCount('orders')->orderBy('orders_count', 'desc');
        }

        // filter by price range
        if ($minPrice) {
            $products = $products->where('price', '>=', intval($minPrice));
        }
        if ($maxPrice) {
            $products = $products->where('price', '<=', intval($maxPrice));
        }

        $products = $products->with(['category', 'images', 'reviews'])->paginate($perPage);
        return response()->json($products);
    }

    public function findOne(string $id)
    {
        $product = Product::with(['category', 'images', 'reviews', 'reviews.user'])->findOrFail($id);
        return response()->json($product);
    }

    public function create(Request $request)
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
                $filename = $image->store('products');
                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }

        return response()->json($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

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
                $filename = $image->store('products');
                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }

        // delete images
        if ($request->has('deleted_images')) {
            foreach ($request->input('deleted_images') as $image) {
                $image = $product->images()->find($image);
                if ($image) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
        }

        return response()->json($product);
    }

    public function delete(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update(['is_deleted' => true]);
        return response()->json(['message' => 'Product deleted']);
    }
}
