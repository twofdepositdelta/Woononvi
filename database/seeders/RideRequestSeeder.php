<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Intervention\Image\Geometry\Point;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RideRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('ride_requests')->insert([
            [
                'start_location' => DB::raw("ST_GeomFromText('POINT(2.3912 6.3703)')"), // Cotonou
                'end_location' => DB::raw("ST_GeomFromText('POINT(2.6288 6.4969)')"),   // Porto-Novo
                'seats' => 3,
                'preferred_time' => Carbon::now()->addHours(2),
                'preferred_amount' => 1500,
                'commission_rate' => 10,
                'passenger_id' => 1,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'start_location' => DB::raw("ST_GeomFromText('POINT(2.6099 9.3467)')"), // Parakou
                'end_location' => DB::raw("ST_GeomFromText('POINT(1.3798 10.2964)')"), // Natitingou
                'seats' => 2,
                'preferred_time' => Carbon::now()->addHours(1),
                'preferred_amount' => 5000,
                'commission_rate' => 15,

                'passenger_id' => 2,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'start_location' => DB::raw("ST_GeomFromText('POINT(2.6288 6.4969)')"), // Porto-Novo
                'end_location' => DB::raw("ST_GeomFromText('POINT(2.3912 6.3703)')"), // Cotonou
                'seats' => 4,
                'preferred_time' => Carbon::now()->addHours(3),
                'preferred_amount' => 2000,
                'commission_rate' => 10,
                'passenger_id' => 1,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
