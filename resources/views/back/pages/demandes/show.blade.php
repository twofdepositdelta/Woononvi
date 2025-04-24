@extends('back.layouts.master')
@section('title', 'Détails de la Demande')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">Détails de la Demande</h5>
        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <!-- Passager -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Passager :</strong>
                    <p class="mb-0">
                        <a href="{{ route('users.show', $rideRequest->passenger->email) }}">
                            {{ $rideRequest->passenger->firstname . ' ' . $rideRequest->passenger->lastname ?? 'Nom non disponible' }}
                        </a>
                    </p>
                </div>
            </div>

            <!-- Trajet -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Lieu de Départ :</strong>
                    <p class="mb-0">
                        {{ $rideRequest->start_location_name }}

                    </p>
                </div>
                <div class="col-md-6">
                    <strong>Lieu d'Arrivée :</strong>
                    <p class="mb-0">
                        {{ $rideRequest->end_location_name }}
                    </p>
                </div>
            </div>

            <!-- Places réservées -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Places Réservées :</strong>
                    <p class="mb-0">{{ $rideRequest->seats }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Commission appliquée :</strong>
                    <p class="mb-0">{{ $rideRequest->commission_rate }} %</p>
                </div>
            </div>



            <!-- Statut -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Statut :</strong>
                    @if ($rideRequest->status === 'accepted')
                        <span class="badge bg-success">Acceptée</span>
                    @elseif ($rideRequest->status === 'pending')
                        <span class="badge bg-warning">En attente</span>
                    @elseif ($rideRequest->status === 'rejected')
                        <span class="badge bg-danger">Rejetée</span>
                    @elseif ($rideRequest->status === 'completed' && $rideRequest->is_by_driver && $rideRequest->is_by_passenger)
                        <span class="badge bg-info">Terminé</span>
                    @elseif ($rideRequest->status === 'refunded')
                        <span class="badge bg-info">Remboursée</span>
                    @elseif ($rideRequest->status === 'cancelled')
                        <span class="badge bg-secondary">Annulée</span>
                    @else
                        <span class="badge bg-success">Acceptée</span>
                    @endif
                </div>

                <div class="col-md-6">
                    <strong>Date :</strong>
                    <p class="mb-0">
                        {{ \Carbon\Carbon::parse($rideRequest->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}
                    </p>
                </div>
            </div>



            <div class="row mb-3">

                @if ($rideRequest->accepted_at)
                    <div class="col-md-6">
                        <strong>Date d'acceptement :</strong>
                        <p class="mb-0">
                            {{ $rideRequest->accepted_at? \Carbon\Carbon::parse($rideRequest->accepted_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                        </p>
                    </div>
                @endif


                @if ($rideRequest->rejected_at)
                    <div class="col-md-6">
                        <strong>Date du rejet :</strong>
                        <p class="mb-0">
                            {{ $rideRequest->rejected_at? \Carbon\Carbon::parse($rideRequest->rejected_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                        </p>
                    </div>
                @endif

            </div>

            <div class="row mb-3">
                @if ($rideRequest->validated_by_passenger_at)
                    <div class="col-md-6">
                        <strong>Date Validée par Passager :</strong>
                        <p class="mb-0">
                            {{ $rideRequest->validated_by_passenger_at? \Carbon\Carbon::parse($rideRequest->validated_by_passenger_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                        </p>
                    </div>
                @endif

                @if ($rideRequest->validated_by_driver_at)

                    <div class="col-md-6">
                        <strong>Date Validée par Conducteur :</strong>
                        <p class="mb-0">
                            {{ $rideRequest->validated_by_driver_at? \Carbon\Carbon::parse($rideRequest->validated_by_driver_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                        </p>
                    </div>
                @endif





            </div>


                <div class="row mb-3">
                    @if ($rideRequest->refunded_at)
                        <div class="col-md-6">
                            <strong>Date du Remboursement :</strong>
                            <p class="mb-0">
                                {{ $rideRequest->refunded_at? \Carbon\Carbon::parse($rideRequest->refunded_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non encore remboursée' }}
                            </p>
                        </div>
                    @endif

                    @if ($rideRequest->cancelled_at)
                        <div class="col-md-6">
                            <strong>Date d'annulement :</strong>
                            <p class="mb-0">
                                {{ $rideRequest->cancelled_at? \Carbon\Carbon::parse($rideRequest->cancelled_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non encore annulée' }}
                            </p>
                        </div>
                    @endif
                </div>

       

        </div>



        <!-- / Content -->

        <div class="card-footer text-end">
            <a href="{{ route('ride_requests.index') }}" class="btn btn-secondary">Retour à la Liste</a>
        </div>
    </div>

@endsection
