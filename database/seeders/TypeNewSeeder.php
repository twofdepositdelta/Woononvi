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
                'name' => 'Notification',
                'slug' => Str::slug('Notification'),
                'description' => 'Annonces essentielles concernant des mises à jour ou des changements importants.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Message email',
                'slug' => Str::slug('Message email'),
                'description' => 'Annonces de promotions, offres spéciales et communications envoyées par email.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blog',
                'slug' => Str::slug('Blog'),
                'description' => 'Articles et conseils sur divers sujets, y compris la sécurité et les meilleures pratiques.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);

    }
}
