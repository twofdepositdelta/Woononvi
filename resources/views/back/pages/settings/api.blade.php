@extends('back.layouts.master')
@section('title', 'Paramétres des apis ')
@section('content')


    {{-- <div class="row gy-4">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulaire de Paramètres API</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('apis.update', $api) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row gy-3">
                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="maps">
                                    Api maps
                                </label>
                                <input type="text" class="form-control" id="maps" name="maps" value="{{ old('maps', $api->maps) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="feedpay_public">
                                    Clé publique FeedPay
                                </label>
                                <input type="text" class="form-control" id="feedpay_public" name="feedpay_public" value="{{ old('feedpay_public', $api->feedpay_public) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="feedpay_private">
                                    Clé privée FeedPay
                                </label>
                                <input type="text" class="form-control" id="feedpay_private" name="feedpay_private" value="{{ old('feedpay_private', $api->feedpay_private) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="feedpay_secret">
                                    Secret FeedPay
                                </label>
                                <input type="text" class="form-control" id="feedpay_secret" name="feedpay_secret" value="{{ old('feedpay_secret', $api->feedpay_secret) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="kkiapay_public">
                                    Clé publique Kkiapay
                                </label>
                                <input type="text" class="form-control" id="kkiapay_public" name="kkiapay_public" value="{{ old('kkiapay_public', $api->kkiapay_public) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="kkiapay_private">
                                    Clé privée Kkiapay
                                </label>
                                <input type="text" class="form-control" id="kkiapay_private" name="kkiapay_private" value="{{ old('kkiapay_private', $api->kkiapay_private) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="kkiapay_secret">
                                    Secret Kkiapay
                                </label>
                                <input type="text" class="form-control" id="kkiapay_secret" name="kkiapay_secret" value="{{ old('kkiapay_secret', $api->kkiapay_secret) }}">
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary-600">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="card h-100 p-0 radius-12">
       <form action="{{ route('apis.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body p-24">
                <div class="row gy-4">
                    <div class="col-xxl-6">
                        <div class="card radius-12 shadow-none border overflow-hidden">
                            <div
                                class="card-header bg-neutral-100 border-bottom py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                <div class="d-flex align-items-center gap-10">
                                    <span
                                        class="w-36-px h-36-px bg-base rounded-circle d-flex justify-content-center align-items-center">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/payment/maps.png')}}" alt="" class="">
                                    </span>
                                    <span class="text-lg fw-semibold text-primary-light">Google maps</span>
                                </div>
                                {{-- <div
                                    class="form-switch switch-primary d-flex align-items-center justify-content-center">
                                    <input class="form-check-input" type="radio" role="switch" checked>
                                </div> --}}
                            </div>

                            <div class="card-body p-24">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-8">
                                        <label for="publicKey" class="form-label fw-semibold text-primary-light text-md mb-8">Maps
                                            <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" name="maps" id="publicKey"
                                            placeholder="Public Key" value="{{$apimaps->maps}}">
                                    </div>

                                    <div class="col-sm-4 text-end">
                                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                                            Modifier
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6">
                        <div class="card radius-12 shadow-none border overflow-hidden">
                            <div
                                class="card-header bg-neutral-100 border-bottom py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                <div class="d-flex align-items-center gap-10">
                                    <span
                                        class="w-36-px h-36-px bg-base rounded-circle d-flex justify-content-center align-items-center">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/payment/fedpay.png')}}" alt="" class="">
                                    </span>
                                    <span class="text-lg fw-semibold text-primary-light">Fedapay</span>
                                </div>
                                {{-- <div
                                    class="form-switch switch-primary d-flex align-items-center justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" checked>
                                </div> --}}
                            </div>
                            <div class="card-body p-24">
                                <div class="row gy-3">
                                    <div class="col-sm-6">
                                        <span
                                            class="form-label fw-semibold text-primary-light text-md mb-8">Environement
                                            <span class="text-danger-600">*</span></span>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-10 fw-medium text-lg">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input
                                                        class="form-check-input radius-4 border border-neutral-500 sandbox2"
                                                        type="radio" name="checkbox"  checked>
                                                </div>
                                                <label for="sandbox2"
                                                    class="form-label fw-medium text-lg text-primary-light mb-0">Sandbox</label>
                                            </div>
                                            <div class="d-flex align-items-center gap-10 fw-medium text-lg">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input
                                                        class="form-check-input radius-4 border border-neutral-500 production2"
                                                        type="radio" name="checkbox" >
                                                </div>
                                                <label for="Production2"
                                                    class="form-label fw-medium text-lg text-primary-light mb-0">Production</label>
                                            </div>
                                        </div>
                                    </div>



                                        <div class="row mt-3">
                                            @foreach ($apifeedpays as $apifeedpay)
                                                @if ($apifeedpay->environment_id == 1)
                                                    <div class="col-sm-6 enviro1">
                                                        <label for="publicKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé publique
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="publicKeyTwo"
                                                            placeholder="Public Key" name="feedpay_public"
                                                            value="{{ $apifeedpay->feedpay_public }}">
                                                    </div>

                                                    <div class="col-sm-6 enviro1">
                                                        <label for="publicKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé privée
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="publicKeyTwo"
                                                            placeholder="Private Key" name="feedpay_private_sandbox"
                                                            value="{{ $apifeedpay->feedpay_private }}">
                                                    </div>

                                                    <div class="col-sm-6  enviro1">
                                                        <label for="secretKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé secrète
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="secretKeyTwo"
                                                            placeholder="Secret Key"  name="feedpay_secret_sandbox"
                                                            value="{{ $apifeedpay->feedpay_secret }}">
                                                    </div>
                                                @elseif ($apifeedpay->environment_id == 2)

                                                    <div class="col-sm-6 d-none enviro2">
                                                        <label for="publicKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé privée
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="publicKeyTwo"
                                                            placeholder="Private Key" name="feedpay_private_production"
                                                            value="{{ $apifeedpay->feedpay_private }}">
                                                    </div>

                                                    <div class="col-sm-6 d-none enviro2">
                                                        <label for="secretKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé secrète
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="secretKeyTwo"
                                                            placeholder="Secret Key" name="feedpay_secret_production"
                                                            value="{{ $apifeedpay->feedpay_secret }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="col-12 text-end">
                                            <button type="submit"
                                                class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                                                Modifier
                                            </button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-xxl-6">
                        <div class="card radius-12 shadow-none border overflow-hidden">
                            <div
                                class="card-header bg-neutral-100 border-bottom py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                <div class="d-flex align-items-center gap-10">
                                    <span
                                        class="w-36-px h-36-px bg-base rounded-circle d-flex justify-content-center align-items-center">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/payment/kkiapay.png')}}" alt="" class="">
                                    </span>
                                    <span class="text-lg fw-semibold text-primary-light">Kkiapay</span>
                                </div>
                                {{-- <div
                                    class="form-switch switch-primary d-flex align-items-center justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" checked>
                                </div> --}}
                            </div>
                            <div class="card-body p-24">
                                <div class="row gy-3">
                                    <div class="col-sm-6">
                                        <span
                                            class="form-label fw-semibold text-primary-light text-md mb-8">Environement
                                            <span class="text-danger-600">*</span></span>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-10 fw-medium text-lg">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input
                                                        class="form-check-input radius-4 border border-neutral-500 sandbox22"
                                                        type="radio" name="checkbox"checked>
                                                </div>
                                                <label for="sandbox2"
                                                    class="form-label fw-medium text-lg text-primary-light mb-0">Sandbox</label>
                                            </div>
                                            <div class="d-flex align-items-center gap-10 fw-medium text-lg">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input
                                                        class="form-check-input radius-4 border border-neutral-500 Production22"
                                                        type="radio" name="checkbox" >
                                                </div>
                                                <label for="Production2"
                                                    class="form-label fw-medium text-lg text-primary-light mb-0">Production</label>
                                            </div>
                                        </div>
                                    </div>



                                        <div class="row mt-3">
                                            @foreach ($apikkiapays as $apikkiapay)
                                                @if ($apikkiapay->environment_id == 1)
                                                    <div class="col-sm-6 enviro12">
                                                        <label for="publicKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé publique
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="publicKeyTwo"
                                                            placeholder="Public Key" name="kkiapay_public"
                                                            value="{{ $apikkiapay->kkiapay_public }}">
                                                    </div>

                                                    <div class="col-sm-6 enviro12">
                                                        <label for="publicKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé privée
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="publicKeyTwo"
                                                            placeholder="Private Key" name="kkiapay_private_sandbox"
                                                            value="{{ $apikkiapay->kkiapay_private }}">
                                                    </div>

                                                    <div class="col-sm-6 enviro12">
                                                        <label for="secretKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé secrète
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="secretKeyTwo"
                                                            placeholder="Secret Key" name="kkiapay_secret_sandbox"
                                                            value="{{ $apikkiapay->kkiapay_secret }}">
                                                    </div>
                                                @elseif ($apikkiapay->environment_id == 2)

                                                    <div class="col-sm-6 d-none enviro22">
                                                        <label for="publicKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé privée
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="publicKeyTwo"
                                                            placeholder="Private Key" name="kkiapay_private_production"
                                                            value="{{ $apikkiapay->kkiapay_private }}">
                                                    </div>

                                                    <div class="col-sm-6 d-none enviro22">
                                                        <label for="secretKeyTwo"
                                                            class="form-label fw-semibold text-primary-light text-md mb-8">Clé secrète
                                                            <span class="text-danger-600">*</span></label>
                                                        <input type="text" class="form-control radius-8" id="secretKeyTwo"
                                                            placeholder="Secret Key" name="kkiapay_secret_production"
                                                            value="{{ $apikkiapay->kkiapay_secret }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="col-12 text-end">
                                            <button type="submit"
                                                class="btn btn-primary border border-primary-600 text-md px-24 py-8 radius-8">
                                                Modifier
                                            </button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
     </form>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner les boutons radio pour chaque environnement
        const sandboxRadio = document.querySelector('.sandbox2');
        const productionRadio = document.querySelector('.production2');
        const sandboxRadio2 = document.querySelector('.sandbox22');
        const productionRadio2 = document.querySelector('.Production22');

        // Sélectionner les sections d’environnement
        const enviro1 = document.querySelectorAll('.enviro1'); // Sandbox pour Fedapay
        const enviro2 = document.querySelectorAll('.enviro2'); // Production pour Fedapay
        const enviro11 = document.querySelectorAll('.enviro12'); // Sandbox pour Kkiapay
        const enviro22 = document.querySelectorAll('.enviro22'); // Production pour Kkiapay

        // Fonction pour afficher/masquer les sections en fonction de l’environnement sélectionné
        function handleEnvironmentChange() {
            if (sandboxRadio.checked) {
                enviro1.forEach(section => section.classList.remove('d-none'));
                enviro2.forEach(section => section.classList.add('d-none'));
            } else if (productionRadio.checked) {
                enviro2.forEach(section => section.classList.remove('d-none'));
                enviro1.forEach(section => section.classList.add('d-none'));
            }

            if (sandboxRadio2.checked) {
                enviro11.forEach(section => section.classList.remove('d-none'));
                enviro22.forEach(section => section.classList.add('d-none'));
            } else if (productionRadio2.checked) {
                enviro22.forEach(section => section.classList.remove('d-none'));
                enviro11.forEach(section => section.classList.add('d-none'));
            }
        }

        // Ajouter un écouteur d’événement pour chaque bouton radio pour surveiller les changements
        sandboxRadio.addEventListener('change', handleEnvironmentChange);
        productionRadio.addEventListener('change', handleEnvironmentChange);
        sandboxRadio2.addEventListener('change', handleEnvironmentChange);
        productionRadio2.addEventListener('change', handleEnvironmentChange);

        // Appeler la fonction au chargement pour afficher la bonne section par défaut
        handleEnvironmentChange();
    });
</script>



