<div class="download-area mb-50 {{ Route::currentrouteName() == 'download' ? 'pt-70' : '' }}">
    <div class="container">
        <div class="download-wrapper">
            <div class="row align-items-center">
                <!-- Section Texte -->
                <div class="col-lg-6">
                    <div class="download-content">
                        <div class="site-heading mb-4">
                            <span class="site-title-tagline justify-content-start">
                                <i class="flaticon-drive"></i> L'Application Incontournable
                            </span>
                            <h2 class="site-title mb-10">
                                <span>Wononvi</span>, Votre Compagnon de Covoiturage
                            </h2>
                            <p>
                                Avec l'application Wononvi, rien ne vous échappe ! Proposez ou réservez des trajets en toute simplicité. Téléchargez dès maintenant pour profiter d'une expérience de covoiturage fluide et rapide.
                            </p>
                        </div>
                        <!-- Boutons de Téléchargement -->
                        <div class="download-btn d-flex gap-3">
                            <a href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/download/wononvi-app.apk') }}" class="btn btn-primary">
                                <i class="fab fa-google-play"></i>
                                <div class="download-btn-content">
                                    <span>Disponible sur</span>
                                    <strong>Google Play</strong>
                                </div>
                            </a>
                            <a href="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/download/wononvi-app.apk') }}" class="btn btn-secondary">
                                <i class="fab fa-app-store"></i>
                                <div class="download-btn-content">
                                    <span>Disponible sur</span>
                                    <strong>App Store</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Section Image -->
                <div class="col-lg-6 text-center">
                    <div class="download-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/download/01.png') }}" alt="Téléchargez l'application Wononvi" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
