<footer class="footer-area mt-2">

    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-120 pb-70">
                <!-- About Us Section -->
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        {{-- <a href="#" class="footer-logo">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/logo-light.png') }}" alt="{{ FrontHelper::getAppName() }} Logo">
                        </a> --}}
                        <a class="footer-logo logo-text" href="{{ route('index') }}">
                            {{-- <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/logo.png') }}" alt="logo wononvi"> --}}
                            <span class="logo-white">{{ explode('ō', FrontHelper::getAppName())[0] }}ō</span><span class="logo-yellow">{{ explode('ō', FrontHelper::getAppName())[1] }}</span>
                        </a>
                        <p class="mb-3">
                            {{ FrontHelper::getAppName() }}, la plateforme de covoiturage qui favorise la fraternité, la sécurité et l'accessibilité pour tous.
                        </p>
                        <ul class="footer-contact">
                            <li>
                                <a href="tel:{{ str_replace(' ', '', FrontHelper::getSettingPhone()->value) }}">
                                    <i class="far fa-phone"></i>
                                    {{ FrontHelper::getSettingPhone()->value }}
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ FrontHelper::getSettingEmail()->value }}">
                                    <i class="far fa-envelope"></i>
                                    {{ FrontHelper::getSettingEmail()->value }}
                                </a>
                            </li>
                            <li><i class="far fa-map-marker-alt"></i>{{ FrontHelper::getSettingAddress()->value }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Links Section -->
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Liens Rapides</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('about') }}"><i class="fas fa-caret-right"></i> À Propos de Nous</a></li>
                            <li><a href="{{ route('news') }}"><i class="fas fa-caret-right"></i> Actualités</a></li>
                            <li><a href="{{ route('terms') }}"><i class="fas fa-caret-right"></i> Conditions d'utilisation</a></li>
                            <li><a href="{{ route('privacy') }}"><i class="fas fa-caret-right"></i> Politique de confidentialités</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Support Section -->
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Centre de Support</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('joinUs') }}#faq-conducteur"><i class="fas fa-caret-right"></i> FAQ Conducteur</a></li>
                            <li><a href="{{ route('joinUs') }}#faq-passager"><i class="fas fa-caret-right"></i> FAQ Passager</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fas fa-caret-right"></i> Contactez-nous</a></li>
                            <li><a href="{{ route('joinUs') }}#devenir-passager"><i class="fas fa-caret-right"></i> Rejoignez-nous</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter Section -->
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Newsletter</h4>
                        <div class="footer-newsletter">
                            <p>Abonnez-vous pour recevoir les dernières actualités et offres de {{ FrontHelper::getAppName() }}.</p>
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

    <!-- Copyright Section -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p class="copyright-text">
                        &copy; Copyright {{ date('Y') }} <a href="{{ route('index') }}">{{ FrontHelper::getAppName() }}</a> Tous droits réservés.
                        Développé par <a href="https://twoftechnologies.com/" target="_blank"><span style="color: orange;">TwoF</span> <span style="color: skyblue;">Technologies</span></a>.
                    </p>
                </div>
                <div class="col-md-6 align-self-center">
                    <ul class="footer-social">
                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
