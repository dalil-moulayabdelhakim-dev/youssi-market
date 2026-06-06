<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private $categories = [
    [
        'name' => 'electronics',
        'path' => 'img/categories/v1/electronics.png',
    ],
    [
        'name' => 'clothing',
        'path' => 'img/categories/v1/clothing.png',
    ],
    [
        'name' => 'home_kitchen',
        'path' => 'img/categories/v1/home_kitchen.png',
    ],
    [
        'name' => 'sports_outdoors',
        'path' => 'img/categories/v1/sports_outdoors.png',
    ],
    [
        'name' => 'toys_games',
        'path' => 'img/categories/v1/toys_games.png',
    ],
    [
        'name' => 'books',
        'path' => 'img/categories/v1/books.png',
    ],
    [
        'name' => 'automotive',
        'path' => 'img/categories/v1/automotive.png',
    ],
    [
        'name' => 'groceries',
        'path' => 'img/categories/v1/groceries.png',
    ],
    [
        'name' => 'pet_supplies',
        'path' => 'img/categories/v1/pet_supplies.png',
    ],
    [
        'name' => 'jewelry',
        'path' => 'img/categories/v1/jewelry.png',
    ],
    [
        'name' => 'watches',
        'path' => 'img/categories/v1/watches.png',
    ],
    [
        'name' => 'office_supplies',
        'path' => 'img/categories/v1/office_supplies.png',
    ],
    [
        'name' => 'baby_products',
        'path' => 'img/categories/v1/baby_products.png',
    ],
    [
        'name' => 'garden_outdoors',
        'path' => 'img/categories/v1/garden_outdoors.png',
    ],
    [
        'name' => 'tools_hardware',
        'path' => 'img/categories/v1/tools_hardware.png',
    ],
    [
        'name' => 'musical_instruments',
        'path' => 'img/categories/v1/musical_instruments.png',
    ],
    [
        'name' => 'video_games',
        'path' => 'img/categories/v1/video_games.png',
    ],
    [
        'name' => 'movies_tv',
        'path' => 'img/categories/v1/movies_tv.png',
    ],
    [
        'name' => 'shoes',
        'path' => 'img/categories/v1/shoes.png',
    ],
    [
        'name' => 'bags_wallets',
        'path' => 'img/categories/v1/bags_wallets.png',
    ],
    [
        'name' => 'mobile_accessories',
        'path' => 'img/categories/v1/mobile_accessories.png',
    ],
];


    public function run(): void
    {
        DB::table('categories')->insert($this->categories);
    }
}
