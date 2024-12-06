<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('admin.product.index', ['tab' => 'category', 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|file|image',
        ]);

        $icon = $request->file('icon');
        $data['icon'] = $icon->store('category');

        Category::create($data);
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category)
    {
        $category = Category::findOrFail($category);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|file|image',
        ]);

        // store category icon
        if ($request->hasFile('icon')) {
            if (Storage::exists($category->icon)) {
                Storage::delete($category->icon);
            }

            $icon = $request->file('icon');
            $data['icon'] = $icon->store('category');
        }

        $category->update($data);
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully');
    }
}
