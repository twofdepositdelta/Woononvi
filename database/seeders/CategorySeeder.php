<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'label' => 'Voiture',
                'slug' => Str::slug('Voiture'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Moto',
                'slug' => Str::slug('Moto'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Tricycle',
                'slug' => Str::slug('Tricycle'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
