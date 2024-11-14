<?php

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        $orders = \Database\Factories\OrderFactory::new()->count(10)->create([
            'type' => 'order',
        ]);

        $customOrders = \Database\Factories\OrderFactory::new()->count(1)->create([
            'type' => 'custom',
        ]);


        foreach ($orders as $order) {
            $order->orderItems()->saveMany(\Database\Factories\OrderItemFactory::new()->count(fake()->numberBetween(1, 2))->make([
                'order_id' => $order->id,
                'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
            ]));
        }
        foreach ($customOrders as $customOrder) {
            $customOrder->customOrderItems()->saveMany(\Database\Factories\CustomOrderItemFactory::new()->count(fake()->numberBetween(1, 2))->make([
                'order_id' => $order->id,
            ]));
        }
        DB::commit();
    }
}
