<footer class="footer-area">
    <div class="footer-shape">
        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/shape/shape-8.png') }}" alt>
    </div>
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-100 pb-70">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/logo-light.png') }}" alt>
                        </a>
                        <p class="mb-3">
                            Wononvi, la plateforme de covoiturage qui favorise la fraternité, la sécurité et l'accessibilité pour tous.
                        </p>
                        <ul class="footer-contact">
                            <li><a href="tel:+22912345678"><i class="far fa-phone"></i>+229 12 34 56 78</a></li>
                            <li><i class="far fa-map-marker-alt"></i>Cotonou, Bénin</li>
                            <li><a href="mailto:contact@wononvi.com"><i class="far fa-envelope"></i> contact@wononvi.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Liens Rapides</h4>
                        <ul class="footer-list">
                            <li><a href="#"><i class="fas fa-caret-right"></i> À Propos de Nous</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Actualités</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Témoignages</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Conditions d'utilisation</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Politique de confidentialité</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Nos Conducteurs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Centre de Support</h4>
                        <ul class="footer-list">
                            <li><a href="#"><i class="fas fa-caret-right"></i> FAQ</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Affiliation</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Conseils de réservation</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Réserver un trajet</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fas fa-caret-right"></i> Contactez-nous</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i> Plan du site</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Newsletter</h4>
                        <div class="footer-newsletter">
                            <p>Abonnez-vous pour recevoir les dernières actualités et offres de Wononvi.</p>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="email" class="form-control" placeholder="Votre Email">
                                    <button class="theme-btn" type="submit">
                                        S'abonner <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p class="copyright-text">
                        &copy; Copyright {{ date('Y') }} <a href="{{ route('index') }}">Wononvi</a> Tous droits réservés.
                        Développé par <a href="https://twoftechnologies.com/" target="_blank"><span style="color: orange;">TwoF</span> <span style="color: skyblue;">Technologies</span></a>.
                    </p>
                </div>
                <div class="col-md-6 align-self-center">
                    <ul class="footer-social">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-x-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
