@include('back.layouts.partials.start')

<body>

<section class="auth bg-base d-flex flex-wrap">
    <div class="col-md-6 offset-md-3 py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <div class="text-center">
                    <a href="{{ route('index') }}" class="mb-40 max-w-290-px logo-text">
                        <span class="logo-black ">{{ explode('ō', FrontHelper::getAppName())[0] }}ō</span><span class="logo-yellow">{{ explode('ō', FrontHelper::getAppName())[1] }}</span>
                    </a>

                </div>
                @if (session('status'))
                    <div class="alert alert-success bg-success-50 text-success-600 border-success-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 mb-3 py-4 mb-0 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:check-circle-line" class="icon text-xl"></iconify-icon>
                            <div>{{ session('status') }}</div>
                        </div>
                        <button class="remove-button text-success-600 text-xxl line-height-1">
                            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-4 mb-0 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
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

                <p class="mb-20 text-secondary-light text-lg">Entrez votre adresse e-mail pour réinitialiser votre mot de passe</p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" value="{{old('email')}}" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Adresse e-mail" required>
                </div>

                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            {{-- <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                            <label class="form-check-label" for="remeber">Se souvenir de moi </label> --}}
                        </div>
                        <a href="{{ route('login') }}" class="text-primary-600 fw-medium">Je me souviens de mon mot de passe ?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                    Envoyer le lien de réinitialisation
                </button>

            </form>
        </div>
    </div>
</section>

@include('back.layouts.partials.end')

</body>

</html>
