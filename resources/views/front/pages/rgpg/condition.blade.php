@extends('front.layouts.master')

@section('title', 'Conditons d\utilisation')
@section('content')
    <div class="py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">Nos Conditons d'utilisation</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="terms-content">
                        <h3>Conditions Générales d'Utilisation de {{ FrontHelper::getAppName() }}</h3>
                        <p>Bienvenue sur {{ FrontHelper::getAppName() }}, votre plateforme de covoiturage dédiée à la mobilité durable et partagée. En accédant à notre service, vous acceptez de vous conformer aux présentes conditions générales d'utilisation. Veuillez les lire attentivement avant d'utiliser nos services.</p>
                    </div>

                    <div class="terms-content">
                        <h3>1. Acceptation des Conditions</h3>
                        <p>En utilisant l'application {{ FrontHelper::getAppName() }}, vous acceptez ces <strong>Conditions Générales d'Utilisation</strong>. Si vous n'acceptez pas ces conditions, vous ne devez pas utiliser notre plateforme. Nous nous réservons le droit de modifier ces conditions à tout moment, et les utilisateurs seront informés des modifications majeures via notre plateforme.</p>
                    </div>

                    <div class="terms-content">
                        <h3>2. Inscription et Responsabilités de l'Utilisateur</h3>
                        <p>Pour utiliser les services de covoiturage sur {{ FrontHelper::getAppName() }}, vous devez vous inscrire et créer un compte en fournissant des informations exactes et complètes. Vous vous engagez à :</p>
                        <ul class="terms-list ms-4">
                            <li>Fournir des informations à jour et véridiques lors de votre inscription.</li>
                            <li>Maintenir la confidentialité de vos informations de connexion.</li>
                            <li>Être responsable de l’utilisation de votre compte et des activités réalisées sous votre nom.</li>
                        </ul>
                        <p><strong>Certification des Comptes</strong> : Pour garantir la sécurité des utilisateurs, seuls les comptes certifiés peuvent effectuer des réservations ou proposer des trajets. Le processus de certification inclut la vérification de vos informations personnelles et la validation de votre identité.</p>
                    </div>

                    <div class="terms-content">
                        <h3>3. Services Offerts par {{ FrontHelper::getAppName() }}</h3>
                        <p>{{ FrontHelper::getAppName() }} offre une plateforme de mise en relation entre conducteurs et passagers, permettant de partager un trajet tout en optimisant les coûts et l'impact environnemental. En tant qu'utilisateur, vous pouvez :</p>
                        <ul class="terms-list ms-4">
                            <li><strong>Passager</strong> : Réserver un trajet auprès d'un conducteur vérifié.</li>
                            <li><strong>Conducteur</strong> : Proposer vos trajets pour permettre à des passagers de vous rejoindre.</li>
                        </ul>
                    </div>

                    <div class="terms-content">
                        <h3>4. Sécurité et Comportement des Utilisateurs</h3>
                        <p>Nous accordons une grande importance à la sécurité de nos utilisateurs. Les conducteurs sont tenus de respecter les règles de sécurité routière et d’offrir un environnement de conduite sûr et confortable pour les passagers. En tant qu'utilisateur, vous vous engagez à :</p>
                        <ul class="terms-list ms-4">
                            <li>Respecter toutes les lois locales de circulation et à conduire de manière responsable.</li>
                            <li>Ne pas adopter de comportement abusif ou dangereux pendant un trajet.</li>
                            <li>Signaler tout comportement inapproprié ou suspect à l’équipe de support {{ FrontHelper::getAppName() }}.</li>
                        </ul>
                    </div>

                    <div class="terms-content">
                        <h3>5. Politique de Paiement et Tarification</h3>
                        <p>Tous les paiements pour les trajets réservés via {{ FrontHelper::getAppName() }} se font directement sur la plateforme. Le prix de chaque trajet est déterminé par le conducteur et peut varier en fonction de la distance, de la durée et d’autres critères.</p>
                        <ul class="terms-list ms-4">
                            <li><strong>Méthodes de paiement</strong> : Nous acceptons les paiements par carte bancaire, PayPal et d'autres moyens de paiement sécurisés.</li>
                            <li><strong>Confirmation de paiement</strong> : Une fois le paiement effectué, une confirmation vous sera envoyée par email et via l'application.</li>
                        </ul>
                        <p>Les conducteurs doivent s'assurer que les informations de paiement sont correctes avant de confirmer leur trajet. En cas de problème de paiement, {{ FrontHelper::getAppName() }} se réserve le droit de suspendre ou annuler la réservation.</p>
                    </div>

                    <div class="terms-content">
                        <h3>6. Politique de Remboursement</h3>
                        <p>Les utilisateurs peuvent demander un remboursement dans certains cas. Cela inclut les annulations effectuées avant le début du trajet. Pour être éligible à un remboursement, l'annulation doit être effectuée dans un délai raisonnable et conformément à nos conditions.</p>
                        <ul class="terms-list ms-4">
                            <li><strong>Remboursement partiel ou total</strong> : Un remboursement complet peut être effectué si le trajet est annulé dans les 24 heures suivant la réservation. Pour les annulations tardives, un remboursement partiel peut être accordé selon les circonstances.</li>
                        </ul>
                        <p>Les demandes de remboursement doivent être soumises au support client avec toutes les informations nécessaires pour évaluer la situation.</p>
                    </div>

                    <div class="terms-content">
                        <h3>7. Utilisation des Cookies et Collecte des Données</h3>
                        <p>Nous utilisons des cookies pour améliorer votre expérience de navigation et pour personnaliser les services que nous vous proposons. Les cookies permettent de mémoriser vos préférences et de vous offrir une expérience de navigation fluide. Vous avez la possibilité de refuser l'utilisation des cookies via les paramètres de votre navigateur.</p>
                        <p>Nous collectons également certaines informations personnelles pour améliorer la sécurité et le service, notamment les informations de localisation pour vous aider à trouver des trajets et des conducteurs proches de vous.</p>
                    </div>

                    <div class="terms-content">
                        <h3>8. Hyperliens et Utilisation du Contenu</h3>
                        <p>Vous êtes autorisé à créer un lien vers notre site web sous réserve de respecter les conditions suivantes :</p>
                        <ul class="terms-list ms-4">
                            <li>Ne pas modifier notre contenu ni le présenter de manière trompeuse.</li>
                            <li>Ne pas utiliser nos logos ou marques déposées sans autorisation préalable.</li>
                            <li>Assurez-vous que les liens pointent directement vers les pages officielles de notre application.</li>
                        </ul>
                    </div>

                    <div class="terms-content">
                        <h3>9. Déni de Responsabilité</h3>
                        <p>Bien que nous nous efforcions de maintenir un service sans faille, nous ne garantissons pas que l’application {{ FrontHelper::getAppName() }} sera toujours disponible ou sans erreur. Vous acceptez d'utiliser l'application à vos propres risques.</p>
                        <p>{{ FrontHelper::getAppName() }} ne pourra être tenu responsable des pertes ou dommages résultant de l'utilisation de la plateforme, qu'ils soient directs ou indirects, y compris mais sans s'y limiter, les dommages liés à la sécurité des données ou à des erreurs dans les trajets.</p>
                    </div>

                    <div class="terms-content">
                        <h3>10. Modifications des Conditions</h3>
                        <p>{{ FrontHelper::getAppName() }} se réserve le droit de modifier ces conditions générales d'utilisation à tout moment. Les utilisateurs seront informés des modifications importantes via une notification sur l'application. Il est de votre responsabilité de consulter régulièrement les conditions d'utilisation afin de prendre connaissance de toute mise à jour.</p>
                    </div>

                    <div class="terms-content">
                        <h3>Contact et Support</h3>
                        <p>Pour toute question concernant nos conditions d'utilisation ou pour signaler un problème avec un trajet, contactez notre service client à l’adresse suivante : <strong>support  {{ '@'.FrontHelper::getAppName() }}.com</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
