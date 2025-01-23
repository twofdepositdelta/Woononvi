<div class="about-area pt-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="about-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/hero.png') }}" alt>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                    <div class="site-heading mb-3">
                        <h2 class="site-title">
                            Simplifiez vos trajets avec <span>{{ FrontHelper::getAppName() }}</span>
                        </h2>
                    </div>
                    <p class="about-text">
                        Profitez d'un covoiturage sécurisé et abordable. {{ FrontHelper::getAppName() }} connecte ceux qui veulent partager leur trajet et voyager en toute sérénité.
                    </p>
                    <div class="about-list-wrapper">
                        <ul class="about-list list-unstyled">
                            <li>
                                <strong>Pour les conducteurs</strong> : Partagez vos trajets et économisez sur vos déplacements.
                            </li>
                            <li>
                                <strong>Pour les passagers</strong> : Trouvez facilement un trajet, économisez et voyagez confortablement.
                            </li>
                            <li>
                                Rejoignez une communauté conviviale et bienveillante.
                            </li>
                        </ul>
                    </div>
                    <a href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/download/woononvi-app.apk') }}" class="theme-btn mt-4"><span class="fas fa-download"></span> Télécharger l'App</a>
                </div>
            </div>
        </div>
    </div>
</div>
