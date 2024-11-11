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
            'icon' => 'https://via.placeholder.com/150',
        ], [
            'name' => 'Electronics',
            'icon' => 'https://via.placeholder.com/150',
        ],  [
            'name' => 'Health & Beauty',
            'icon' => 'https://via.placeholder.com/150',
        ]]);

        $this->call(ProductSeeder::class);

        \Database\Factories\UserFactory::new()->count(2)->create();

        $this->call(OrderSeeder::class);
    }
}
