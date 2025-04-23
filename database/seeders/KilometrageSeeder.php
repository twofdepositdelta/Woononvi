<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KilometrageSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = DB::table('categories')->pluck('id', 'slug');

        $tarifs = [
            'voiture' => [
                [1, 10, 40],
                [11, 20, 35],
                [21, 30, 30],
                [31, 40, 25],
                [41, 50, 20],
                [51, 100, 15],
                [101, 150, 10],
                [151, 200, 10],
                [201, 100000, 10],
            ],
            'moto' => [
                [1, 10, 35],
                [11, 20, 32],
                [21, 30, 29],
                [31, 40, 26],
                [41, 50, 23],
                [51, 100, 18],
                [101, 100000, 12],
            ],
            'tricycle' => [
                [1, 10, 38],
                [11, 20, 35],
                [21, 30, 32],
                [31, 40, 28],
                [41, 50, 24],
                [51, 100, 18],
                [101, 100000, 12],
            ]
        ];

        foreach ($tarifs as $slug => $grille) {
            $categorieId = $categories[$slug] ?? null;

            if ($categorieId) {
                foreach ($grille as [$min, $max, $taux]) {
                    DB::table('kilometrages')->insert([
                        'min_km' => $min,
                        'max_km' => $max,
                        'taux_par_km' => $taux,
                        'categorie_id' => $categorieId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
