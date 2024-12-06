<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = $this->faker->randomElement(\App\Models\Product::all());
        $quantity = $this->faker->randomNumber(1);

        return [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price * $quantity,
        ];
    }
}
