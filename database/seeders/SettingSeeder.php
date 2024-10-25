<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            ['name' => 'Phone', 'key' => 'phone', 'value' => '+6281234567890'],
            ['name' => 'Email', 'key' => 'email', 'value' => 'admin@admin.com'],
            ['name' => 'Address', 'key' => 'address', 'value' => 'Jl. Raya No. 1'],
            // https://line.me/ti/p/~{{line_id}}
            ['name' => 'Line', 'key' => 'line', 'value' => 'nuraziz_13']
        ]);
    }
}
