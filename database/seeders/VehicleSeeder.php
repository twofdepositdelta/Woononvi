<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use App\Helpers\BackHelper;
use App\Models\TypeVehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $vehicles = [
            [
                'licence_plate' => 'AB123CD',
                'vehicle_mark' => 'Toyota',
                'vehicle_model' => 'Corolla',
                'vehicle_year' => 2018,
                'seats' => 4,
                'logbook' => 'logbook_1.pdf',
                'color' => 'Rouge',
                'main_image' => BackHelper::getEnvFolder() . 'storage/front/assets/img/taxi/01.png',
                'slug' => Str::slug('AB123CD'),
                'driver_id' => User::inRandomOrder()->first()->id,
                'type_vehicle_id' => TypeVehicle::where('label', 'Berline')->first()->id,
            ],
            [
                'licence_plate' => 'EF456GH',
                'vehicle_mark' => 'Honda',
                'vehicle_model' => 'Civic',
                'vehicle_year' => 2020,
                'seats' => 5,
                'logbook' => 'logbook_2.pdf',
                'color' => 'Bleu',
                'main_image' =>  BackHelper::getEnvFolder() . 'storage/front/assets/img/taxi/01.png',
                'slug'=>Str::slug('EF456GH'),
                'driver_id' => User::inRandomOrder()->first()->id,
                'type_vehicle_id' => TypeVehicle::where('label', 'SUV')->first()->id,
            ],
            [
                'licence_plate' => 'IJ789KL',
                'vehicle_mark' => 'Nissan',
                'vehicle_model' => 'Rogue',
                'vehicle_year' => 2019,
                'seats' => 7,
                'logbook' => 'logbook_3.pdf',
                'color' => 'Noir',
                'main_image' => BackHelper::getEnvFolder() . 'storage/front/assets/img/taxi/01.png',
                'slug'=>Str::slug('IJ789KL'),
                'driver_id' => User::inRandomOrder()->first()->id,
                'type_vehicle_id' => TypeVehicle::where('label', 'Minivan')->first()->id,
            ]
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }

}
