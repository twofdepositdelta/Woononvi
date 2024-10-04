<header class="header">

    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        <ul>
                            <li><a
                                    href="https://live.themewild.com/cdn-cgi/l/email-protection#b4dddad2dbf4d1ccd5d9c4d8d19ad7dbd9"><i
                                        class="far fa-envelopes"></i>
                                    <span class="__cf_email__"
                                        data-cfemail="82ebece4edc2e7fae3eff2eee7ace1edef">[email&#160;protected]</span></a>
                            </li>
                            <li><a href="tel:+21236547898"><i class="far fa-phone-volume"></i> +2 123 654 7898</a>
                            </li>
                            <li><a href="#"><i class="far fa-alarm-clock"></i> Sun - Fri (08AM - 10PM)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-link">
                        <a href="{{ route('login') }}"><i class="far fa-arrow-right-to-bracket"></i> Login</a>
                        <a href="{{ route('register') }}"><i class="far fa-user-vneck"></i> Register</a>
                    </div>
                    <div class="header-top-social">
                        <span>Follow Us: </span>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
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
                    <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/logo.png') }}" alt="logo citygo">
                </a>
                <div class="mobile-menu-right">
                    <div class="search-btn">
                        <button type="button" class="nav-right-link"><i class="far fa-search"></i></button>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        
                        <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">A Propos</a></li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Services</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="service.html">Service</a></li>
                                <li><a class="dropdown-item" href="service-single.html">Service Single</a></li>
                            </ul>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="#">Actualités</a></li>

                        <li class="nav-item"><a class="nav-link" href="#">Nous-contacter</a></li>
                    </ul>
                    <div class="nav-right">
                        
                        <div class="nav-right-btn mt-2">
                            <a href="#" class="theme-btn"><span class="fas fa-download"></span>Télécharger App</a>
                        </div>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</header>
