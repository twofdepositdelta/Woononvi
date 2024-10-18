<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        // Liste des pays africains avec leurs informations, triés par ordre alphabétique
        $countries = [
            ['name' => 'Afrique du Sud', 'icon' => 'fi fi-za', 'code' => 'ZA', 'indicatif' => '+27', 'is_active' => false],
            ['name' => 'Algérie', 'icon' => 'fi fi-dz', 'code' => 'DZ', 'indicatif' => '+213', 'is_active' => false],
            ['name' => 'Angola', 'icon' => 'fi fi-ao', 'code' => 'AO', 'indicatif' => '+244', 'is_active' => false],
            ['name' => 'Bénin', 'icon' => 'fi fi-bj', 'code' => 'BJ', 'indicatif' => '+229', 'is_active' => true],
            ['name' => 'Burkina Faso', 'icon' => 'fi fi-bf', 'code' => 'BF', 'indicatif' => '+226', 'is_active' => false],
            ['name' => 'Burundi', 'icon' => 'fi fi-bi', 'code' => 'BI', 'indicatif' => '+257', 'is_active' => false],
            ['name' => 'Cabo Verde', 'icon' => 'fi fi-cv', 'code' => 'CV', 'indicatif' => '+238', 'is_active' => false],
            ['name' => 'Cameroun', 'icon' => 'fi fi-cm', 'code' => 'CM', 'indicatif' => '+237', 'is_active' => false],
            ['name' => 'Centrafrique', 'icon' => 'fi fi-cf', 'code' => 'CF', 'indicatif' => '+236', 'is_active' => false],
            ['name' => 'Comores', 'icon' => 'fi fi-km', 'code' => 'KM', 'indicatif' => '+269', 'is_active' => false],
            ['name' => 'Congo-Brazzaville', 'icon' => 'fi fi-cg', 'code' => 'CG', 'indicatif' => '+242', 'is_active' => false],
            ['name' => 'Congo-Kinshasa', 'icon' => 'fi fi-cd', 'code' => 'CD', 'indicatif' => '+243', 'is_active' => false],
            ['name' => 'Côte d\'Ivoire', 'icon' => 'fi fi-ci', 'code' => 'CI', 'indicatif' => '+225', 'is_active' => false],
            ['name' => 'Djibouti', 'icon' => 'fi fi-dj', 'code' => 'DJ', 'indicatif' => '+253', 'is_active' => false],
            ['name' => 'Égypte', 'icon' => 'fi fi-eg', 'code' => 'EG', 'indicatif' => '+20', 'is_active' => false],
            ['name' => 'Érythrée', 'icon' => 'fi fi-er', 'code' => 'ER', 'indicatif' => '+291', 'is_active' => false],
            ['name' => 'Eswatini', 'icon' => 'fi fi-sz', 'code' => 'SZ', 'indicatif' => '+268', 'is_active' => false],
            ['name' => 'Éthiopie', 'icon' => 'fi fi-et', 'code' => 'ET', 'indicatif' => '+251', 'is_active' => false],
            ['name' => 'Gabon', 'icon' => 'fi fi-ga', 'code' => 'GA', 'indicatif' => '+241', 'is_active' => false],
            ['name' => 'Gambie', 'icon' => 'fi fi-gm', 'code' => 'GM', 'indicatif' => '+220', 'is_active' => false],
            ['name' => 'Ghana', 'icon' => 'fi fi-gh', 'code' => 'GH', 'indicatif' => '+233', 'is_active' => false],
            ['name' => 'Guinée', 'icon' => 'fi fi-gn', 'code' => 'GN', 'indicatif' => '+224', 'is_active' => false],
            ['name' => 'Guinée-Bissau', 'icon' => 'fi fi-gw', 'code' => 'GW', 'indicatif' => '+245', 'is_active' => false],
            ['name' => 'Kenya', 'icon' => 'fi fi-ke', 'code' => 'KE', 'indicatif' => '+254', 'is_active' => false],
            ['name' => 'Lesotho', 'icon' => 'fi fi-ls', 'code' => 'LS', 'indicatif' => '+266', 'is_active' => false],
            ['name' => 'Libéria', 'icon' => 'fi fi-lr', 'code' => 'LR', 'indicatif' => '+231', 'is_active' => false],
            ['name' => 'Libye', 'icon' => 'fi fi-ly', 'code' => 'LY', 'indicatif' => '+218', 'is_active' => false],
            ['name' => 'Madagascar', 'icon' => 'fi fi-mg', 'code' => 'MG', 'indicatif' => '+261', 'is_active' => false],
            ['name' => 'Malawi', 'icon' => 'fi fi-mw', 'code' => 'MW', 'indicatif' => '+265', 'is_active' => false],
            ['name' => 'Mali', 'icon' => 'fi fi-ml', 'code' => 'ML', 'indicatif' => '+223', 'is_active' => false],
            ['name' => 'Maurice', 'icon' => 'fi fi-mu', 'code' => 'MU', 'indicatif' => '+230', 'is_active' => false],
            ['name' => 'Mauritanie', 'icon' => 'fi fi-mr', 'code' => 'MR', 'indicatif' => '+222', 'is_active' => false],
            ['name' => 'Mozambique', 'icon' => 'fi fi-mz', 'code' => 'MZ', 'indicatif' => '+258', 'is_active' => false],
            ['name' => 'Namibie', 'icon' => 'fi fi-na', 'code' => 'NA', 'indicatif' => '+264', 'is_active' => false],
            ['name' => 'Niger', 'icon' => 'fi fi-ne', 'code' => 'NE', 'indicatif' => '+227', 'is_active' => false],
            ['name' => 'Nigeria', 'icon' => 'fi fi-ng', 'code' => 'NG', 'indicatif' => '+234', 'is_active' => false],
            ['name' => 'Rwanda', 'icon' => 'fi fi-rw', 'code' => 'RW', 'indicatif' => '+250', 'is_active' => false],
            ['name' => 'Sao Tomé-et-Principe', 'icon' => 'fi fi-st', 'code' => 'ST', 'indicatif' => '+239', 'is_active' => false],
            ['name' => 'Sénégal', 'icon' => 'fi fi-sn', 'code' => 'SN', 'indicatif' => '+221', 'is_active' => false],
            ['name' => 'Sierra Leone', 'icon' => 'fi fi-sl', 'code' => 'SL', 'indicatif' => '+232', 'is_active' => false],
            ['name' => 'Somalie', 'icon' => 'fi fi-so', 'code' => 'SO', 'indicatif' => '+252', 'is_active' => false],
            ['name' => 'Soudan', 'icon' => 'fi fi-sd', 'code' => 'SD', 'indicatif' => '+249', 'is_active' => false],
            ['name' => 'Soudan du Sud', 'icon' => 'fi fi-ss', 'code' => 'SS', 'indicatif' => '+211', 'is_active' => false],
            ['name' => 'Tanzanie', 'icon' => 'fi fi-tz', 'code' => 'TZ', 'indicatif' => '+255', 'is_active' => false],
            ['name' => 'Tchad', 'icon' => 'fi fi-td', 'code' => 'TD', 'indicatif' => '+235', 'is_active' => false],
            ['name' => 'Togo', 'icon' => 'fi fi-tg', 'code' => 'TG', 'indicatif' => '+228', 'is_active' => false],
            ['name' => 'Tunisie', 'icon' => 'fi fi-tn', 'code' => 'TN', 'indicatif' => '+216', 'is_active' => false],
            ['name' => 'Uganda', 'icon' => 'fi fi-ug', 'code' => 'UG', 'indicatif' => '+256', 'is_active' => false],
            ['name' => 'Zambie', 'icon' => 'fi fi-zm', 'code' => 'ZM', 'indicatif' => '+260', 'is_active' => false],
            ['name' => 'Zimbabwe', 'icon' => 'fi fi-zw', 'code' => 'ZW', 'indicatif' => '+263', 'is_active' => false],
        ];

        // Insertion des pays dans la base de données
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
