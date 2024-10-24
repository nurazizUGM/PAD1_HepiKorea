<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_items_price' => $this->faker->randomNumber(7),
            'service_price' => $this->faker->randomNumber(7),
            'status' => $this->faker->randomElement(\App\Models\Order::$status),
            'type' => $this->faker->randomElement(['order', 'custom']),
        ];
    }
}