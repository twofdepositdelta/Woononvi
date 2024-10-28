<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('type_news')->insert([
            [
                'name' => 'mise à jour',
                'slug'=>Str::slug('mise a jour'),
                'description' => 'Informations sur les nouvelles versions ou fonctionnalités',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'promotion',
                'slug'=>Str::slug('promotion'),
                'description' => 'Annonces de codes promotionnels et offres spéciales',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'sécurité',
                'slug'=>Str::slug('sécurité'),
                'description' => 'Conseils et nouveautés en matière de sécurité',

                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'information',
                'slug'=>Str::slug('information'),
                'description' => 'Informations générales ou changements de service',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
