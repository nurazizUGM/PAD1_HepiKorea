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
        DB::transaction(function () {

            foreach (\App\Models\User::where('role', Role::USER)->get() as $user) {
                $user->orders()->saveMany(\Database\Factories\OrderFactory::new()->count(fake()->numberBetween(0, 2))->make([
                    'user_id' => $user->id,
                ]));
            }


            foreach (\App\Models\Order::all() as $order) {
                if ($order->type === 'order') {
                    $order->orderItems()->saveMany(\Database\Factories\OrderItemFactory::new()->count(fake()->numberBetween(1, 2))->make([
                        'order_id' => $order->id,
                        'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
                    ]));
                } else {
                    $order->customOrderItems()->saveMany(\Database\Factories\CustomOrderItemFactory::new()->count(fake()->numberBetween(1, 2))->make([
                        'order_id' => $order->id,
                    ]));
                }
            }
            DB::commit();
        });
    }
}
