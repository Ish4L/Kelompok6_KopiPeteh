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
                'product_name' => 'Americano',
                'category_id' => 1,
                'price' => 8000,
                'description' => 'Perpaduan espresso dengan aroma kopi yang khas.',
                'image' => 'products\americano.png',
                'status' => 'active'
            ],
            [
                'product_name' => 'Sunset Noir',
                'category_id' => 1,
                'price' => 12000,
                'description' => 'Perpaduan manisnya sirup stroberi dan kepekatan kopi hitam.',
                'image' => 'products\sunset-noir.png',
                'status' => 'active'
            ],
            [
                'product_name' => 'Dirty Latte',
                'category_id' => 1,
                'price' => 20000,
                'description' => 'Espresso dengan susu segar yang lembut.',
                'image' => 'products\dirty-latte.png',
                'status' => 'active'
            ],
            [
                'product_name' => 'Kopi Senja Aren',
                'category_id' => 1,
                'price' => 15000,
                'description' => 'Perpaduan kopi, susu, dan gula aren.',
                'image' => 'products\kopi-senja-aren.png',
                'status' => 'active'
            ],
            [
                'product_name' => 'Spanish Latte',
                'category_id' => 1,
                'price' => 15000,
                'description' => 'Espresso dengan susu creamy dan rasa manis.',
                'image' => 'products\spanish-latte.png',
                'status' => 'active'
            ],
            [
                'product_name' => 'Matcha',
                'category_id' => 2,
                'price' => 20000,
                'description' => 'Matcha pilihan dengan rasa khas dan tekstur lembut.',
                'image' => 'products\matcha.png',
                'status' => 'active'
            ],
            [
                'product_name' => 'Magic Milk',
                'category_id' => 2,
                'price' => 20000,
                'description' => 'Perpaduan susu dengan rasa manis yang creamy.',
                'image' => 'products\magic-milk.png',
                'status' => 'active'
            ]
        ]);
    }
}
