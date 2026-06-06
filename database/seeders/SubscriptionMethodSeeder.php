<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionMethodSeeder extends Seeder
{
    private $method = [
        [
            'name' => 'monthly',
            'price' => '1000',
        ],

        [
            'name' => 'yearly',
            'price' => '10000',
        ],

        [
            'name' => 'trial',
            'price' => '0'
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscription_methods')->insert($this->method);
    }
}
