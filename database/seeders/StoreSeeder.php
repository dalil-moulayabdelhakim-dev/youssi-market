<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use function Symfony\Component\Clock\now;

class StoreSeeder extends Seeder
{
    private $stores = [
        [
            'name' => 'youssi market',
            'category' => 'Not yet',
            'address' => 'Not yet',
            'contact' =>'Youssi@gmail.com',
            'trial_ends_at'=> null,
            'subscription_ends_at' => null,
            'commission_rate' => 3
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < count($this->stores); $i++){
            $this->stores[$i]['trial_ends_at'] = Carbon::now()->addMonth();
        }
        DB::table('stores')->insert($this->stores);
    }
}
