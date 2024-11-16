<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        <ul>
                            <li><a href="mailto:contact@wononvi.com"><i class="far fa-envelope"></i> contact@wononvi.com</a></li>
                            <li><a href="tel:+22912345678"><i class="far fa-phone-volume"></i> +229 12 34 56 78</a></li>
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
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/logo.png') }}" alt="logo wononvi">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">

                        <!-- A Propos (avec sous-menus) -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">À Propos</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="{{ route('index') }}">Accueil</a></li>
                                <li><a class="dropdown-item" href="#vision">Notre Vision</a></li>
                                <li><a class="dropdown-item" href="#mission">Notre Mission</a></li>
                                <li><a class="dropdown-item" href="#communaute">Notre Communauté</a></li>
                                <li><a class="dropdown-item" href="#securite">Notre Sécurité</a></li>
                                <li><a class="dropdown-item" href="#presentation">Présentation</a></li>
                                <li><a class="dropdown-item" href="#fonctionnalites">Comment ça fonctionne ?</a></li>
                            </ul>
                        </li>

                        <!-- Documentation (avec sous-menus) -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Documentation</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="#comment-ca-fonctionne">Comment ça fonctionne ?</a></li>
                                <li><a class="dropdown-item" href="#faq">FAQ Technique</a></li>
                            </ul>
                        </li>

                        <!-- Devenir Conducteur et Passager -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Rejoignez-nous</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="#devenir-conducteur">Devenir Conducteur</a></li>
                                <li><a class="dropdown-item" href="#devenir-passager">Devenir Passager</a></li>
                            </ul>
                        </li>

                        <!-- Accueil -->
                        <li class="nav-item"><a class="nav-link" href="/">Actualités</a></li>
                    </ul>

                    <!-- Bouton de téléchargement -->
                    <div class="nav-right">
                        <div class="nav-right-btn mt-2">
                            <a href="#telechargement" class="theme-btn"><span class="fas fa-download"></span> Télécharger App</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
