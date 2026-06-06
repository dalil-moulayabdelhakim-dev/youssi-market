<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    private $products = [
    [
        'title' => 'Smartphone X10',
        'description' => 'Latest 5G smartphone with stunning display',
        'image' => 'storage/uploads/products/1/banner/Smartphone_X10.jpg',
        'category_id' => 1,
        'store_id' => 1,
        'quantity' => 50,
        'price' => 75000,
        'discount_price' => 10, // = 10%
        'old_price' => 83333,
    ],
    [
        'title' => 'Wireless Headphones',
        'description' => 'Noise cancelling, long battery life',
        'image' => 'storage/uploads/products/1/banner/Wireless_Headphones.jpg',
        'category_id' => 21,
        'store_id' => 1,
        'quantity' => 120,
        'price' => 12000,
        'discount_price' => 20,
        'old_price' => 15000,
    ],
    [
        'title' => 'Gaming Laptop RTX 4060',
        'description' => 'High-performance laptop for gaming and work',
        'image' => 'storage/uploads/products/1/banner/Gaming_Laptop_RTX_4060.jpg',
        'category_id' => 17,
        'store_id' => 1,
        'quantity' => 20,
        'price' => 225000,
        'discount_price' => 15,
        'old_price' => 264705,
    ],
    [
        'title' => 'Cotton T-Shirt',
        'description' => '100% organic cotton, breathable fabric',
        'image' => 'storage/uploads/products/1/banner/Cotton_T-Shirt.webp',
        'category_id' => 2,
        'store_id' => 1,
        'quantity' => 200,
        'price' => 2000,
        'discount_price' => 25,
        'old_price' => 2667,
    ],
    [
        'title' => 'Running Shoes',
        'description' => 'Lightweight and comfortable for jogging',
        'image' => 'storage/uploads/products/1/banner/Running_Shoes.avif',
        'category_id' => 19,
        'store_id' => 1,
        'quantity' => 80,
        'price' => 8500,
        'discount_price' => 15,
        'old_price' => 10000,
    ],
    [
        'title' => 'Air Fryer 3.5L',
        'description' => 'Cook healthy meals with little to no oil',
        'image' => 'storage/uploads/products/1/banner/Air_Fryer_3.5L.png',
        'category_id' => 3,
        'store_id' => 1,
        'quantity' => 40,
        'price' => 13000,
        'discount_price' => 20,
        'old_price' => 16250,
    ],
    [
        'title' => 'Blender 800W',
        'description' => 'Multi-speed blender with glass jar',
        'image' => 'storage/uploads/products/1/banner/Blender_800W.jpg',
        'category_id' => 3,
        'store_id' => 1,
        'quantity' => 60,
        'price' => 6000,
        'discount_price' => 15,
        'old_price' => 7059,
    ],
    [
        'title' => 'Bluetooth Speaker',
        'description' => 'Portable with deep bass and long battery',
        'image' => 'storage/uploads/products/1/banner/Bluetooth_Speaker.jpg',
        'category_id' => 21,
        'store_id' => 1,
        'quantity' => 70,
        'price' => 7000,
        'discount_price' => 12,
        'old_price' => 7955,
    ],
    [
        'title' => 'LED Desk Lamp',
        'description' => 'Adjustable brightness with USB port',
        'image' => 'storage/uploads/products/1/banner/LED_Desk_Lamp.jpg',
        'category_id' => 12,
        'store_id' => 1,
        'quantity' => 150,
        'price' => 4000,
        'discount_price' => 10,
        'old_price' => 4444,
    ],
    [
        'title' => 'Men\'s Watch Classic',
        'description' => 'Elegant wristwatch with leather band',
        'image' => 'storage/uploads/products/1/banner/Men_s_Watch_Classic.jpg',
        'category_id' => 11,
        'store_id' => 1,
        'quantity' => 35,
        'price' => 15000,
        'discount_price' => 15,
        'old_price' => 17647,
    ],
    [
        'title' => 'Electric Kettle 1.7L',
        'description' => 'Fast boiling with auto shut-off',
        'image' => 'storage/uploads/products/1/banner/Electric_Kettle_1.7L.webp',
        'category_id' => 1,
        'store_id' => 1,
        'quantity' => 90,
        'price' => 5500,
        'discount_price' => 10,
        'old_price' => 6111,
    ],
    [
        'title' => 'Backpack Waterproof',
        'description' => 'Perfect for travel and school use',
        'image' => 'storage/uploads/products/1/banner/Backpack_Waterproof.webp',
        'category_id' => 20,
        'store_id' => 1,
        'quantity' => 110,
        'price' => 7000,
        'discount_price' => 18,
        'old_price' => 8537,
    ],
    [
        'title' => 'Smart Watch FitPro',
        'description' => 'Fitness tracking and heart rate monitor',
        'image' => 'storage/uploads/products/1/banner/Smart_Watch_FitPro.jpg',
        'category_id' => 11,
        'store_id' => 1,
        'quantity' => 55,
        'price' => 11000,
        'discount_price' => 20,
        'old_price' => 13750,
    ],
];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert($this->products);
    }
}
