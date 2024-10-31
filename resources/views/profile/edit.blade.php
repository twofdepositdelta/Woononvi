@extends('back.layouts.master')

@section('title', 'Mon Profile')
@section('content')
@php
// Définir la locale à français
setlocale(LC_TIME, 'fr_FR.UTF-8');
@endphp
<div class="dashboard-main-body">
    <div class="row gy-4">
        <div class="col-lg-5">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <img src="{{ asset('storage/back/assets/images/user-grid/user-grid-bg' . (Auth::user()->profile->genre == 'male' ? '10' : '7') . '.png') }}"
                    alt="" class="w-100 object-fit-cover">
                {{-- <img
                    src="{{ asset('storage/back/assets/images/user-grid/user-grid-bg'. Auth::user()->profile->genre == 'male' ? '10' : '7' .'.png') }}"
                    alt="" class="w-100 object-fit-cover"> --}}
                <div class="pb-24 ms-16 mb-24 me-16 mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="{{ asset(Auth::user()->profile->avatar ? Auth::user()->profile->avatar : 'storage/back/assets/images/user-grid/user-grid-img14.png') }}"
                            alt=""
                            class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                        <h6 class="mb-0 mt-16">{{ strtoupper(Auth::user()->lastname) . ' ' .
                            ucfirst(strtolower(Auth::user()->firstname)) }}</h6>
                        <span class="text-secondary-light mb-16">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16">Informations Personnelles</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Nom Complet</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{
                                    strtoupper(Auth::user()->lastname) . ' ' .
                                    ucfirst(strtolower(Auth::user()->firstname)) }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Email</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Téléphone</span>
                                <span class="w-70 text-secondary-light fw-medium">:
                                    ({{ Auth::user()->city->country->indicatif }}) {{ Auth::user()->phone }}
                                </span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Naissance</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->date_of_birth ?
                                    ucfirst(\Carbon\Carbon::parse(Auth::user()->date_of_birth)->locale('fr_FR')->translatedFormat('D
                                    d M Y')) : 'N/A' }}</span>
                            </li>
                            @if (Auth::user()->gender)
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Genre</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->gender == 'male' ?
                                    'Homme' : 'Femme' }}</span>
                            </li>
                            @endif
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">NPI</span>
                                <span class="w-70 text-secondary fw-medium">: {{ Auth::user()->npi ?? 'N/A' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Compte</span>
                                <span
                                    class="w-70 text-{{ Auth::user()->is_verified == true ? 'success' : 'danger' }} fw-medium">:
                                    {{ Auth::user()->is_verified ? 'Vérifié' : 'Non Vérifié' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1">
                                <span class="w-30 text-md fw-semibold text-primary-light">Adresse</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->profile->address ??
                                    'N/A' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Depuis le</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{
                                    ucfirst(\Carbon\Carbon::parse(Auth::user()->created_at)->locale('fr_FR')->translatedFormat('D
                                    d M Y')) }}</span>
                            </li>

                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Rôle</span>
                                <span class="w-70 text-warning fw-medium">:
                                    {{-- {{ Auth::user()->getRoleNames()->first() ?? 'N/A' }} --}}
                                    @if (Auth::user()->getRoleNames()->isNotEmpty())
                                    @foreach (Auth::user()->getRoleNames() as $role)
                                    <span>{{ \Spatie\Permission\Models\Role::where('name', $role)->first()->role
                                        }}</span>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                    @else
                                    N/A
                                    @endif
                                </span>
                            </li>

                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Nationalité</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->city->country->name
                                    }} <i class="{{ Auth::user()->city->country->icon }}"></i></span>
                            </li>

                            <li class="d-flex align-items-center gap-1">
                                <span class="w-30 text-md fw-semibold text-primary-light">Bio</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ Auth::user()->profile->bio ??
                                    'N/A' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body p-24">
                    <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-edit-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab"
                                aria-controls="pills-edit-profile" aria-selected="true">
                                Modifier Profil
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-change-password-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-change-password" type="button" role="tab"
                                aria-controls="pills-change-password" aria-selected="false" tabindex="-1">
                                Mot de Passe
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab"
                                aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                                Gérer Notification
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-edit-profile" role="tabpanel"
                            aria-labelledby="pills-edit-profile-tab" tabindex="0">
                            <h6 class="text-md text-primary-light mb-16">Profil</h6>
                            <!-- Upload Image Start -->
                            <form id="avatarForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-24 mt-16">
                                    <div class="avatar-upload">
                                        <div
                                            class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg"
                                                hidden onchange="previewImage(event)">
                                            <label for="imageUpload"
                                                class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                            </label>
                                        </div>
                                        <div class="avatar-previews">
                                            <div id="imagePreview" class="avatar-preview-img"
                                                style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 1px solid #007bff;">
                                                <img id="preview" src="{{ asset(Auth::user()->profile->avatar) }}"
                                                    alt="Image Preview"
                                                    style="width: 100%; height: auto; display: block;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Upload Image End -->
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Prénom -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="firstname"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Prénom <span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="firstname" name="firstname" placeholder="Entrer le prénom" value="{{ old('firstname', Auth::user()->firstname) }}">
                                            @error('firstname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Nom de famille -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="lastname"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Nom de Famille <span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="lastname" name="lastname" placeholder="Entrer le nom de famille" value="{{ old('lastname', Auth::user()->lastname) }}">
                                            @error('lastname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Nom d'utilisateur -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="username"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Nom d'utilisateur <span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="username" name="username" placeholder="Entrer le nom d'utilisateur" value="{{ old('username', Auth::user()->username) }}">
                                            <div id="username-feedback" class="text-success mt-2" style="display: none;">Nom d'utilisateur disponible.</div>
                                            <div id="username-error" class="text-danger mt-2" style="display: none;">Ce nom d'utilisateur est déjà pris.</div>
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="email"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                            <input type="email" class="form-control radius-8" id="email" name="email" readonly placeholder="Entrer l'adresse email" value="{{ old('email', Auth::user()->email) }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Téléphone -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="phone" class="form-label fw-semibold text-primary-light text-sm mb-8">Téléphone <span class="text-danger-600">*</span></label>
                                            <div class="d-flex">
                                                <select id="indicatif" name="indicatif" class="form-select radius-8 me-2 flex-grow-1" style="max-width: 150px;">
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->indicatif }}" {{ Auth::user()->city->country->code == $country->code ? 'selected' : '' }}>
                                                            ({{ $country->indicatif }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control radius-8 flex-grow-1" id="phone" name="phone" placeholder="Entrer le numéro de téléphone" value="{{ old('phone', Auth::user()->phone) }}">
                                            </div>

                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Genre -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="gender"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Genre</label>
                                            <select class="form-control radius-8 form-select" id="gender" name="gender">
                                                <option value="male" {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Homme</option>
                                                <option value="female" {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>Femme</option>
                                                <option value="other" {{ old('gender', Auth::user()->gender) == 'other' ? 'selected' : '' }}>Autre</option>
                                            </select>
                                            @error('gender')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Date de naissance -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="date_of_birth"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Date de Naissance</label>
                                            <input type="date" class="form-control radius-8" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                                            @error('date_of_birth')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Adresse -->
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="address"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Adresse <span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="address" name="address" placeholder="Entrer l'adresse" value="{{ old('address', Auth::user()->profile->address) }}">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Biographie -->
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="bio"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Biographie</label>
                                            <textarea class="form-control radius-8" id="bio" name="bio" placeholder="Écrire une biographie...">{{ old('bio', Auth::user()->profile->bio) }}</textarea>
                                            @error('bio')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <button type="reset" class="btn btn-outline-danger-600 radius-8">Annuler</button>

                                    <button type="submit"
                                        class="btn btn-primary radius-8">
                                        Enregistrer
                                    </button>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="pills-change-password" role="tabpanel"
                            aria-labelledby="pills-change-password-tab" tabindex="0">
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <!-- Mot de passe actuel -->
                                <div class="mb-20">
                                    <label for="current-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Mot de passe actuel
                                        <span class="text-danger-600">*</span></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control radius-8" id="current-password"
                                            placeholder="Entrez votre mot de passe actuel*" name="current_password" required>
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#current-password"></span>
                                    </div>
                                    @error('current_password')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nouveau mot de passe -->
                                <div class="mb-20">
                                    <label for="new-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Nouveau mot de passe
                                        <span class="text-danger-600">*</span></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control radius-8" id="new-password"
                                            placeholder="Entrez votre nouveau mot de passe*" name="password" required>
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#new-password"></span>
                                    </div>
                                    @error('password')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Confirmer nouveau mot de passe -->
                                <div class="mb-20">
                                    <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmez le nouveau mot de passe
                                        <span class="text-danger-600">*</span></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control radius-8" id="confirm-password"
                                            placeholder="Confirmez votre nouveau mot de passe*" name="password_confirmation" required>
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#confirm-password"></span>
                                    </div>
                                    @error('password_confirmation')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Bouton de soumission -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary radius-8">Mettre à jour</button>
                                </div>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('notification.settings.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                @foreach ($notificationSettings as $setting)
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="{{ $setting->notification_type }}" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">{{ ucfirst(str_replace('_', ' ', $setting->notification_type)) }}</span>
                                            <input class="form-check-input" type="checkbox" name="{{ $setting->notification_type }}"
                                                   id="{{ $setting->notification_type }}"
                                                   {{ $setting->is_enabled ? 'checked' : '' }}
                                                   value="on">
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show(); // Affiche l'aperçu de l'image
            };
            reader.readAsDataURL(input.files[0]);

            // Soumet le formulaire via AJAX
            var formData = new FormData($('#avatarForm')[0]); // Récupère le formulaire

            $.ajax({
                url: "{{ route('profile.avatar.update') }}", // Assurez-vous que la route est correcte
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Mettre à jour l'aperçu de l'image
                        $('#preview').attr('src', response.avatar).show();
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message || 'Erreur lors de la mise à jour de l\'avatar. Veuillez réessayer.';
                    console.error('Erreur - ' + errorMessage);
                    alert(errorMessage);
                }
            });
        }
    }
</script>
<script>
    document.getElementById('username').addEventListener('input', function() {
        let username = this.value;

        // Supprimer les espaces
        username = username.replace(/\s+/g, '');

        // Mettre à jour le champ avec le nom d'utilisateur sans espaces
        this.value = username;

        // Ne pas faire la requête si le champ est vide
        if (username.trim() === '') {
            document.getElementById('username-feedback').style.display = 'none';
            document.getElementById('username-error').style.display = 'none';
            return;
        }

        fetch(`/check-username?username=${username}`)
            .then(response => response.json())
            .then(data => {
                const feedbackElement = document.getElementById('username-feedback');
                const errorElement = document.getElementById('username-error');

                if (data.isUnique) {
                    feedbackElement.style.display = 'block';
                    errorElement.style.display = 'none';
                } else {
                    feedbackElement.style.display = 'none';
                    errorElement.style.display = 'block';
                }
            })
            .catch(error => console.error('Erreur:', error));
    });

</script>

<script>
    // Vérifie si un onglet a été mémorisé dans le stockage local
    document.addEventListener("DOMContentLoaded", function() {
        // Récupère l'onglet actif à partir du stockage local ou définit un onglet par défaut
        const activeTab = localStorage.getItem('activeTab') || 'pills-edit-profile-tab';

        // Supprime l'état actif de tous les onglets
        document.querySelectorAll('.nav-link').forEach(btn => {
            btn.classList.remove('active');
            btn.setAttribute('aria-selected', 'false');
        });

        // Supprime l'affichage de tous les contenus d'onglets
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('show', 'active');
        });

        // Affiche l'onglet actif
        const tab = document.getElementById(activeTab);
        if (tab) {
            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');

            // Affiche le contenu de l'onglet actif
            const target = tab.getAttribute('data-bs-target');
            document.querySelector(target).classList.add('show', 'active');
        }

        // Ajoute un écouteur d'événements pour chaque bouton d'onglet
        document.querySelectorAll('.nav-link').forEach(button => {
            button.addEventListener('click', function() {
                // Supprime l'état actif de tous les onglets
                document.querySelectorAll('.nav-link').forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-selected', 'false');
                });

                // Supprime l'affichage de tous les contenus d'onglets
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });

                // Définit l'onglet actif
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');

                // Affiche le contenu de l'onglet
                const target = this.getAttribute('data-bs-target');
                document.querySelector(target).classList.add('show', 'active');

                // Enregistre l'onglet actif dans le stockage local
                localStorage.setItem('activeTab', this.id);
            });
        });
    });
</script>


@endsection

