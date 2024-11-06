<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('faqs')->insert([
            [
                'question' => 'Comment réserver un trajet en tant que passager ?',
                'slug'=>Str::slug('Comment réserver un trajet en tant que passager ?'),
                'answer' => 'Pour réserver un trajet, sélectionnez votre ville de départ, votre destination, et choisissez un trajet disponible. Suivez ensuite les instructions pour finaliser votre réservation.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quels sont les modes de paiement acceptés ?',
                'slug'=>Str::slug('Quels sont les modes de paiement acceptés ?'),
                'answer' => 'Nous acceptons les paiements par carte bancaire, mobile money, et espèces. Assurez-vous de choisir le mode de paiement qui vous convient lors de la réservation.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment annuler une réservation ?',
                'slug'=>Str::slug('Comment annuler une réservation ?'),
                'answer' => 'Pour annuler une réservation, accédez à votre historique de réservations dans votre profil et sélectionnez la réservation que vous souhaitez annuler.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment devenir conducteur sur la plateforme ?',
                'slug'=>Str::slug('Comment devenir conducteur sur la plateforme ?'),
                'answer' => 'Pour devenir conducteur, remplissez le formulaire d\'inscription en tant que conducteur, fournissez les documents nécessaires et attendez la validation de votre compte.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quels documents sont nécessaires pour devenir conducteur ?',
                'slug'=>Str::slug('Quels documents sont nécessaires pour devenir conducteur ?'),
                'answer' => 'Vous aurez besoin de votre permis de conduire, d’une pièce d’identité valide, et de documents relatifs à votre véhicule.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment gérer mes trajets en tant que conducteur ?',
                'slug'=>Str::slug('Comment gérer mes trajets en tant que conducteur ?'),
                'answer' => 'Une fois connecté, vous pouvez gérer vos trajets depuis votre tableau de bord. Vous pourrez y ajouter, modifier ou supprimer vos trajets.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
