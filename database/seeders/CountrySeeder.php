<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ['name' => 'Bénin', 'code' => 'BJ', 'icon' => 'bj', 'is_active' => true],
            ['name' => 'Algérie', 'code' => 'DZ', 'icon' => 'dz', 'is_active' => false],
            ['name' => 'Angola', 'code' => 'AO', 'icon' => 'ao', 'is_active' => false],
            ['name' => 'Botswana', 'code' => 'BW', 'icon' => 'bw', 'is_active' => false],
            ['name' => 'Burkina Faso', 'code' => 'BF', 'icon' => 'bf', 'is_active' => false],
            ['name' => 'Burundi', 'code' => 'BI', 'icon' => 'bi', 'is_active' => false],
            ['name' => 'Cameroun', 'code' => 'CM', 'icon' => 'cm', 'is_active' => false],
            ['name' => 'Côte d\'Ivoire', 'code' => 'CI', 'icon' => 'ci', 'is_active' => false],
            ['name' => 'Djibouti', 'code' => 'DJ', 'icon' => 'dj', 'is_active' => false],
            ['name' => 'Égypte', 'code' => 'EG', 'icon' => 'eg', 'is_active' => false],
            ['name' => 'Érythrée', 'code' => 'ER', 'icon' => 'er', 'is_active' => false],
            ['name' => 'Eswatini', 'code' => 'SZ', 'icon' => 'sz', 'is_active' => false],
            ['name' => 'Ethiopie', 'code' => 'ET', 'icon' => 'et', 'is_active' => false],
            ['name' => 'Gabon', 'code' => 'GA', 'icon' => 'ga', 'is_active' => false],
            ['name' => 'Gambie', 'code' => 'GM', 'icon' => 'gm', 'is_active' => false],
            ['name' => 'Ghana', 'code' => 'GH', 'icon' => 'gh', 'is_active' => false],
            ['name' => 'Guinée', 'code' => 'GN', 'icon' => 'gn', 'is_active' => false],
            ['name' => 'Guinée-Bissau', 'code' => 'GW', 'icon' => 'gw', 'is_active' => false],
            ['name' => 'Kenya', 'code' => 'KE', 'icon' => 'ke', 'is_active' => false],
            ['name' => 'Lesotho', 'code' => 'LS', 'icon' => 'ls', 'is_active' => false],
            ['name' => 'Libéria', 'code' => 'LR', 'icon' => 'lr', 'is_active' => false],
            ['name' => 'Libye', 'code' => 'LY', 'icon' => 'ly', 'is_active' => false],
            ['name' => 'Madagascar', 'code' => 'MG', 'icon' => 'mg', 'is_active' => false],
            ['name' => 'Malawi', 'code' => 'MW', 'icon' => 'mw', 'is_active' => false],
            ['name' => 'Mali', 'code' => 'ML', 'icon' => 'ml', 'is_active' => false],
            ['name' => 'Maroc', 'code' => 'MA', 'icon' => 'ma', 'is_active' => false],
            ['name' => 'Maurice', 'code' => 'MU', 'icon' => 'mu', 'is_active' => false],
            ['name' => 'Mauritanie', 'code' => 'MR', 'icon' => 'mr', 'is_active' => false],
            ['name' => 'Mozambique', 'code' => 'MZ', 'icon' => 'mz', 'is_active' => false],
            ['name' => 'Namibie', 'code' => 'NA', 'icon' => 'na', 'is_active' => false],
            ['name' => 'Niger', 'code' => 'NE', 'icon' => 'ne', 'is_active' => false],
            ['name' => 'Nigeria', 'code' => 'NG', 'icon' => 'ng', 'is_active' => false],
            ['name' => 'Rwanda', 'code' => 'RW', 'icon' => 'rw', 'is_active' => false],
            ['name' => 'Sao Tomé-et-Principe', 'code' => 'ST', 'icon' => 'st', 'is_active' => false],
            ['name' => 'Sénégal', 'code' => 'SN', 'icon' => 'sn', 'is_active' => false],
            ['name' => 'Sierra Leone', 'code' => 'SL', 'icon' => 'sl', 'is_active' => false],
            ['name' => 'Somalie', 'code' => 'SO', 'icon' => 'so', 'is_active' => false],
            ['name' => 'Soudan', 'code' => 'SD', 'icon' => 'sd', 'is_active' => false],
            ['name' => 'Tanzanie', 'code' => 'TZ', 'icon' => 'tz', 'is_active' => false],
            ['name' => 'Tchad', 'code' => 'TD', 'icon' => 'td', 'is_active' => false],
            ['name' => 'Togo', 'code' => 'TG', 'icon' => 'tg', 'is_active' => false],
            ['name' => 'Tunisie', 'code' => 'TN', 'icon' => 'tn', 'is_active' => false],
            ['name' => 'Zambie', 'code' => 'ZM', 'icon' => 'zm', 'is_active' => false],
            ['name' => 'Zimbabwe', 'code' => 'ZW', 'icon' => 'zw', 'is_active' => false]
        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert($country);
        }
    }
}