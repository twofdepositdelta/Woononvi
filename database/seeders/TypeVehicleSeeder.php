<?php

namespace Database\Seeders;

use App\Models\TypeVehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = [
            ['label' => 'SUV', 'taux_per_km' => 150,'slug'=>Str::slug('SUV')],
            ['label' => 'Berline', 'taux_per_km' => 100,'slug'=>Str::slug('Berline')],
            ['label' => 'Minivan', 'taux_per_km' => 120,'slug'=>Str::slug('Minivan')],
            ['label' => 'Pick-up', 'taux_per_km' => 130,'slug'=>Str::slug('Pick-up')],
        ];

        foreach ($types as $type) {
            TypeVehicle::create($type);
        }
    }
}
