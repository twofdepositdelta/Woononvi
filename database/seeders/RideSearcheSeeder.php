<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RideSearch;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RideSearcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RideSearch::create([
            'departure' => 'Cotonou',
            'destination' => 'Porto-Novo',
            'passenger_id' => User::inRandomOrder()->first()->id,
            'created_at' => Carbon::now()->subYear(), // Date de création d'un an passé
        ]);

        RideSearch::create([
            'departure' => 'Parakou',
            'destination' => 'Natitingou',
            'passenger_id' => User::inRandomOrder()->first()->id,
            'created_at' => Carbon::now()->subYear(), // Date de création d'un an passé
        ]);

        RideSearch::create([
            'departure' => 'Abomey',
            'destination' => 'Djougou',
            'passenger_id' => User::inRandomOrder()->first()->id,
        ]);

        RideSearch::create([
            'departure' => 'Bohicon',
            'destination' => 'Malanville',
            'passenger_id' => User::inRandomOrder()->first()->id,
        ]);

        RideSearch::create([
            'departure' => 'Ouidah',
            'destination' => 'Kétou',
            'passenger_id' => User::inRandomOrder()->first()->id,
        ]);

    }
}
