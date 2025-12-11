<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama terlebih dahulu
        User::query()->delete();

        // 1 Admin
        // 1 Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@dksupplyco.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // 2 Sellers - Dion & Kheiza
        User::create([
            'name' => 'Dion',
            'email' => 'dion@dksupplyco.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone_number' => '081234567891',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Kheiza',
            'email' => 'kheiza@dksupplyco.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone_number' => '081234567892',
            'email_verified_at' => now(),
        ]);

        // 1 Customer for testing
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@dksupplyco.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone_number' => '081234567893',
            'email_verified_at' => now(),
        ]);
    }
}
