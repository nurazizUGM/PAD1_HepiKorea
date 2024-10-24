<?php

namespace Database\Seeders;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([[
            'name' => 'Fashion',
            'logo' => 'https://via.placeholder.com/150',
        ], [
            'name' => 'Electronics',
            'logo' => 'https://via.placeholder.com/150',
        ],  [
            'name' => 'Health & Beauty',
            'logo' => 'https://via.placeholder.com/150',
        ]]);

        foreach (\App\Models\Category::all() as $category) {
            $category->products()->saveMany(\Database\Factories\ProductFactory::new()->count(1)->make([
                'category_id' => $category->id,
            ]));
        }

        foreach (\App\Models\Product::all() as $product) {
            $product->images()->saveMany(\Database\Factories\ProductImageFactory::new()->count(2)->make([
                'product_id' => $product->id,
            ]));
        }

        \Database\Factories\UserFactory::new()->count(2)->create();

        foreach (\App\Models\User::all() as $user) {
            $user->carts()->saveMany(\Database\Factories\CartFactory::new()->count(1)->make([
                'user_id' => $user->id,
            ]));

            $user->orders()->saveMany(\Database\Factories\OrderFactory::new()->count(fake()->numberBetween(0, 2))->make([
                'user_id' => $user->id,
            ]));
        }

        foreach (\App\Models\Order::all() as $order) {
            if ($order->type === 'order') {
                $order->orderItems()->saveMany(\Database\Factories\OrderItemFactory::new()->count(fake()->numberBetween(0, 2))->make([
                    'order_id' => $order->id,
                ]));
            } else {
                $order->customOrderItems()->saveMany(\Database\Factories\CustomOrderItemFactory::new()->count(fake()->numberBetween(0, 2))->make([
                    'order_id' => $order->id,
                ]));
            }
        }
    }
}
