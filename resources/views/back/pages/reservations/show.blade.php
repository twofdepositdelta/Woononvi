@extends('back.layouts.master')
@section('title', 'Détails de la Réservation')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">Détails de la Réservation</h5>
        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Passager :</strong>
                    <p class="mb-0">
                        <a href="{{ route('users.show', $booking->passenger->email) }}">
                            {{ $booking->passenger->firstname . ' ' . $booking->passenger->lastname ?? 'Nom non disponible' }}
                        </a>
                    </p>
                </div>
                <div class="col-md-6">
                    <strong>Trajet :</strong>
                    <p class="mb-0">
                        <a href="{{ route('rides.show', $booking->ride->id) }}">
                            {{ $booking->ride->start_location_name }} - {{ $booking->ride->end_location_name }}

                        </a>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Places Réservées :</strong>
                    <p class="mb-0">{{ $booking->seats_reserved }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Commission appliquée :</strong>
                    <p class="mb-0">{{ $booking->commission_rate }} %</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Prix Total :</strong>
                    <p class="mb-0">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</p>
                </div>

                <div class="col-md-6">
                    <strong>Prix maintenir :</strong>
                    <p class="mb-0">{{ number_format($booking->price_maintain, 0, ',', ' ') }} FCFA</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Date :</strong>
                    <p class="mb-0">
                        {{ \Carbon\Carbon::parse($booking->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}
                    </p>
                </div>
                <div class="col-md-6">
                    <strong>Statut :</strong>

                    @if ($booking->status === 'accepted')
                        <span class="badge bg-success">Acceptée</span>
                    @elseif ($booking->status === 'pending')
                        <span class="badge bg-warning">En attente</span>
                    @elseif ($booking->status === 'rejected')
                        <span class="badge bg-danger">Rejetée</span>
                    @elseif ($booking->status === 'completed' && $booking->is_by_driver && $booking->is_by_passenger)
                        <span class="badge bg-info">Terminé</span>
                    @elseif ($booking->status === 'refunded')
                        <span class="badge bg-info">Remboursée</span>
                    @elseif ($booking->status === 'cancelled')
                        <span class="badge bg-secondary">Annulée</span>
                    @else
                        <span class="badge bg-success">Acceptée</span>
                    @endif



                </div>
            </div>



            <div class="row mb-3">


                <div class="col-md-6">
                    <strong>Date d'acceptement :</strong>
                    <p class="mb-0">
                        {{ $booking->accepted_at? \Carbon\Carbon::parse($booking->accepted_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non encore acceptée' }}
                    </p>
                </div>



                <div class="col-md-6">
                    <strong>Date du rejet :</strong>
                    <p class="mb-0">
                        {{ $booking->rejected_at? \Carbon\Carbon::parse($booking->rejected_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non encore rejetée' }}
                    </p>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Date Validée par Passager :</strong>
                    <p class="mb-0">
                        {{ $booking->validated_by_passenger_at? \Carbon\Carbon::parse($booking->validated_by_passenger_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                    </p>
                </div>
                <div class="col-md-6">
                    <strong>Date Validée par Conducteur :</strong>
                    <p class="mb-0">
                        {{ $booking->validated_by_driver_at? \Carbon\Carbon::parse($booking->validated_by_driver_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                    </p>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-md-6">
                    <strong>Date du Remboursement :</strong>
                    <p class="mb-0">
                        {{ $booking->refunded_at? \Carbon\Carbon::parse($booking->refunded_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <strong>Date d'annulement :</strong>
                    <p class="mb-0">
                        {{ $booking->cancelled_at? \Carbon\Carbon::parse($booking->cancelled_at)->locale('fr')->translatedFormat('D, d M Y, H:i'): 'Non défini' }}
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Numéro de réservation :</strong>
                    <p class="mb-0">#{{ $booking->booking_number }}</p>
                </div>
            </div>
        </div>


        <!-- / Content -->

        <div class="card-footer text-end">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Retour à la Liste</a>
        </div>
    </div>

@endsection
