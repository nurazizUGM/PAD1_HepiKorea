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
        return [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url,
            'description' => $this->faker->sentence(10),
            'quantity' => $this->faker->numberBetween(1, 10),
            'estimated_price' => $this->faker->randomNumber(6),
            'total_price' => $this->faker->randomNumber(6),
            'is_available' => $this->faker->boolean,
        ];
    }
}
