<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Wilaya;

class StoreWilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $stores = Store::all();
        $wilayas = Wilaya::all();

        foreach ($stores as $store) {
            foreach ($wilayas as $wilaya) {
                // نضيف كل ولاية مع أسعار عشوائية للمتجر
                $store->wilayas()->attach($wilaya->id, [
                    'price_to_home' => rand(200, 500),
                    'price_to_office' => rand(150, 400),
                ]);
            }
        }
    }
}
