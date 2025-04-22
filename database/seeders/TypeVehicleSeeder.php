<?php

namespace Database\Seeders;

use App\Models\TypeVehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Récupération des ID des catégories
         $voitureId = DB::table('categories')->where('label', 'Voiture')->first()?->id;
         $motoId = DB::table('categories')->where('label', 'Moto')->first()?->id;

         $types = [
             // Voitures
             ['label' => 'Citadine', 'taux_per_km' => 100, 'category_id' => $voitureId],
             ['label' => 'Berline', 'taux_per_km' => 120, 'category_id' => $voitureId],
             ['label' => 'SUV', 'taux_per_km' => 150, 'category_id' => $voitureId],
             ['label' => 'Monospace', 'taux_per_km' => 130, 'category_id' => $voitureId],

             // Motos
             ['label' => 'Scooter', 'taux_per_km' => 60, 'category_id' => $motoId],
             ['label' => 'Moto urbaine', 'taux_per_km' => 70, 'category_id' => $motoId],

         ];


         foreach ($types as $type) {
            DB::table('type_vehicles')->insert([
                'label' => $type['label'],
                'slug' => Str::slug($type['label']),
                'taux_per_km' => $type['taux_per_km'],
                'categorie_id' => $type['category_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
