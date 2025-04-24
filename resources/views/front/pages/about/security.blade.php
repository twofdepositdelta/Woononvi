@extends('front.layouts.master')
@section('title', 'Notre securité')
@section('content')
<!-- Section Profils Vérifiés -->
<div class="security-area pt-50 pb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="security-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="security-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/verified_profile.jpg') }}" alt="Illustration Profils Vérifiés">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="security-right wow fadeInRight" data-wow-delay=".25s">
                    <h3 class="site-title"><span>Profils Vérifiés</span> pour une Communauté Fiable</h3>
                    <p class="security-text">
                        La sécurité commence par la confiance. Chez {{ FrontHelper::getAppName() }}, nous effectuons une vérification minutieuse de chaque profil utilisateur. Avant de rejoindre notre communauté, chaque membre passe par un processus de validation d'identité, garantissant ainsi que seuls des individus de confiance peuvent proposer ou rechercher des trajets. Ce système de vérification contribue à instaurer un climat de sécurité pour que chacun puisse partager un trajet en toute sérénité.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Notation Transparente -->
<div class="security-area pt-50 pb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="security-right wow fadeInRight" data-wow-delay=".25s">
                    <h3 class="site-title">Système de Notation <span>Transparente</span></h3>
                    <p class="security-text">
                        Après chaque trajet, les passagers et les conducteurs peuvent laisser un avis, garantissant la transparence et la fiabilité de notre communauté. Ce système de notation permet à chacun de consulter les expériences passées des autres utilisateurs, renforçant ainsi la confiance dans le choix de partenaires de covoiturage. Les évaluations aident à maintenir un haut niveau de respect et de courtoisie entre membres et encouragent les comportements responsables pour des trajets agréables.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="security-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="security-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/02.png') }}" alt="Illustration Notation Transparente">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Suivi en Temps Réel -->
<div class="security-area pt-50 pb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="security-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="security-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/real_time_tracking.avif') }}" alt="Illustration Suivi en Temps Réel">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="security-right wow fadeInRight" data-wow-delay=".25s">
                    <h3 class="site-title"><span>Suivi en Temps Réel</span> pour Votre Sécurité</h3>
                    <p class="security-text">
                        Le suivi en temps réel permet à chaque utilisateur de savoir où il se trouve à tout moment durant le trajet. Cette fonction offre une tranquillité d’esprit aux passagers, sachant que leurs proches peuvent surveiller leur parcours. Le conducteur, de son côté, bénéficie également d’un trajet sécurisé et peut être localisé en cas de besoin. Cette fonctionnalité renforce la sécurité et fait de {{ FrontHelper::getAppName() }} un choix idéal pour des trajets partagés en toute confiance.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.pages.includes._testimonial-area')

 @endsection
