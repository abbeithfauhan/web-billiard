<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@billiard.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular User
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@billiard.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
