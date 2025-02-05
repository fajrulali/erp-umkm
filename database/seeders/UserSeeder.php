<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Gunakan password yang aman
            'role' => 1, // Admin
            'status' => 1, // Active
        ]);
    }
}
