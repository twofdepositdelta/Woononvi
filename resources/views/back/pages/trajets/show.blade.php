
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

        <!-- Type de trajet (Régulier ou autre) -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Type de Trajet :</strong>
                <p class="mb-0">
                    <span class="badge {{ $ride->type == 'regular' ? 'bg-primary' : 'bg-secondary' }}">
                        {{$ride->formatted_type }}
                    </span>
                </p>
            </div>

            <!-- Nombre de sièges disponibles -->
            <div class="col-md-6">
                <strong>Sièges Disponibles :</strong>
                <p class="mb-0">{{ $ride->available_seats }} Sièges</p>
            </div>
        </div>

        <!-- Jours de trajet (pour les trajets réguliers) -->
        @if($ride->type == 'regular' && $ride->days)
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Jours de Trajet :</strong>
                <p class="mb-0">
                    @foreach(json_decode($ride->days) as $day)
                        {{ ucfirst($day) }}{{ $loop->last ? '' : ', ' }}
                    @endforeach
                </p>
            </div>

            <div class="col-md-6">
                <strong>Prix par Km :</strong>
                <p class="mb-0">{{ $ride->price_per_km }} FCFA</p>
            </div>
        </div>
        @endif

        <!-- Heure de départ et heure de retour -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Heure de Départ :</strong>
                <p class="mb-0">{{ \Carbon\Carbon::parse($ride->departure_time)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>

            <div class="col-md-6">
                <strong>Heure de Retour :</strong>
                {{ $ride->return_time ? \Carbon\Carbon::parse($ride->return_time)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non définie' }}
            </div>
        </div>

        <!-- Localisation du trajet -->
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Lieu de Départ :</strong>
                <p class="mb-0">{{ $ride->start_location_name }} </p>
            </div>
            <div class="col-md-6">
                <strong>Lieu d'Arrivée :</strong>
                <p class="mb-0">{{ $ride->end_location_name }} </p>
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
                <p class="mb-0 badge bg-{{$ride->is_nearby_ride ?'success':'orange' }}">{{ $ride->is_nearby_ride ? 'Oui' : 'Non' }}</p>
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

            <!-- Véhicule -->
            <div class="col-md-6">
                <strong>Véhicule :</strong>
                <p class="mb-0">
                    {{ $ride->vehicle->vehicle_mark }} {{ $ride->vehicle->vehicle_mark }} ({{ $ride->vehicle->licence_plate }})
                </p>
            </div>
        </div>

    </div>

    <!-- Card Footer -->
    <div class="card-footer text-end">
        <a href="{{ route('rides.index') }}" class="btn btn-secondary">Retour à la Liste</a>


    <!-- Modal pour afficher les détails de la réservation -->
{{-- <div class="modal fade" id="bookingModal{{ $ride->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $ride->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel{{ $ride->id }}">Détails de la Réservation - Trajet {{ $ride->numero_ride }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Informations de la réservation -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nom du Passager :</strong>
                        <p class="mb-0">{{ $ride->booking->passenger->firstname }} {{ $ride->booking->passenger->lastname }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email du Passager :</strong>
                        <p class="mb-0">{{ $ride->booking->passenger->email }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nombre de Sièges Réservés :</strong>
                        <p class="mb-0">{{ $ride->booking->seats_reserved }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Prix Total :</strong>
                        <p class="mb-0">{{ number_format($booking->price_maintain, 0, ',', ' ') }} FCFA</p>
                    </div>
                </div>

                <!-- Statut de la réservation -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Statut de la Réservation :</strong>
                        @if ($ride->booking->status === 'accepted')
                        <span class="badge bg-success">Acceptée</span>
                    @elseif ($ride->booking->status === 'pending')
                        <span class="badge bg-warning">En attente</span>
                    @elseif ($ride->booking->status === 'rejected')
                        <span class="badge bg-danger">Rejetée</span>
                    @elseif ($ride->booking->status === 'completed' && $ride->booking->is_by_driver && $ride->booking->is_by_passenger)
                        <span class="badge bg-info">Terminé</span>
                    @elseif ($ride->booking->status === 'refunded')
                        <span class="badge bg-info">Remboursée</span>
                    @elseif ($ride->booking->status === 'cancelled')
                        <span class="badge bg-secondary">Annulée</span>
                    @else
                        <span class="badge bg-success">Acceptée</span>
                    @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Date de Réservation :</strong>
                        <p class="mb-0">{{ \Carbon\Carbon::parse($ride->booking->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div> --}}

</div>



@endsection
