<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function findAll()
    {
        return response()->json(Category::orderBy('name')->get());
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'icon' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $icon = $request->file('icon');
        $data['icon'] = $icon->store('category');

        $category = Category::create($data);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'icon' => 'file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $category->name = $data['name'];
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            Storage::delete($category->icon);
            $category->icon = $icon->store('category');
        }

        $category->save();
        return response()->json($category);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        Storage::delete($category->icon);
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
