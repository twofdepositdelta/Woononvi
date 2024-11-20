<div class="about-area pt-70 mb-10">
    <div class="container">
        <div class="row align-items-center" id="devenir-conducteur">
            <!-- Section Devenir Conducteur -->
            <div class="col-lg-6">
                <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="about-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/driver-illustration.png') }}" alt="Devenir Conducteur">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                    <div class="site-heading mb-3">
                        <span class="site-title-tagline justify-content-start">
                            <i class="flaticon-drive"></i> Rejoignez-nous en tant que conducteur
                        </span>
                        <h2 class="site-title">
                            Devenez un conducteur sur <span>Wononvi</span> et commencez à gagner
                        </h2>
                    </div>
                    <p class="about-text">
                        Téléchargez l'application Wononvi et suivez quelques étapes simples pour rejoindre notre communauté de conducteurs. Ajoutez vos informations personnelles, soumettez vos documents pour vérification, et commencez à accepter des trajets.
                    </p>
                    <div class="about-list-wrapper">
                        <ul class="about-list list-unstyled">
                            <li>Téléchargez l'application depuis l'App Store ou Google Play</li>
                            <li>Créez votre profil et ajoutez vos informations personnelles</li>
                            <li>Ajoutez les détails de votre véhicule et vos documents</li>
                            <li>Acceptez des trajets et commencez à transporter des passagers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section for Devenir Conducteur -->
        <div class="faq-area pt-70" id="faq-conducteur">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion" id="accordionDriver">
                            @foreach (FrontHelper::getDriverFaqs() as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDriver{{ $faq->slug }}">
                                        <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDriver{{ $faq->slug }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseDriver{{ $faq->slug }}">
                                            <span><i class="far fa-question"></i></span> {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapseDriver{{ $faq->slug }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingDriver{{ $faq->slug }}" data-bs-parent="#accordionDriver">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-right">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline justify-content-start">FAQ</span>
                                <h2 class="site-title my-3">Devenir conducteur <span>Questions fréquemment posées</span></h2>
                            </div>
                            <p class="about-text">Voici les réponses aux questions courantes concernant le processus pour devenir conducteur avec Wononvi.</p>
                            <div class="faq-img mt-3">
                                <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/faqs-concept-illustration.avif') }}" alt="FAQ Conducteur">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Devenir Passager -->
        <div class="row align-items-center mt-5" id="devenir-passager">
            <div class="col-lg-6">
                <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="about-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/illustration-concept-partage.avif') }}" alt="Devenir Passager">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                    <div class="site-heading mb-3">
                        <span class="site-title-tagline justify-content-start">
                            <i class="flaticon-drive"></i> Rejoignez-nous en tant que passager
                        </span>
                        <h2 class="site-title">
                            Profitez de trajets sûrs et abordables sur <span>Wononvi</span>
                        </h2>
                    </div>
                    <p class="about-text">
                        En tant que passager, vous pouvez facilement réserver des trajets en utilisant l'application Wononvi. Recherchez des trajets qui vous conviennent, réservez une place et profitez de votre voyage en toute sécurité.
                    </p>
                    <div class="about-list-wrapper">
                        <ul class="about-list list-unstyled">
                            <li>Téléchargez l'application Wononvi</li>
                            <li>Créez un profil passager et connectez-vous</li>
                            <li>Recherchez un trajet qui correspond à votre destination</li>
                            <li>Réservez et profitez de votre voyage avec un conducteur vérifié</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section for Devenir Passager -->
        <div class="faq-area pt-70" id="faq-passager">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion" id="accordionPassenger">
                            @foreach (FrontHelper::getPassengerFaqs() as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPassenger{{ $faq->slug }}">
                                        <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePassenger{{ $faq->slug }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapsePassenger{{ $faq->slug }}">
                                            <span><i class="far fa-question"></i></span> {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapsePassenger{{ $faq->slug }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingPassenger{{ $faq->slug }}" data-bs-parent="#accordionPassenger">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-right">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline justify-content-start">FAQ</span>
                                <h2 class="site-title my-3">Devenir passager <span>Questions fréquemment posées</span></h2>
                            </div>
                            <p class="about-text">Voici les réponses aux questions courantes concernant le processus pour devenir passager avec Wononvi.</p>
                            <div class="faq-img mt-3">
                                <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/about/faqs-concept-illustrationk.avif') }}" alt="FAQ Passager">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
