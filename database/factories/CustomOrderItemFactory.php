<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomOrderItem>
 */
class CustomOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->randomNumber(6);
        $quantity = $this->faker->randomNumber(1);
        return [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url,
            'description' => $this->faker->sentence(10),
            'quantity' => $quantity,
            'estimated_price' => $price,
            'total_price' => $price * $quantity,
            'image' => 'example/request.png',
        ];
    }
}
