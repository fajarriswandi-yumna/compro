<?php

namespace Database\Seeders;

use App\Models\Client; // Import Model Client
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan factory untuk membuat 5 data client palsu
        Client::factory()->count(5)->create();
    }
}