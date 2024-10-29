@extends('back.layouts.master')
@section('title', 'Nouveau Utilisateur')
@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-10 col-lg-10">
                <div class="card-header">
                    <div class="d-flex mb-3 align-items-center">
                        <h5 class="card-title mb-2" style="margin-bottom: 15px !important">Création d'un utilisateur</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ms-auto">Liste Utilisateur</a>
                    </div>
                </div>
                <div class="card border">
                    <div class="card-body">
                        <h6 class="text-md text-primary-light mb-16">Nouveau Utilisateur</h6>

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row gy-3">

                                <div class="mb-20 col-lg-6">
                                    <label for="firstname" class="form-label fw-semibold text-primary-light text-sm mb-8">Prénom
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="firstname" name="firstname"
                                        value="{{ old('firstname') }}" placeholder="Entrez le prénom" required>
                                    @error('firstname')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-20 col-lg-6">
                                    <label for="lastname" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="lastname" name="lastname"
                                        value="{{ old('lastname') }}" placeholder="Entrez le nom" required>
                                    @error('lastname')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-lg-6">
                                    <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email
                                        <span class="text-danger-600">*</span></label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control radius-8" id="emailPrefix" name="email"
                                               value="{{ old('email') }}" placeholder="Entrez votre nom"
                                               oninput="validateEmail()" onkeydown="preventAtSign(event)" maxlength="25" minlength="5">
                                        <span class="input-group-text">@wononvi.com</span>
                                    </div>
                                    <span id="emailError" class="text-danger" style="display: none;"></span>
                                </div>

                                <div class="mb-20 col-lg-6">
                                    <label for="phone" class="form-label fw-semibold text-primary-light text-sm mb-8">Téléphone
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="phone" name="phone"
                                        value="{{ old('phone') }}" placeholder="Entrez le numéro de téléphone" required>
                                    @error('phone')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-lg-6">
                                    <label for="gender" class="form-label fw-semibold text-primary-light text-sm mb-8">Genre</label>
                                    <select class="form-control radius-8 form-select" id="gender" name="gender">
                                        <option value="" disabled selected>Sélectionner le genre</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Homme</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-20 col-lg-6">
                                    <label for="npi" class="form-label fw-semibold text-primary-light text-sm mb-8">NPI
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="npi" name="npi"
                                        value="{{ old('npi') }}" placeholder="Entrez le NPI" required>
                                    @error('npi')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-lg-6">
                                    <label for="role" class="form-label fw-semibold text-primary-light text-sm mb-8">Rôle
                                        <span class="text-danger-600">*</span></label>
                                    <select class="form-control radius-8 form-select" id="role" name="role" required>
                                        <option value="" disabled selected>Sélectionner le rôle</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                                {{ \Spatie\Permission\Models\Role::where('name', $role->name)->first()->role
                                            }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-lg-6">
                                    <label for="city" class="form-label fw-semibold text-primary-light text-sm mb-8">Ville Centrale
                                        <span class="text-danger-600">*</span></label>
                                    <select class="form-control radius-8 form-select" id="city" name="city" required>
                                        <option value="" disabled selected>Sélectionner le site</option>
                                        @foreach($cities as $city)
                                            <option
                                                value="{{ $city->id }}"
                                                @if (old('city') == $city->id )
                                                    selected
                                                @else
                                                    {{ $city->name == 'Cotonou' ? 'selected' : '' }}>
                                                @endif
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="text-danger-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <button type="button"
                                    class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                    Effacer
                                </button>
                                <button type="submit"
                                    class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                    Enregistrer
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

@section('customJS')
<script>
    function validateEmail() {
        const emailPrefixInput = document.getElementById('emailPrefix');
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[A-Za-z0-9._%+-]+@wononvi\.com$/;

        // Assemble l'email complet
        const fullEmail = emailPrefixInput.value + '@wononvi.com';

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
