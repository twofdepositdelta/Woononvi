@extends('front.layouts.master')
@section('title', 'Comment ca fonctionne ?')
@section('content')

<div class="pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="terms-content">
                    <h3>Pour comprendre ce qu'est le covoiturage urbain</h3>
                    <p>
                        Le covoiturage urbain consiste à partager un trajet avec d'autres passagers
                        ayant la même destination ou un itinéraire proche. C’est une solution moderne
                        qui combine économie, écologie, et convivialité.
                    </p>
                </div>
                <div class="terms-content">
                    <h3>Pourquoi choisir le covoiturage ?</h3>
                    <p>Le covoiturage offre de nombreux avantages pour les passagers et conducteurs :</p>
                    <ul class="terms-list ms-4">
                        <li><strong>Économies :</strong> Réduisez vos coûts de transport en partageant les frais avec d'autres utilisateurs.</li>
                        <li><strong>Réduction de l'empreinte carbone :</strong> Moins de voitures sur la route pour un environnement plus propre.</li>
                        <li><strong>Rencontres sociales :</strong> Échangez avec d'autres personnes pendant vos trajets.</li>
                        <li><strong>Transport sécurisé :</strong> Système d'évaluations pour garantir des trajets fiables et sûrs.</li>
                    </ul>
                </div>
                <div class="terms-content">
                    <h3>Un exemple concret</h3>
                    <p>
                        Imaginez que vous vivez à <strong>Cotonou</strong> et travaillez à <strong>Porto-Novo</strong>.
                        Plutôt que de faire le trajet seul, vous pouvez utiliser <strong>Wononvi</strong>
                        pour trouver des passagers ou des conducteurs allant dans la même direction.
                        Vous économisez sur les frais, contribuez à réduire la pollution et voyagez
                        dans une ambiance conviviale.
                      </p>

                </div>
                <div class="terms-content">
                    <h3>Pour les Passagers</h3>
                    <p>Voici les étapes à suivre pour utiliser l'application en tant que passager :</p>
                    <ul class="terms-list ms-4">
                        <li><strong>Créer un compte :</strong> Inscrivez-vous en fournissant vos informations personnelles pour accéder à la plateforme.</li>
                        <li><strong>Faire une demande de trajet :</strong> Entrez votre lieu de départ, destination, et heure de départ pour trouver des trajets disponibles.</li>
                        <li><strong>Choisir un conducteur :</strong> Consultez les trajets disponibles et choisissez le conducteur qui vous convient.</li>
                        <li><strong>Lancer le covoiturage :</strong> Rendez-vous au point de départ et partez avec votre conducteur.</li>
                        <li><strong>Laisser un avis :</strong> Après votre trajet, évaluez votre conducteur et laissez un avis sur votre expérience.</li>
                    </ul>
                </div>

                <div class="terms-content">
                    <h3>Pour les Conducteurs</h3>
                    <p>Voici les étapes à suivre pour utiliser l'application en tant que conducteur :</p>
                    <ul class="terms-list ms-4">
                        <li><strong>Créer un compte :</strong> Inscrivez-vous en fournissant vos informations personnelles et les détails de votre véhicule.</li>
                        <li><strong>Proposer un trajet :</strong> Indiquez votre lieu de départ, destination, heure de départ et le nombre de places disponibles.</li>
                        <li><strong>Recevoir des demandes :</strong> Les passagers intéressés par votre trajet enverront une demande que vous pouvez accepter ou refuser.</li>
                        <li><strong>Accepter un passager :</strong> Examinez les profils des passagers et acceptez ceux qui vous conviennent.</li>
                        <li><strong>Recevoir le paiement :</strong> Après le trajet, vous recevrez le paiement directement via l'application.</li>
                        <li><strong>Laisser un avis :</strong> Après chaque trajet, évaluez vos passagers et laissez un avis sur leur comportement.</li>
                    </ul>
                </div>
                <div class="terms-content">
                    <div class="text-center mt-5">
                        <h3>Téléchargez l'application</h3>
                        <p>Profitez de toutes les fonctionnalités de <strong>Wononvi</strong> en téléchargeant l'app sur votre mobile !</p>
                        <div class="d-flex justify-content-center">
                            <div class="nav-right">
                                <div class="nav-right-btn mt-2">
                                    <a href="#telechargement" class="theme-btn"><span class="fas fa-download"></span> Télécharger App</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 @endsection
