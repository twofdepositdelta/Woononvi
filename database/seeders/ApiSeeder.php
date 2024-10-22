<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApiSeeder extends Seeder
{
    public function run()
    {
        DB::table('apis')->insert([
            [
                'maps' => 'https://api.mapsprovider.com/v1/',
                'feedpay_public' => 'pk_live_1234567890abcdef',
                'feedpay_private' => 'sk_live_1234567890abcdef',
                'feedpay_secret' => 'secret_1234567890abcdef',
                'kkiapay_public' => 'pk_live_abcdef1234567890',
                'kkiapay_private' => 'sk_live_abcdef1234567890',
                'kkiapay_secret' => 'secret_abcdef1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
