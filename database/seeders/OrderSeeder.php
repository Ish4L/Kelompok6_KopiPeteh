<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $product1 = Product::first();
        $product2 = Product::skip(1)->first();
        $product3 = Product::skip(2)->first();

        $order1 = Order::create([
            'name' => 'Fulan',
            'phone' => '081234567890',
            'total_price' => 2 * $product1->price,
            'payment_method' => 'cash',
            'status' => 'belum bayar'
        ]);

        $order1->items()->create([
            'product_id' => $product1->id,
            'variant' => 'iced',
            'quantity' => 2,
            'price' => $product1->price
        ]);

        $order2 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => 1 * $product3->price,
            'payment_method' => 'cash',
            'status' => 'menunggu'
        ]);

        $order2->items()->create([
            'product_id' => $product3->id,
            'variant' => 'iced',
            'quantity' => 1,
            'price' => $product3->price
        ]);

        $order3 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => 1 * $product2->price,
            'payment_method' => 'cash',
            'status' => 'menunggu'
        ]);

        $order3->items()->create([
            'product_id' => $product2->id,
            'variant' => 'hot',
            'quantity' => 1,
            'price' => $product2->price
        ]);

        $order4 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => 1 * $product3->price,
            'payment_method' => 'cash',
            'status' => 'menunggu'
        ]);

        $order4->items()->create([
            'product_id' => $product3->id,
            'variant' => 'iced',
            'quantity' => 1,
            'price' => $product3->price
        ]);
    }
}