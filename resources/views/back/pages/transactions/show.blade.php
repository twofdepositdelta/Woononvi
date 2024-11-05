
@extends('back.layouts.master')
@section('title', 'Détails de la Transaction')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Détails de la Transaction</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Passager :</strong>
                <p class="mb-0">{{ $transaction->booking->passenger->firstname.' '.$transaction->booking->passenger->lastname ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <strong>Conducteur :</strong>
                <p class="mb-0">{{$transaction->driver->firstname.' '.$transaction->driver->lastname ?? 'Conducteur non disponible' }}</p>
            </div>
        </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Trajet :</strong>
            <p>{{ $transaction->booking->ride->departure }} - {{ $transaction->booking->ride->destination }}</p>
        </div>

        <div class="col-md-6">
            <strong>Frais de Plateforme :</strong>
            <p>{{ number_format(($transaction->booking->total_price * $transaction->booking->ride->commission_rate)/100,0,',',' ')  }} Fcfa</p>
        </div>
    </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Montant de la Transaction :</strong>
                <p class="mb-0">{{ number_format($transaction->booking->total_price,0, ',', ' ') }} FCFA</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Méthode de Paiement :</strong>
                <p class="mb-0">{{ ucfirst($transaction->payment_method) }}</p>
            </div>
            <div class="col-md-6">
                <strong>Statut de la Transaction :</strong>
                @if ($transaction->status == 'completed')
                    <span class="badge bg-success">Réussi</span>
                @elseif ($transaction->status == 'pending')
                    <span class="badge bg-warning">En attente</span>
                @elseif ($transaction->status == 'cancelled')
                    <span class="badge bg-danger">Annulé</span>
                @elseif ($transaction->status == 'refunded')
                    <span class="badge bg-secondary">Remboursé</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Date de la Transaction :</strong>
                <p class="mb-0">{{ \Carbon\Carbon::parse($transaction->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
            </div>
            <div class="col-md-6">
                <strong>Identifiant de la Transaction :</strong>
                <p class="mb-0">{{ $transaction->transaction_reference ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <div class="card-footer text-end">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Retour à la Liste</a>
    </div>
</div>


@endsection
