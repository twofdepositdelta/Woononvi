<?php

namespace Database\Seeders;

use App\Models\CityGo;
use Illuminate\Database\Seeder;

class CityGoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        CityGo::factory(10)->create();
    }
}
