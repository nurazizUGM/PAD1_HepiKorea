<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        for ($i = 1; $i <= 2; $i++) {
            $this->call(OrderSeeder::class);
        }
    }
}
