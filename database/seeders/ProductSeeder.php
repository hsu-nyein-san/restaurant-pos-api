<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Americano',
            'description' => 'Black coffee',
            'price' => 3000,
            'cost_price' => 1500,
            'stock_quantity' => 100,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Cappuccino',
            'description' => 'Espresso with steamed milk',
            'price' => 4500,
            'cost_price' => 2500,
            'stock_quantity' => 80,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Chicken Burger',
            'description' => 'Burger with chicken patty',
            'price' => 6000,
            'cost_price' => 3500,
            'stock_quantity' => 50,
        ]);

    }
}
