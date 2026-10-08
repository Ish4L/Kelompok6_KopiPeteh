<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'product_name' => 'Dirty Latte',
                'category_id' => 2,
                'price' => 20000,
                'description' => 'lorem ipsum',
                'status' => 'active'
            ],
            [
                'product_name' => 'Spanish Latte',
                'category_id' => 2,
                'price' => 15000,
                'description' => 'lorem ipsum',
                'status' => 'inactive'
            ],
            [
                'product_name' => 'Ice Americano',
                'category_id' => 2,
                'price' => 12000,
                'description' => 'lorem ipsum',
                'status' => 'active'
            ]
        ]);
    }
}
