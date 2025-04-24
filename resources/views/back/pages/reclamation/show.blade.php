@extends('back.layouts.master')
@section('title', "Détails d'un réclamation")
@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24">
        <h5 class="card-title mb-0">@yield('title')</h5>
    </div>
    <div class="card-body p-24">
        <div class="row">
            <div class="col-md-12">
                <strong>Message</strong>
                <p class="text-warning">{{ $reclamation->message }}</p>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-md-6">
                <strong>Auteur</strong>
                <p>
                    <a href="{{ route('users.show', $reclamation->user->email) }}">
                        {{ $reclamation->user->firstname }} {{ $reclamation->user->lastname }}
                    </a>
                </p>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong>Réservation</strong>
                <p>
                    @if ($reclamation->booking)
                        <a href="{{ route('bookings.show', $reclamation->booking->id) }}">
                            #{{ $reclamation->booking->booking_number ?? $reclamation->booking->id }}
                        </a>
                    @else
                        <span class="text-muted">Aucune</span>
                    @endif
                </p>
            </div>
            <div class="col-md-6">
                <strong>Date de la réclamation</strong>
                <p>{{ \Carbon\Carbon::parse($reclamation->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('reclamations.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>


@endsection
