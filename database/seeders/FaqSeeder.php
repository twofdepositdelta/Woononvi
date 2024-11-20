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
                'question' => 'Comment modifier ma réservation ?',
                'slug' => Str::slug('Comment modifier ma réservation ?'),
                'answer' => 'Pour modifier votre réservation, accédez à votre profil, sélectionnez la réservation concernée, puis effectuez les modifications souhaitées.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Est-il possible de réserver un trajet pour plusieurs passagers ?',
                'slug' => Str::slug('Est-il possible de réserver un trajet pour plusieurs passagers ?'),
                'answer' => 'Oui, vous pouvez indiquer le nombre de passagers lors de la réservation, à condition que le conducteur dispose de suffisamment de places disponibles.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Puis-je évaluer un conducteur après un trajet ?',
                'slug' => Str::slug('Puis-je évaluer un conducteur après un trajet ?'),
                'answer' => 'Oui, après chaque trajet, vous aurez la possibilité de laisser un avis et une note sur le conducteur pour partager votre expérience.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment signaler un problème avec un conducteur ?',
                'slug' => Str::slug('Comment signaler un problème avec un conducteur ?'),
                'answer' => 'Vous pouvez signaler un problème en contactant le support client via votre compte, en précisant les détails de l’incident.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Les enfants sont-ils autorisés à voyager en tant que passagers ?',
                'slug' => Str::slug('Les enfants sont-ils autorisés à voyager en tant que passagers ?'),
                'answer' => 'Oui, les enfants peuvent voyager, mais ils doivent être accompagnés d’un adulte. Certains conducteurs peuvent exiger des sièges pour enfants.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Que se passe-t-il si le conducteur annule le trajet ?',
                'slug' => Str::slug('Que se passe-t-il si le conducteur annule le trajet ?'),
                'answer' => 'En cas d’annulation par le conducteur, vous serez immédiatement informé et aurez la possibilité de réserver un autre trajet ou demander un remboursement.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Puis-je voyager avec mes bagages ?',
                'slug' => Str::slug('Puis-je voyager avec mes bagages ?'),
                'answer' => 'Oui, mais nous vous recommandons de vérifier avec le conducteur si la capacité du véhicule permet de transporter vos bagages.',
                'faq_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment fixer le prix de mes trajets ?',
                'slug' => Str::slug('Comment fixer le prix de mes trajets ?'),
                'answer' => 'Le prix de vos trajets peut être défini en fonction de la distance et des recommandations de la plateforme. Vous avez également la possibilité de le personnaliser.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Que faire si un passager annule un trajet ?',
                'slug' => Str::slug('Que faire si un passager annule un trajet ?'),
                'answer' => 'Si un passager annule un trajet, vous serez informé via la plateforme. Les conditions d’annulation peuvent inclure des frais pour le passager, selon les règles de la plateforme.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment gérer les avis laissés par les passagers ?',
                'slug' => Str::slug('Comment gérer les avis laissés par les passagers ?'),
                'answer' => 'Vous pouvez consulter les avis sur votre profil. Si un avis est injustifié, contactez le support pour le signaler.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Puis-je refuser un passager ?',
                'slug' => Str::slug('Puis-je refuser un passager ?'),
                'answer' => 'Oui, en cas de problème ou d’incompatibilité, vous avez la possibilité de refuser un passager avant la confirmation de la réservation.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quelles sont les règles à respecter en tant que conducteur ?',
                'slug' => Str::slug('Quelles sont les règles à respecter en tant que conducteur ?'),
                'answer' => 'Respectez les horaires des trajets, maintenez un véhicule propre et soyez courtois envers les passagers pour garantir une bonne expérience.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Puis-je signaler un passager problématique ?',
                'slug' => Str::slug('Puis-je signaler un passager problématique ?'),
                'answer' => 'Oui, vous pouvez signaler un passager en contactant le support client. Fournissez des détails sur l’incident pour une meilleure gestion.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Comment augmenter mes chances de recevoir des réservations ?',
                'slug' => Str::slug('Comment augmenter mes chances de recevoir des réservations ?'),
                'answer' => 'Maintenez un bon profil, proposez des trajets à des horaires populaires, et recevez de bons avis des passagers.',
                'faq_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
