<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Liste étendue des villes avec leur statut d'activation, triées par ordre alphabétique
        $cities = [
            ['name' => 'Abomey', 'status' => true],
            ['name' => 'Abomey-Calavi', 'status' => true],
            ['name' => 'Allada', 'status' => false],
            ['name' => 'Aplahoué', 'status' => false],
            ['name' => 'Banikoara', 'status' => false],
            ['name' => 'Bantè', 'status' => false],
            ['name' => 'Bassila', 'status' => false],
            ['name' => 'Bembèrèkè', 'status' => false],
            ['name' => 'Bétérou', 'status' => false],
            ['name' => 'Bohicon', 'status' => true],
            ['name' => 'Cotonou', 'status' => true],
            ['name' => 'Comè', 'status' => false],
            ['name' => 'Dassa-Zoumé', 'status' => false],
            ['name' => 'Djougou', 'status' => false],
            ['name' => 'Dogbo', 'status' => false],
            ['name' => 'Kandi', 'status' => false],
            ['name' => 'Kétou', 'status' => false],
            ['name' => 'Kouandé', 'status' => false],
            ['name' => 'Lokossa', 'status' => false],
            ['name' => 'Malanville', 'status' => false],
            ['name' => 'Natitingou', 'status' => false],
            ['name' => 'Nikki', 'status' => false],
            ['name' => 'Ouidah', 'status' => true],
            ['name' => 'Parakou', 'status' => false],
            ['name' => 'Pobè', 'status' => false],
            ['name' => 'Porto-Novo', 'status' => true],
            ['name' => 'Savalou', 'status' => false],
            ['name' => 'Savè', 'status' => false],
            ['name' => 'Tanguiéta', 'status' => false],
            ['name' => 'Tchaourou', 'status' => false],
        ];

        // Insertion des villes dans la base de données
        foreach ($cities as $city) {
            City::create($city);
        }
    }
}