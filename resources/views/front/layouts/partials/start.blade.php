<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content>
    <meta name="keywords" content>

    <title>WONONVI &bull; @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/logo/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/css/style.css') }}">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <style>
        .testimonial-single {
            min-height: 370px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .blog-item-img img {
            width: 100%;
            min-height: 200px;
            object-fit: cover; /* pour que l'image garde ses proportions */
        }

        /* Style pour l'élément actif du menu */
        .navbar-nav .nav-item.active > a {
            color: #FFB300; /* Couleur du texte pour l'élément actif */
            font-weight: bold; /* Mettre en gras l'élément actif pour le distinguer */
        }

        /* Optionnel : survol des éléments */
        .navbar-nav .nav-item > a:hover {
            color: #FFB300; /* Appliquer la même couleur au survol */
        }
    </style>
    @yield('customCSS')
</head>
<body class="{{Route::currentRouteName() == 'index' ? 'home-3':'' }}">

    <div class="preloader">
        <div class="loader-ripple">
            <div></div>
            <div></div>
        </div>
    </div>

