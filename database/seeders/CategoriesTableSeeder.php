<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Teknologi']);
        Category::create(['name' => 'Bisnis']);
        Category::create(['name' => 'Marketing']);
        Category::create(['name' => 'Desain']);
        Category::create(['name' => 'Food & beverage']);
    }
}
