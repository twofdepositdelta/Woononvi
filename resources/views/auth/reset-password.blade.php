@include('back.layouts.partials.start')
<body>

<section class="auth bg-base d-flex flex-wrap">
    <div class="col-md-6 offset-md-3 py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <div class="text-center">
                    <a href="{{ route('index') }}" class="mb-40 max-w-290-px logo-text text-center">
                        <span class="logo-black">{{ explode('ō', FrontHelper::getAppName())[0] }}ō</span><span class="logo-yellow">{{ explode('ō', FrontHelper::getAppName())[1] }}</span>
                    </a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-4 mb-3 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
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
                <p class="mb-20 text-secondary-light text-lg">Réinitialisez votre mot de passe</p>
            </div>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Ex : exemple@wononvi.com" value="{{ old('email', $request->email) }}">
                </div>
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Nouveau mot de passe" name="password">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>

                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password2" placeholder="Confirmez nouveau mot de passe" name="password_confirmation">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password2"></span>
                </div>

                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Réinitialiser le mot de passe</button>
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
