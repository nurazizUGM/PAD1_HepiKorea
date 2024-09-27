<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'fullname' => 'Administrator',
            'password' => '123',
            'role' => Role::ADMIN,
            'is_verified' => 1
        ]);
    }
}
