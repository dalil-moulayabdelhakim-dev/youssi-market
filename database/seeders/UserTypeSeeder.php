<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{

    private $userType =[
        [
            'name' => 'Admin',
        ],
        [
            'name' => 'Store Owner',
        ],
        [
            'name' => 'Client',
        ],
    ];

    public function run(): void
    {
        DB::table('user_types')->insert($this->userType);
    }
}
