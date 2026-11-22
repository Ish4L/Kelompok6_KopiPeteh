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
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'menunggu'
        ]);

        $order2->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order3 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'menunggu'
        ]);

        $order3->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order4 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'menunggu'
        ]);

        $order4->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order5 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'selesai'
        ]);

        $order5->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order6 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'selesai'
        ]);

        $order6->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order7 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'selesai'
        ]);

        $order7->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order8 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'selesai'
        ]);

        $order8->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);
        $order9 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'selesai'
        ]);

        $order9->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);

        $order10 = Order::create([
            'name' => 'Fulani',
            'phone' => '080987654321',
            'total_price' => (2 * $product2->price) + (1 * $product3->price),
            'payment_method' => 'cash',
            'status' => 'selesai'
        ]);

        $order10->items()->createMany([
            [
                'product_id' => $product2->id,
                'variant' => 'iced',
                'quantity' => 2,
                'price' => $product2->price
            ],
            [
                'product_id' => $product3->id,
                'variant' => 'iced',
                'quantity' => 1,
                'price' => $product3->price
            ]
        ]);
    }
}
