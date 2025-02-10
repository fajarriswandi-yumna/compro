<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User 1
        User::create([
            'name' => 'Abdul Ghany',
            'email' => 'admin1@example.com',
            'password' => Hash::make('amanah@123'), // Ganti 'password' dengan password yang lebih kuat di produksi
            'role' => 'admin',
        ]);

        // Admin User 2
        User::create([
            'name' => 'Nadya Rasyid',
            'email' => 'admin2@example.com',
            'password' => Hash::make('amanah@123'), // Ganti 'password' dengan password yang lebih kuat di produksi
            'role' => 'admin',
        ]);
    }
}