<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $users = [
        [
            'name' => 'youssi',
            'email' => 'youssi@gmail.com',
            'phone' => '066666666',
            'address' => 'not yet',
            'store_id' => 1,
            'user_type_id' => 2,
            'wilaya_id' => 16, // الجزائر العاصمة
            'commune_id' => 101, // مثال: باب الزوار
            'password' => null,
        ],
        [
            'name' => 'dalil moulay',
            'email' => 'dalil.moulayabdelhakim@gmail.com',
            'phone' => '0541866598',
            'address' => 'not yet',
            'store_id' => null,
            'user_type_id' => 3,
            'wilaya_id' => 31, // وهران
            'commune_id' => 545, // مثال: السانيا
            'password' => null,
        ],
        [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0541866598',
            'address' => 'not yet',
            'store_id' => null,
            'user_type_id' => 1,
            'wilaya_id' => 16,
            'commune_id' => 102, // مثال: حسين داي
            'password' => null,
        ],
    ];

    public function run(): void
    {
        foreach ($this->users as &$user) {
            $user['password'] = Hash::make('12345678');
        }
        DB::table('users')->insert($this->users);
    }
}
