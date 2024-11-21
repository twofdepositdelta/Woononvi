
@extends('back.layouts.master')
@section('title', 'Détails des paiements')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Détails du Paiement</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Montant :</strong>
                <p class="mb-0">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Méthode de Paiement :</strong>
                <p class="mb-0">{{ ucfirst($payment->payment_method) }}</p>
            </div>
            <div class="col-md-6">
                <strong>Statut du Paiement :</strong>
                @if ($payment->status == 'PENDING')
                    <span class="badge bg-warning">En attente</span>
                @elseif ($payment->status == 'SUCCESSFUL')
                    <span class="badge bg-success">Réussi</span>
                @elseif ($payment->status == 'FAILED')
                    <span class="badge bg-danger">Échoué</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Utilisateur:</strong>
                <p>{{ $payment->user->firstname.' '.$payment->user->lastname ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <strong>Type de paiement :</strong>
                <p>{{ $payment->typepayment->label_fr }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Trajet :</strong>
                <p>{{ $payment->booking->ride->start_location_name.'-'. $payment->booking->ride->end_location_name ?? 'N/A' }} </p>
            </div>
            <div class="col-md-6">
                <strong>Frais de Plateforme :</strong>
                <p>{{ number_format(($payment->amount * $payment->booking->commission_rate) / 100, 0, ',', ' ') }} FCFA</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Date du Paiement :</strong>
                <p>{{ \Carbon\Carbon::parse($payment->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>
            <div class="col-md-6">
                <strong>Identifiant du Paiement :</strong>
                <p>{{ $payment->reference ?? 'N/A' }}</p>
            </div>
        </div>

    </div>
    <!-- / Content -->
    <div class="card-footer text-end">
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Retour à la Liste</a>
    </div>
</div>



@endsection
