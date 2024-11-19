
@extends('back.layouts.master')
@section('title', 'Détails du Trajet ')
@section('content')

<div class="card h-100 p-0 radius-12">
    <!-- Card Header -->
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Détails du Trajet</h5>
    </div>

    <!-- Card Body -->
    <div class="card-body p-24">

        <!-- Jours de trajet (pour les trajets réguliers) -->
        @if($ride->type == 'regular' && $ride->days)
        <div class="row mb-3">
            <div class="col-md-12">
                <strong>Jours de Trajet :</strong>
                <p class="mb-0">
                    @foreach(json_decode($ride->days) as $day)
                        {{ ucfirst($day) }}{{ $loop->last ? '' : ', ' }}
                    @endforeach
                </p>
            </div>
        </div>
        @endif

        <!-- Heure de départ et heure de retour -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Heure de Départ :</strong>
                <p class="mb-0">{{ \Carbon\Carbon::parse($ride->departure_time)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>
            @if($ride->return_time)
            <div class="col-md-6">
                <strong>Heure de Retour :</strong>
                <p class="mb-0">{{ \Carbon\Carbon::parse($ride->return_time)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>
            @endif
        </div>

        <!-- Prix par km et prix de maintien -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Prix par Km :</strong>
                <p class="mb-0">{{ $ride->price_per_km }} FCFA</p>
            </div>

            <div class="col-md-6">
                <strong>Prix à maintenir :</strong>
                <p class="mb-0">{{ $ride->price_maintain }} FCFA</p>
            </div>
        </div>

        <!-- Statut du trajet -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Statut du Trajet :</strong>
                @if ($ride->status == 'active')
                    <span class="badge bg-success">Actif</span>
                @elseif ($ride->status == 'completed')
                    <span class="badge bg-info">Complété</span>
                @elseif ($ride->status == 'cancelled')
                    <span class="badge bg-danger">Annulé</span>
                @elseif ($ride->status == 'pending')
                    <span class="badge bg-warning">En Attente</span>
                @elseif ($ride->status == 'suspend')
                    <span class="badge bg-secondary">Suspendu</span>
                @endif
            </div>

            <!-- Trajet proche -->
            <div class="col-md-6">
                <strong>Trajet Proche :</strong>
                <p class="mb-0">{{ $ride->is_nearby_ride ? 'Oui' : 'Non' }}</p>
            </div>
        </div>

        <!-- Conducteur -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Conducteur :</strong>
                <p class="mb-0">
                    <a href="{{ route('users.show', $ride->driver->email) }}">
                        {{ $ride->driver->firstname . ' ' . $ride->driver->lastname }}
                    </a>
                </p>
            </div>

            <div class="col-md-6">
                <strong>Type de Trajet :</strong>
                <p class="mb-0">
                    <span class="badge {{ $ride->type == 'regular' ? 'bg-primary' : 'bg-secondary' }}">
                        {{ $ride->formatted_type }} <!-- Appel du getter -->
                    </span>
                </p>
            </div>
        </div>

    </div>


    <!-- /Card Body -->

    <!-- Card Footer -->
    <div class="card-footer text-end">
        <a href="{{ route('rides.index') }}" class="btn btn-secondary">Retour à la Liste</a>
    </div>
</div>


@endsection
