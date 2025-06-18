<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sainteanne.com',
            'password' => Hash::make('password123'),
            'phone' => '0788123456',
            'role' => 'admin'
        ]);

        // Create store manager
        User::create([
            'name' => 'Store Manager',
            'email' => 'store@sainteanne.com',
            'password' => Hash::make('password123'),
            'phone' => '0788234567',
            'role' => 'store_manager'
        ]);
    }
} 