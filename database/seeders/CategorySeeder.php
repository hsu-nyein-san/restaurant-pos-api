<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Coffee',
            'description' => 'Coffee and beverages',
        ]);

        Category::create([
            'name' => 'Food',
            'description' => 'Food and meals',
        ]);

    }
}
