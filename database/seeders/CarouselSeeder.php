<?php

namespace Database\Seeders;

use Database\Factories\CarouselFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarouselFactory::new()->count(3)->create();
    }
}
