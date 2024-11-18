@extends('front.layouts.master')
@section('title', 'Comment ca fonctionne ?')
@section('content')

<div class="pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="terms-content">
                    <h3 class="mb-4">Pour les Passagers</h3>
                    <p>Voici les étapes à suivre pour utiliser l'application en tant que passager :</p>

                    <!-- Étape 1 -->
                    <div class="step mt-4">
                        <h5><strong>1. Créer un compte :</strong></h5>
                        <p>Inscrivez-vous en fournissant vos informations personnelles pour accéder à la plateforme.</p>
                        <img src="images/etape1-passager.png" alt="Créer un compte" class="step-image">
                    </div>

                    <!-- Étape 2 -->
                    <div class="step mt-4">
                        <h5><strong>2. Faire une demande de trajet :</strong></h5>
                        <p>Entrez votre lieu de départ, destination, et heure de départ pour trouver des trajets disponibles.</p>
                        <img src="images/etape2-passager.png" alt="Faire une demande de trajet" class="step-image">
                    </div>

                    <!-- Étape 3 -->
                    <div class="step mt-4">
                        <h5><strong>3. Choisir un conducteur :</strong></h5>
                        <p>Consultez les trajets disponibles et choisissez le conducteur qui vous convient.</p>
                        <img src="images/etape3-passager.png" alt="Choisir un conducteur" class="step-image">
                    </div>

                    <!-- Étape 4 -->
                    <div class="step mt-4">
                        <h5><strong>4. Lancer le covoiturage :</strong></h5>
                        <p>Rendez-vous au point de départ et partez avec votre conducteur.</p>
                        <img src="images/etape4-passager.png" alt="Lancer le covoiturage" class="step-image">
                    </div>

                    <!-- Étape 5 -->
                    <div class="step mt-4">
                        <h5><strong>5. Laisser un avis :</strong></h5>
                        <p>Après votre trajet, évaluez votre conducteur et laissez un avis sur votre expérience.</p>
                        <img src="images/etape5-passager.png" alt="Laisser un avis" class="step-image">
                    </div>
                </div>

                <div class="terms-content mt-5">
                    <h3 class="mb-4">Pour les Conducteurs</h3>
                    <p>Voici les étapes à suivre pour utiliser l'application en tant que conducteur :</p>
                    <div class="terms-content mt-5">
                        <h3 class="mb-4">Pour les Conducteurs</h3>
                        <p>Voici les étapes à suivre pour utiliser l'application en tant que conducteur :</p>

                        <!-- Étape 1 -->
                        <div class="step mt-4">
                            <h5><strong>1. Créer un compte :</strong></h5>
                            <p>Inscrivez-vous en fournissant vos informations personnelles et les détails de votre véhicule.</p>
                            <img src="images/etape1-conducteur.png" alt="Créer un compte conducteur" class="step-image">
                        </div>

                        <!-- Étape 2 -->
                        <div class="step mt-4">
                            <h5><strong>2. Proposer un trajet :</strong></h5>
                            <p>Indiquez votre lieu de départ, destination, heure de départ et le nombre de places disponibles.</p>
                            <img src="images/etape2-conducteur.png" alt="Proposer un trajet" class="step-image">
                        </div>

                        <!-- Étape 3 -->
                        <div class="step mt-4">
                            <h5><strong>3. Recevoir des demandes :</strong></h5>
                            <p>Les passagers intéressés par votre trajet enverront une demande que vous pouvez accepter ou refuser.</p>
                            <img src="images/etape3-conducteur.png" alt="Recevoir des demandes" class="step-image">
                        </div>

                        <!-- Étape 4 -->
                        <div class="step mt-4">
                            <h5><strong>4. Accepter un passager :</strong></h5>
                            <p>Examinez les profils des passagers et acceptez ceux qui vous conviennent.</p>
                            <img src="images/etape4-conducteur.png" alt="Accepter un passager" class="step-image">
                        </div>

                        <!-- Étape 5 -->
                        <div class="step mt-4">
                            <h5><strong>5. Recevoir le paiement :</strong></h5>
                            <p>Après le trajet, vous recevrez le paiement directement via l'application.</p>
                            <img src="images/etape5-conducteur.png" alt="Recevoir le paiement" class="step-image">
                        </div>

                        <!-- Étape 6 -->
                        <div class="step mt-4">
                            <h5><strong>6. Laisser un avis :</strong></h5>
                            <p>Après chaque trajet, évaluez vos passagers et laissez un avis sur leur comportement.</p>
                            <img src="images/etape6-conducteur.png" alt="Laisser un avis conducteur" class="step-image">
                        </div>
                    </div>

                    <!-- Répétez les étapes avec des images pour les conducteurs -->
                </div>

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


 @endsection
