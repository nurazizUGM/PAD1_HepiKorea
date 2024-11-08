<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Models\User::where('role', \App\Enums\Role::USER)->get() as $user) {
            $user->carts()->saveMany(\Database\Factories\CartFactory::new()->count(1)->make([
                'user_id' => $user->id,
            ]));
        }
    }
}
