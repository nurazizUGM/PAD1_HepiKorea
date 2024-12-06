<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\CustomOrderItem;
use App\Models\Order;
use App\Models\OrderItem;
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
        $orders = Order::factory()->count(10)->create();
        foreach ($orders as $order) {
            if ($order->type == 'order') {
                $order->orderItems()->saveMany(OrderItem::factory()->count(2)->make());
                $order->update([
                    'total_items_price' => $order->orderItems->sum(function ($item) {
                        return $item->price * $item->quantity;
                    }),
                ]);
            } else {
                $order->customOrderItems()->saveMany(CustomOrderItem::factory()->count(2)->make());
                $order->orderDetail()->create([
                    'customer_name' => fake()->name,
                    'customer_email' => fake()->safeEmail,
                ]);
                $order->update([
                    'total_items_price' => $order->customOrderItems->sum('total_price'),
                ]);
            }

            if (strpos($order->status, 'shipment_') === 0) {
                $order->orderShipment()->create([
                    'shipment_service' => 'JNE',
                    'price' => fake()->randomNumber(5),
                    'tracking_code' => fake()->randomNumber(6, true),
                    'arrival_estimation' => fake()->dateTimeBetween('now', '+7 days'),
                ]);
            }
        }
        DB::commit();
    }
}
