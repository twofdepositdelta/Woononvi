<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        <ul>
                            <li>
                                <a href="mailto:{{ FrontHelper::getSettingEmail()->value }}">
                                    <i class="far fa-envelope"></i>
                                    {{ FrontHelper::getSettingEmail()->value }}
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ str_replace(' ', '', FrontHelper::getSettingPhone()->value) }}">
                                    <i class="far fa-phone-volume"></i>
                                    {{ FrontHelper::getSettingPhone()->value }}
                                </a>
                            </li>
                            <li><a href="#"><i class="far fa-alarm-clock"></i> Lun - Dim (06H - 20H)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-link">
                        <a href="{{ route('login') }}"><i class="far fa-arrow-right-to-bracket"></i> Connexion</a>
                    </div>
                    <div class="header-top-social">
                        <span>Suivez-nous :</span>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        {{-- <a href="#"><i class="fab fa-twitter"></i></a> --}}
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        {{-- <a href="#"><i class="fab fa-linkedin"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand logo-text" href="{{ route('index') }}">
                    {{-- <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/logo.png') }}" alt="logo wononvi"> --}}
                    <span class="logo-black">{{ explode('n', FrontHelper::getAppName())[0] }}</span><span class="logo-yellow">n{{ explode('n', FrontHelper::getAppName())[1] }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <!-- A Propos (avec sous-menus) -->
                        <li class="nav-item dropdown {{ request()->routeIs('about') || request()->routeIs('about*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">À Propos</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="{{ route('about') }}">En savoir plus</a></li>
                                <li><a class="dropdown-item" href="{{ route('about') }}#communaute">Notre Communauté</a></li>
                                <li><a class="dropdown-item" href="{{ route('about') }}#vision">Notre Vision</a></li>
                                <li><a class="dropdown-item" href="{{ route('security.front') }}">Notre Sécurité</a></li>
                            </ul>
                        </li>

                        <!-- Documentation (avec sous-menus) -->
                        <li class="nav-item dropdown {{ request()->routeIs('fonction.front') || request()->routeIs('faqs.front') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Documentation</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="{{ route('fonction.front') }}">Comment ça fonctionne ?</a></li>
                                <li><a class="dropdown-item" href="{{ route('faqs.front') }}">FAQ Technique</a></li>
                            </ul>
                        </li>

                        <!-- Devenir Conducteur et Passager -->
                        <li class="nav-item dropdown {{ request()->routeIs('joinUs') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Rejoignez-nous</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="{{ route('joinUs') }}#devenir-conducteur">Devenir Conducteur</a></li>
                                <li><a class="dropdown-item" href="{{ route('joinUs') }}#devenir-passager">Devenir Passager</a></li>
                            </ul>
                        </li>

                        <!-- Accueil -->
                        <li class="nav-item {{ request()->routeIs('news') ? 'active' : '' }}"><a class="nav-link" href="{{ route('news') }}">Actualités</a></li>
                    </ul>

                    <!-- Bouton de téléchargement -->
                    <div class="nav-right">
                        <div class="nav-right-btn mt-2">
                            <a href="{{ route('download') }}" class="theme-btn"><span class="fas fa-download"></span> Télécharger App</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
