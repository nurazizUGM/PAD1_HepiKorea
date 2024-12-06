<?php

namespace Database\Seeders;

use Database\Factories\NotificationFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CarouselSeeder::class);
        \App\Models\Category::create([
            'name' => 'Fashion',
            'icon' => 'public/storage/example/category.png',
        ]);

        UserFactory::new()->count(3)->create();
        NotificationFactory::new()->count(3)->create();
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
