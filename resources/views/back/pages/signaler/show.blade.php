@extends('back.layouts.master')
@section('title', 'Détails du Signalement')
@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24">
        <h5 class="card-title mb-0">Détails du Signalement</h5>
    </div>
    <div class="card-body p-24">
        <div class="row">
            <div class="col-md-12">
                <strong>Description</strong>
                <p class="text-warning">{{ $report->description }}</p>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-md-6">
                <strong>Auteur</strong>
                <p>
                    <a href="{{ route('users.show', $report->user->email) }}">
                        {{ $report->user->firstname . ' ' . $report->user->lastname }}
                    </a>
                </p>
            </div>
            <div class="col-md-6">
                <strong>Type de Signalement</strong>
                <p>{{ $report->reportType->name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong>Réservation</strong>
                <p>
                    <a href="{{ route('bookings.show', $report->booking->booking_number) }}">
                        #{{ $report->booking->booking_number }} <!-- ID de la réservation -->
                    </a>
                </p>
            </div>
            <div class="col-md-6">
                <strong>Date du Signalement</strong>
                <p>{{ \Carbon\Carbon::parse($report->created_at)->locale('fr')->translatedFormat('D, d M Y,H:i') }}</p>
            </div>
        </div>



        <div class="text-end">

            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>

@endsection
