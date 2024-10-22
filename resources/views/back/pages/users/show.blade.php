@extends('back.layouts.master')

@section('title', 'Détals ' .$user->lastname .' '.$user->firstname)
@section('content')
@php
// Définir la locale à français
setlocale(LC_TIME, 'fr_FR.UTF-8');
@endphp
<div class="dashboard-main-body">
    <div class="row gy-4">
        <div class="col-lg-5">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <img src="{{ asset('storage/back/assets/images/user-grid/user-grid-bg3.png') }}"
                    alt="" class="w-100 object-fit-cover">

                <div class="pb-24 ms-16 mb-24 me-16 mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="{{ asset($user->profile->avatar ? $user->profile->avatar : 'storage/back/assets/images/user-grid/user-grid-img14.png') }}"
                            alt=""
                            class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                        <h6 class="mb-0 mt-16">{{ strtoupper($user->lastname) . ' ' .
                            ucfirst(strtolower($user->firstname)) }}</h6>
                        <span class="text-secondary-light mb-16">{{ $user->email }}</span>
                        @if ($user->is_certified) <!-- Remplacez is_verified par is_certified -->
                            <span class="badge bg-primary">
                                <i class="ri-check-line"></i> <!-- Utilisez une icône de votre choix -->
                            </span>
                        @endif
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16">Informations Personnelles</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Nom Complet</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{
                                    strtoupper($user->lastname) . ' ' .
                                    ucfirst(strtolower($user->firstname)) }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Email</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Téléphone</span>
                                <span class="w-70 text-secondary-light fw-medium">:
                                    ({{ $user->city->country->indicatif }}) {{ $user->phone }}
                                </span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Naissance</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->date_of_birth ?
                                    ucfirst(\Carbon\Carbon::parse($user->date_of_birth)->locale('fr_FR')->translatedFormat('D
                                    d M Y')) : 'N/A' }}</span>
                            </li>
                            @if ($user->gender)
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Genre</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->gender == 'male' ?
                                    'Homme' : 'Femme' }}</span>
                            </li>
                            @endif
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">NPI</span>
                                <span class="w-70 text-secondary fw-medium">: {{ $user->npi ?? 'N/A' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Compte</span>
                                <span
                                    class="w-70 text-{{ $user->is_verified == true ? 'success' : 'danger' }} fw-medium">:
                                    {{ $user->is_verified ? 'Vérifié' : 'Non Vérifié' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1">
                                <span class="w-30 text-md fw-semibold text-primary-light">Adresse</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->profile->address ??
                                    'N/A' }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Depuis le</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{
                                    ucfirst(\Carbon\Carbon::parse($user->created_at)->locale('fr_FR')->translatedFormat('D
                                    d M Y')) }}</span>
                            </li>

                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Rôle</span>
                                <span class="w-70 text-warning fw-medium">:
                                    {{-- {{ $user->getRoleNames()->first() ?? 'N/A' }} --}}
                                    @if ($user->getRoleNames()->isNotEmpty())
                                    @foreach ($user->getRoleNames() as $role)
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
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->city->country->name
                                    }} <i class="{{ $user->city->country->icon }}"></i></span>
                            </li>

                            <li class="d-flex align-items-center gap-1">
                                <span class="w-30 text-md fw-semibold text-primary-light">Bio</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->profile->bio ??
                                    'N/A' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body p-20">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="trail-bg h-100 text-center d-flex flex-column justify-content-between align-items-center p-16 radius-8">
                                <h6 class="text-white text-xl">Revoir l'Etat du compte</h6>
                                <div class="">
                                    <p class="text-white">le compte est actuellement {{ $user->status == true ? 'Actif' : 'Inactif' }}</p>
                                    <a href="{{ route('users.updateStatus', $user) }}"
                                        @if ($user->status == true)
                                            onclick="return confirm('Êtes-vous sûr de vouloir activer {{ $user->firstname }} {{ $user->lastname }} ?');"
                                        @else
                                            onclick="return confirm('Êtes-vous sûr de vouloir désactiver {{ $user->firstname }} {{ $user->lastname }} ?');"
                                        @endif
                                        class="btn py-8 rounded-pill w-100 bg-gradient-blue-warning text-sm">
                                        {{ $user->status == true ? 'Désactiver' : 'Activer' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-info-focus">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-info-200 border border-info-400 text-info-600">
                                            <i class="ri-briefcase-line"></i> <!-- Icône pour "Total Revenu" -->
                                        </span>
                                        <span class="text-neutral-700 d-block">Balance</span>
                                        <h6 class="mb-0 mt-4">{{ $user->balance ?? '0' }} XOF</h6> <!-- Décommenter si vous avez une variable pour le revenu total -->
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-purple-light">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-lilac-200 border border-lilac-400 text-lilac-600">
                                            <i class="ri-road-map-line"></i> <!-- Icône pour "Trajets Effectués" -->
                                        </span>
                                        <span class="text-neutral-700 d-block">Trajets Effectués</span>
                                        <h6 class="mb-0 mt-4">{{ $totalTrips }}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-info-focus">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-info-200 border border-info-400 text-info-600">
                                            <i class="ri-clipboard-line"></i> <!-- Icône pour "Réservations" -->
                                        </span>
                                        <span class="text-neutral-700 d-block">Nombre de Réservations</span>
                                        <h6 class="mb-0 mt-4">{{ $user->bookings()->count() }}</h6>
                                    </div>
                                </div>
                                @if ($user->hasrole('driver'))
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="radius-8 h-100 text-center p-20 bg-success-100">
                                            <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-success-200 border border-success-400 text-success-600">
                                                <i class="ri-money-dollar-circle-line"></i> <!-- Icône pour "Total Montant" -->
                                            </span>
                                            <span class="text-neutral-700 d-block">Total Reçu</span>
                                            <h6 class="mb-0 mt-4">{{ $user->totalAmountReceived() }} XOF</h6>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="radius-8 h-100 text-center p-20 bg-warning-100">
                                            <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-warning-200 border border-warning-400 text-success-600">
                                                <i class="ri-money-dollar-circle-line"></i> <!-- Icône pour "Total Montant" -->
                                            </span>
                                            <span class="text-neutral-700 d-block">Total Payé</span>
                                            <h6 class="mb-0 mt-4">{{ $user->totalAmountPaid() }} XOF</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="row g-3 mt-3">
                                <!-- Nombre d'Avis -->
                                <div class="col-sm-4 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-warning-100">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-warning-200 border border-warning-400 text-warning-600">
                                            <i class="ri-star-line"></i> <!-- Icône pour "Avis" -->
                                        </span>
                                        <span class="text-neutral-700 d-block">Nombre d'Avis</span>
                                        <h6 class="mb-0 mt-4">{{ $receivedReviewsCount }}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-light">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-info-200 border border-info-400 text-info-600">
                                            <i class="ri-star-fill"></i> <!-- Icône pour les étoiles -->
                                        </span>
                                        <span class="text-neutral-700 d-block">Moyenne des Étoiles</span>
                                        <h6 class="mb-0 mt-4">{{ $averageRating }}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-danger-100">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-danger-200 border border-danger-400 text-danger-600">
                                            <i class="ri-file-list-2-line"></i> <!-- Icône pour "Total Demande" -->
                                        </span>
                                        <span class="text-neutral-700 d-block">Total Demande</span>
                                        <h6 class="mb-0 mt-4">{{ $totalRideRequests }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

