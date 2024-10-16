@include('front.layouts.partials.start')

<main class="main">
    <div class="error-area py-120">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <div class="error-wrapper text-center">
                    <div class="error-img">
                        @php
                            // Récupérer le code d'erreur
                            $code = session('code', '404'); // Valeur par défaut si aucune session n'est définie

                            // Déterminer le chemin de l'image en fonction du code d'erreur
                            switch ($code) {
                                case '404':
                                    $imagePath = '404.png';
                                    break;
                                case '500':
                                    $imagePath = '500.png';
                                    break;
                                case '403':
                                    $imagePath = '403.png';
                                    break;
                                case '401':
                                    $imagePath = '401.png';
                                    break;
                                case '429':
                                    $imagePath = '429.png';
                                    break;
                                case '503':
                                    $imagePath = '503.png';
                                    break;
                                case '419':
                                    $imagePath = '419.png'; // Ajout du cas 419 pour les pages expirées
                                    break;
                                // Ajoute d'autres cas selon tes besoins
                                default:
                                    $imagePath = 'default.png'; // Image par défaut si le code d'erreur ne correspond à aucun cas
                            }

                            $fullImagePath = FrontHelper::getEnvFolder() . 'storage/front/assets/img/error/' . $imagePath;
                        @endphp
                        <img src="{{ asset($fullImagePath) }}" alt="{{ $code }} @yield('title')">
                    </div>
                    <h2>Oups... @yield('title') !</h2>
                    <p>@yield('message')</p>
                    <a href="{{ url('/') }}" class="theme-btn">Retour à l'accueil <i class="far fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</main>

@include('front.layouts.partials.end')
