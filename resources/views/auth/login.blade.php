@include('back.layouts.partials.start')
    <body>

    <section class="auth bg-base d-flex flex-wrap">
        {{-- <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="assets/images/auth/auth-img.png" alt="">
            </div>
        </div> --}}
        <div class="col-md-6 offset-md-3 py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="{{ route('index') }}" class="mb-40 max-w-290-px">
                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/logo.png') }}" alt="">
                    </a>
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-4 mb-3 mb-0 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="mingcute:emoji-line" class="icon text-xl"></iconify-icon>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <p class="mb-1">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <button class="remove-button text-danger-600 text-xxl line-height-1">
                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                            </button>
                        </div>
                    @endif
                    <p class="mb-20 text-secondary-light text-lg">Connectez-vous à votre compte</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Mot de passe" name="password">
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-between gap-2">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                                <label class="form-check-label" for="remeber">Se souvenir de moi </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-primary-600 fw-medium">Mot de passe oublié ?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Se connecter</button>

                    {{-- <div class="mt-32 center-border-horizontal text-center">
                        <span class="bg-base z-1 px-4">Ou connectez-vous avec</span>
                    </div>
                    <div class="mt-32 d-flex align-items-center gap-3">
                        <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                            <iconify-icon icon="ic:baseline-facebook" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                            Facebook
                        </button>
                        <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                            <iconify-icon icon="logos:google-icon" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                            Google
                        </button>
                    </div> --}}
                    {{-- <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="text-primary-600 fw-semibold">Inscrivez-vous</a></p>
                    </div> --}}

                </form>
            </div>
        </div>
    </section>

@include('back.layouts.partials.end')

<script>
      // ================== Afficher/Masquer le mot de passe ==================
      function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Appeler la fonction
    initializePasswordToggle('.toggle-password');
  // ================== Fin de l'affichage/masquage du mot de passe ==================
</script>

</body>

</html>
