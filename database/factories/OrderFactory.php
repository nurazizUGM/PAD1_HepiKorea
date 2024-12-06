<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    static ?string $status;
    static ?string $type;
    static ?int $user_id;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = static::$type ?? $this->faker->randomElement(Order::$type);
        $servicePrice = 0;
        if (isset(static::$status)) {
            $status = static::$status;
        } else if ($type == 'order') {
            $statusArray = array_slice(Order::$status, 2);
            $status = $this->faker->randomElement($statusArray);
        } else {
            $status = $this->faker->randomElement(['unconfirmed', 'confirmed']);
        }

        if ($type == 'custom') {
            $servicePrice = $this->faker->randomNumber(6);
        }

        return [
            'total_items_price' => 0,
            'service_price' => 0,
            'type' => $type,
            'status' => $status,
            'user_id' => static::$user_id ?? $this->faker->randomElement(\App\Models\User::where('role', \App\Enums\Role::USER)->pluck('id')->toArray()),
            'service_price' => $servicePrice,
        ];
    }
}
