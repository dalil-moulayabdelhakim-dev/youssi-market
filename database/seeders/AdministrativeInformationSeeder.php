<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrativeInformationSeeder extends Seeder
{
    private $info = [
        [
            'email' => 'youssi.market@gmail.com',
            'phone' => '+213656596141',
            'baridimob' => '00799999002787203541',
            'ccp' => '0027872035 41',
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('administrative_information')->insert($this->info);
    }
}
