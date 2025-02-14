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
        $beninCities  = [
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


        //  Liste des villes du Togo

         $togo = Country::where('name', 'Togo')->first();
        if (!$togo) {
            throw new \Exception("Le pays T n'existe pas.");
        }
        $togoId = $togo->id;

        $togoCities = [
            // Région Maritime
            ['name' => 'Lomé', 'status' => true, 'country_id' => $togoId],
            ['name' => 'Tsévié', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Aného', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Vogan', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Tabligbo', 'status' => false, 'country_id' => $togoId],

            // Région des Plateaux
            ['name' => 'Atakpamé', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Kpalimé', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Badou', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Amlamé', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Notsé', 'status' => false, 'country_id' => $togoId],

            // Région Centrale
            ['name' => 'Sokodé', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Tchamba', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Bafilo', 'status' => false, 'country_id' => $togoId],

            // Région de la Kara
            ['name' => 'Kara', 'status' => true, 'country_id' => $togoId],
            ['name' => 'Bassar', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Niamtougou', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Pagouda', 'status' => false, 'country_id' => $togoId],

            // Région des Savanes
            ['name' => 'Dapaong', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Mango', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Tandjouaré', 'status' => false, 'country_id' => $togoId],
            ['name' => 'Cinkassé', 'status' => false, 'country_id' => $togoId],
        ];


        // Insertion des villes dans la base de données
        City::insert(array_merge($beninCities, $togoCities));
    }
}
