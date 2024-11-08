@extends('back.layouts.master')
@section('title', 'Détails de la Réservation')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Détails de la Réservation</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Passager :</strong>
                <p class="mb-0"><a href="{{route('users.show',$booking->passenger->email)}}"> {{ $booking->passenger->firstname.' '.$booking->passenger->lastname ?? 'Nom non disponible' }}</a> </p>
            </div>
            <div class="col-md-6">
                <strong>Trajet :</strong>
                <p class="mb-0"><a href="{{route('rides.show',$booking->ride->id)}}">{{ $booking->ride->departure }} - {{ $booking->ride->destination }}</a></p>

            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Places Réservées :</strong>
                <p class="mb-0">{{ $booking->seats_reserved }}</p>
            </div>
            <div class="col-md-6">
                <strong>Prix Total :</strong>
                <p class="mb-0">{{ $booking->total_price }} FCFA</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Date de Réservation :</strong>
                <p class="mb-0">{{ \Carbon\Carbon::parse($booking->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>
            <div class="col-md-6">
                <strong>Statut de la Réservation :</strong>
                @if ($booking->status == 'confirmed')
                    <span class="badge bg-success">Confirmée</span>
                @elseif ($booking->status == 'pending')
                     <span class="badge bg-warning">En attente</span>
                @elseif ($booking->status == 'cancelled')
                    <span class="badge bg-danger">Annulée</span>
                @elseif ($booking->status == 'refunded')
                    <span class="badge bg-info">Remboursée</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Numero de reservation :</strong>
                <p class="mb-0">#{{$booking->booking_number}} </p>
            </div>

        </div>

    </div>
    <!-- / Content -->

    <div class="card-footer text-end">
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Retour à la Liste</a>
    </div>
</div>

@endsection
