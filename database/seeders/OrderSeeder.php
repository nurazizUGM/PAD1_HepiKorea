<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\OrderShipment;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
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
        $user = User::where('email', 'testuser@example.com')->first();

        if ($user) {
            $product = Product::inRandomOrder()
                ->where('is_deleted', false)
                ->first();

            if ($product) {
                // unpaid order
                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => 'unpaid',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                // paid order
                $paidOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'paid',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $paidOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $paidOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $paidOrder->id,
                    'payment_type' => 'items',
                    'amount' => $product->price,
                    'payment_method' => 'bni',
                    'status' => 'success',
                    'payment_code' => 'PAY123456',
                    'transaction_id' => 'TRANS123456',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                // processed order
                $processedOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'processing',
                    'total_items_price' => $product->price,
                    'estimated_arrival' => now()->addDays(3),
                ]);

                OrderItem::create([
                    'order_id' => $processedOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $processedOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $processedOrder->id,
                    'payment_type' => 'items',
                    'amount' => $product->price,
                    'payment_method' => 'bni',
                    'status' => 'success',
                    'payment_code' => 'PAY654321',
                    'transaction_id' => 'TRANS654321',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                // shipment invoice order
                $shipmentOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'shipment_unpaid',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $shipmentOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $shipmentOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $shipmentOrder->id,
                    'payment_type' => 'items',
                    'amount' => $product->price,
                    'payment_method' => 'bni',
                    'status' => 'pending',
                    'payment_code' => 'SHIP123456',
                    'transaction_id' => 'TRANSSHIP123456',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                OrderShipment::create([
                    'order_id' => $shipmentOrder->id,
                    'shipment_service' => 'JNE',
                    'tracking_code' => 'SHIPCODE123',
                    'price' => 5000,
                    'arrival_estimation' => now()->addDays(3),
                ]);

                // paid shipment order
                $paidShipmentOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'shipment_paid',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $paidShipmentOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $paidShipmentOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $paidShipmentOrder->id,
                    'payment_type' => 'shipment',
                    'amount' => 5000,
                    'payment_method' => 'bni',
                    'status' => 'success',
                    'payment_code' => 'SHIPPAY123456',
                    'transaction_id' => 'TRANSSHIPPAY123456',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                OrderShipment::create([
                    'order_id' => $paidShipmentOrder->id,
                    'shipment_service' => 'JNE',
                    'price' => 5000,
                    'arrival_estimation' => now()->addDays(3),
                ]);

                // sent order
                $sentOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'sent',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $sentOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $sentOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $sentOrder->id,
                    'payment_type' => 'items',
                    'amount' => $product->price,
                    'payment_method' => 'bni',
                    'status' => 'success',
                    'payment_code' => 'SENTPAY123456',
                    'transaction_id' => 'TRANSSENTPAY123456',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                OrderShipment::create([
                    'order_id' => $sentOrder->id,
                    'shipment_service' => 'JNE',
                    'tracking_code' => 'SHIPCODE789',
                    'price' => 5000,
                    'arrival_estimation' => now()->addDays(3),
                ]);

                // finished order
                $finishedOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'finished',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $finishedOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $finishedOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $finishedOrder->id,
                    'payment_type' => 'items',
                    'amount' => $product->price,
                    'payment_method' => 'bni',
                    'status' => 'success',
                    'payment_code' => 'FINISHPAY123456',
                    'transaction_id' => 'TRANSFINISHPAY123456',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                OrderShipment::create([
                    'order_id' => $finishedOrder->id,
                    'shipment_service' => 'JNE',
                    'tracking_code' => 'SHIPCODE456',
                    'price' => 5000,
                    'arrival_estimation' => now()->addDays(3),
                ]);

                // reviewed order
                $reviewedOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'finished',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $reviewedOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $reviewedOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);

                OrderPayment::create([
                    'order_id' => $reviewedOrder->id,
                    'payment_type' => 'items',
                    'amount' => $product->price,
                    'payment_method' => 'bni',
                    'status' => 'success',
                    'payment_code' => 'REVIEWPAY123456',
                    'transaction_id' => 'TRANSREVIEWPAY123456',
                    'expired_at' => now()->addDays(1),
                    'paid_at' => now(),
                ]);

                OrderShipment::create([
                    'order_id' => $reviewedOrder->id,
                    'shipment_service' => 'JNE',
                    'tracking_code' => 'SHIPCODE789',
                    'price' => 5000,
                    'arrival_estimation' => now()->addDays(3),
                ]);

                Review::create([
                    'user_id' => $user->id,
                    'order_id' => $reviewedOrder->id,
                    'product_id' => $product->id,
                    'rating' => 5,
                    'content' => 'Great product!',
                ]);

                // cancelled order
                $cancelledOrder = Order::create([
                    'user_id' => $user->id,
                    'status' => 'cancelled',
                    'total_items_price' => $product->price,
                ]);

                OrderItem::create([
                    'order_id' => $cancelledOrder->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);

                OrderDetail::create([
                    'order_id' => $cancelledOrder->id,
                    'customer_name' => $user->fullname,
                    'customer_email' => $user->email,
                    'customer_phone' => '1234567890',
                    'customer_address' => '123 Test Street',
                    'province' => 'Test Province',
                    'city' => 'Test City',
                    'postal_code' => '12345',
                ]);
            }
        }
        DB::commit();
    }
}
