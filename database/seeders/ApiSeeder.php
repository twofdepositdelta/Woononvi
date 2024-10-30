<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApiSeeder extends Seeder
{
    public function run()
    {
        DB::table('apis')->insert([
            [
                'name' => "google",
                'maps' => 'https://api.mapsprovider.com/v1/',
                'slug'=>Str::slug('google'),
                'feedpay_public' => null,
                'feedpay_private' => null,
                'feedpay_secret' => null,
                'kkiapay_public' => null,
                'kkiapay_private' => null,
                'kkiapay_secret' => null,
                'environment_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "feedpay",
                'maps' => null,
                'slug'=>Str::slug('sk_live_1234567890abcdef'),
                'feedpay_public' => 'pk_live_1234567890abcdef',
                'feedpay_private' => 'sk_live_1234567890abcdef',
                'feedpay_secret' => 'secret_1234567890abcdef',
                'kkiapay_public' => null,
                'kkiapay_private' => null,
                'kkiapay_secret' => null,
                'environment_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "feedpay",
                'maps' => null,
                'slug'=>Str::slug('sk_live_21234567890abcdef'),
                'feedpay_public' => null,
                'feedpay_private' => 'sk_live_21234567890abcdef',
                'feedpay_secret' => 'secret_2234567890abcdef',
                'kkiapay_public' => null,
                'kkiapay_private' => null,
                'kkiapay_secret' => null,
                'environment_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "kkiapay",
                'maps' => null,
                'slug'=>Str::slug('sk_live_abcdef1234567890'),
                'feedpay_public' => null,
                'feedpay_private' => null,
                'feedpay_secret' => null,
                'kkiapay_public' => 'pk_live_abcdef1234567890',
                'kkiapay_private' => 'sk_live_abcdef1234567890',
                'kkiapay_secret' => 'secret_abcdef1234567890',
                'environment_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "kkiapay",
                'maps' => null,
                'slug'=>Str::slug('sk_live_bacdef1234567890'),
                'feedpay_public' => null,
                'feedpay_private' => null,
                'feedpay_secret' => null,
                'kkiapay_public' => null,

                'kkiapay_private' => 'sk_live_bacdef1234567890',
                'kkiapay_secret' => 'secret_bacdef1234567890',
                'environment_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
