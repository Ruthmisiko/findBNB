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
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@findbnb.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@findbnb.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Create additional admin user (optional)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Email: admin@findbnb.com');
        $this->command->info('Password: admin123');
        $this->command->info('');
        $this->command->info('Or:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password123');
    }
}
