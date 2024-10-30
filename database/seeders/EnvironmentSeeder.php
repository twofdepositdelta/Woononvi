<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvironmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('environments')->insert([
            [
                'environment_type' => 'sandbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'environment_type' => 'live',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
