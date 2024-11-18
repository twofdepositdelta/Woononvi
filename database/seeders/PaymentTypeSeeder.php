<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_types')->insert([
            [
                'label' => 'Deposit',
            ],
            [
                'label' => 'Withdraw',
            ],
            [
                'label' => 'Booking',
            ],
        ]);
    }
}
