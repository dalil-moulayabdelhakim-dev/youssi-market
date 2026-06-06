<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AdministrativeInformationSeeder::class,
            UserTypeSeeder::class,
            CategorySeeder::class,
            SubscriptionMethodSeeder::class,
            StoreSeeder::class,
            PaymentRequestSeeder::class,
            WilayaDairaComuneSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            ProductImagesSeeder::class,
            //WilayaSeeder::class,
            //CommuneSeeder::class,
            StoreWilayaSeeder::class,
        ]);
    }
}
