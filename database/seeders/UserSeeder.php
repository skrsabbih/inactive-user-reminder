<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inactive user (10 days ago login) for test perpose
        User::create([
            'name' => 'Sabbih',
            'email' => 'sabbih@example.com',
            'password' => Hash::make('password'),
            'last_login_at' => now()->subDays(10),
        ]);

        // Active user (2 days ago login) for test perpose
        User::create([
            'name' => 'Mahfuz',
            'email' => 'mahfuz@example.com',
            'password' => Hash::make('password'),
            'last_login_at' => now()->subDays(2),
        ]);
    }
}
