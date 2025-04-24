@extends('back.layouts.master')
@section('title', 'Modifier un utilisateur')
@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-10 col-lg-10">
                <div class="card-header">
                    <div class="d-flex mb-3 align-items-center">
                        <h5 class="card-title mb-2" style="margin-bottom: 15px !important">Création d'un utilisateur</h5>
                        {{-- <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ms-auto">Liste Utilisateur</a> --}}
                    </div>
                </div>
                <div class="card border">
                    <div class="card-body">
                        <h6 class="text-md text-primary-light mb-16">@yield('title')</h6>

                        <form action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row gy-3">

                                {{-- Prénom --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="firstname" class="form-label fw-semibold text-primary-light text-sm mb-8">Prénom
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="firstname" name="firstname"
                                           value="{{ old('firstname', $user->firstname) }}" placeholder="Entrez le prénom" required>
                                    @error('firstname')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Nom --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="lastname" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="lastname" name="lastname"
                                           value="{{ old('lastname', $user->lastname) }}" placeholder="Entrez le nom" required>
                                    @error('lastname')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email
                                        <span class="text-danger-600">*</span></label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control radius-8" id="emailPrefix" name="email"
                                               value="{{ old('email', explode('@', $user->email)[0]) }}"
                                               placeholder="Entrez votre nom"
                                               oninput="validateEmail()" onkeydown="preventAtSign(event)" maxlength="25" minlength="5">
                                        <span class="input-group-text">@woononvi.com</span>
                                    </div>
                                    <span id="emailError" class="text-danger" style="display: none;"></span>
                                </div>

                                {{-- Téléphone --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="phone" class="form-label fw-semibold text-primary-light text-sm mb-8">Téléphone
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="phone" name="phone"
                                           value="{{ old('phone', $user->phone) }}" placeholder="Entrez le numéro de téléphone" required>
                                    @error('phone')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Genre --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="gender" class="form-label fw-semibold text-primary-light text-sm mb-8">Genre</label>
                                    <select class="form-control radius-8 form-select" id="gender" name="gender">
                                        <option value="" disabled {{ old('gender', $user->gender) == null ? 'selected' : '' }}>Sélectionner le genre</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Homme</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NPI --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="npi" class="form-label fw-semibold text-primary-light text-sm mb-8">NPI
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="npi" name="npi"
                                           value="{{ old('npi', $user->npi) }}" placeholder="Entrez le NPI" required>
                                    @error('npi')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Ville --}}
                                <div class="mb-20 col-lg-6">
                                    <label for="city" class="form-label fw-semibold text-primary-light text-sm mb-8">Ville Centrale
                                        <span class="text-danger-600">*</span></label>
                                    <select class="form-control radius-8 form-select" id="city" name="city" required>
                                        <option value="" disabled>Sélectionner le site</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city', $user->city_id) == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-end gap-3">
                                <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                    Modifier
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customJ')
<script>
    function validateEmail() {
        const emailPrefixInput = document.getElementById('emailPrefix');
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[A-Za-z0-9._%+-]+@woononvi\.com$/;

        // Assemble l'email complet
        const fullEmail = emailPrefixInput.value + '@woononvi.com';

        // Vérifie si l'email respecte le format
        if (emailPrefixInput.value && !emailPattern.test(fullEmail)) {
            emailError.textContent = "L'adresse e-mail doit être sous la forme : nom@wononvi.com.";
            emailError.style.display = 'block';
        } else {
            emailError.textContent = ""; // Réinitialise le message d'erreur
            emailError.style.display = 'none';
        }
    }

    function preventAtSign(event) {
        if (event.key === '@') {
            event.preventDefault(); // Empêche la saisie de @
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialisation de Quill avec le thème Snow
        var quill = new Quill('#editor-container', {
            theme: 'snow'
        });

        // Transférer le contenu de l'éditeur dans le champ caché lors de la soumission du formulaire
        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Récupérer le contenu HTML de l'éditeur
            var content = document.querySelector('input[name=content]');
            content.value = quill.root.innerHTML;
        };
    });
</script>
@endsection
