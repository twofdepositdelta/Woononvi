<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Country;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer le pays Bénin
        $benin = Country::where('name', 'Bénin')->first();
        if (!$benin) {
            throw new \Exception("Le pays Bénin n'existe pas.");
        }
        $beninId = $benin->id;

        // Liste étendue des villes avec leur statut d'activation et country_id
        $cities = [
            ['name' => 'Abomey', 'status' => true, 'country_id' => $beninId],
            ['name' => 'Abomey-Calavi', 'status' => true, 'country_id' => $beninId],
            ['name' => 'Allada', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Aplahoué', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Banikoara', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Bantè', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Bassila', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Bembèrèkè', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Bétérou', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Bohicon', 'status' => true, 'country_id' => $beninId],
            ['name' => 'Cotonou', 'status' => true, 'country_id' => $beninId],
            ['name' => 'Comè', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Dassa-Zoumé', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Djougou', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Dogbo', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Kandi', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Kétou', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Kouandé', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Lokossa', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Malanville', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Natitingou', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Nikki', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Ouidah', 'status' => true, 'country_id' => $beninId],
            ['name' => 'Parakou', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Pobè', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Porto-Novo', 'status' => true, 'country_id' => $beninId],
            ['name' => 'Savalou', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Savè', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Tanguiéta', 'status' => false, 'country_id' => $beninId],
            ['name' => 'Tchaourou', 'status' => false, 'country_id' => $beninId],
        ];

        // Insertion des villes dans la base de données
        City::insert($cities);
    }
}