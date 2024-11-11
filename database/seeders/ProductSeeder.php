<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Models\Category::all() as $category) {
            $category->products()->saveMany(\Database\Factories\ProductFactory::new()->count(5)->make([
                'category_id' => $category->id,
            ]));
        }

        foreach (\App\Models\Product::all() as $product) {
            $product->images()->saveMany(\Database\Factories\ProductImageFactory::new()->count(2)->make([
                'product_id' => $product->id,
            ]));
        }
    }
}
