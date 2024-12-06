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
            ['name' => 'Email', 'key' => 'email', 'value' => 'admin@hepikorea.pad19.me'],
            ['name' => 'Address', 'key' => 'address', 'value' => 'Jl. Raya No. 1'],
            // https://line.me/ti/p/~id_line
            ['name' => 'Line', 'key' => 'line', 'value' => 'https://line.me/ti/p/v4ZoqbIEQ1'],
            ['name' => 'Instagram', 'key' => 'instagram', 'value' => 'hepikorea'],
            ['name' => 'Whatsapp', 'key' => 'whatsapp', 'value' => '628123456890'],
            ['name' => 'Phone', 'key' => 'phone', 'value' => '628123456890'],
            ['name' => 'About', 'key' => 'about', 'value' => 'Our company is a company that sells various kinds of Korean products. We have been established since 2010 and have served many customers. We are committed to providing the best service for our customers'],
        ]);
    }
}
