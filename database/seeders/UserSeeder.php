<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'testuser@example.com')->first();
        if ($user) {
            // If the user already exists, delete it
            $user->addresses()->delete();
            $user->delete();
        }

        // Create a new user with an address
        $user = User::create([
            'fullname' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '1234567890',
            'password' => 'testpassword',
        ]);

        Address::create([
            'user_id' => $user->id,
            'name' => 'Test User',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'province' => 'Test Province',
            'city' => 'Test City',
            'postal_code' => '12345',
        ]);

        Log::info('UserSeeder: User created with email '. $user->email . ' and password testpassword');
    }
}
