<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentRequestSeeder extends Seeder
{

    private $payment = [
        [
            'store_id' => 1,
            'proof_path' => 'storage/payment_proofs/1/1/1758016446.jpeg',
            'subscription_method_id' => 1,
        ],

        [
            'store_id' => 1,
            'proof_path' => 'storage/payment_proofs/1/1/1758016446.jpeg',
            'subscription_method_id' => 2,
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_requests')->insert($this->payment);
    }
}
