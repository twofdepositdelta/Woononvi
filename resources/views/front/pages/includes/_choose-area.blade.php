<div class="choose-area py-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="choose-content">
                    <div class="site-heading wow fadeInDown mb-4" data-wow-delay=".25s">
                        <span class="site-title-tagline text-white justify-content-start">
                            <i class="flaticon-drive"></i> Pourquoi Choisir {{ FrontHelper::getAppName() }}
                        </span>
                        <h2 class="site-title text-white mb-10">Nous sommes dédiés <span>à offrir</span> un service de qualité</h2>
                        <p class="text-white">
                            Avec {{ FrontHelper::getAppName() }}, profitez d'une expérience de covoiturage inégalée. Nos conducteurs experts et nos véhicules de qualité garantissent votre sécurité et confort tout au long de votre trajet.
                        </p>
                    </div>
                    <div class="choose-img wow fadeInUp" data-wow-delay=".25s">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/choose/02.png') }}" alt>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-content-wrapper wow fadeInRight" data-wow-delay=".25s">
                    <div class="choose-item">
                        <span class="choose-count">01</span>
                        <div class="choose-item-icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/taxi-1.svg') }}" alt>
                        </div>
                        <div class="choose-item-info">
                            <h3>Véhicules de qualité</h3>
                            <p>Nos véhicules sont soigneusement sélectionnés pour garantir sécurité et confort, avec des standards élevés pour chaque trajet effectué.</p>
                        </div>
                    </div>
                    <div class="choose-item ms-lg-5">
                        <span class="choose-count">02</span>
                        <div class="choose-item-icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/driver.svg') }}" alt>
                        </div>
                        <div class="choose-item-info">
                            <h3>Conducteurs Experts</h3>
                            <p>Nos conducteurs sont formés pour offrir une conduite sûre, rapide et agréable, vous assurant une expérience sans souci à chaque trajet.</p>
                        </div>
                    </div>
                    <div class="choose-item mb-lg-0">
                        <span class="choose-count">03</span>
                        <div class="choose-item-icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/taxi-location.svg') }}" alt>
                        </div>
                        <div class="choose-item-info">
                            <h3>Nombreuses Destinations</h3>
                            <p>Avec {{ FrontHelper::getAppName() }}, vous pouvez voyager dans de nombreuses villes et régions, que ce soit pour un trajet local ou interurbain, avec une couverture étendue pour tous vos besoins.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
