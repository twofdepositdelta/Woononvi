@extends('back.layouts.master')
@section('title', 'Détails du Contact')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Détails du Contact</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Nom & Prénom(s):</strong>
                <p>{{ $contact->fullname }}</p>
            </div>
            <div class="col-md-6">
                <strong>Email:</strong>
                <p>{{ $contact->email }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Téléphone:</strong>
                <p>{{ $contact->phone }}</p>
            </div>
            <div class="col-md-6">
                <strong>Sujet:</strong>
                <p>{{ $contact->subject }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Message:</strong>
                <p>{{ $contact->message }}</p>
            </div>
            <div class=" col-md-6">
                <strong>Date de soumission:</strong>
                <p>{{ $contact->created_at->format('d M Y à H:i') }}</p>
            </div>
        </div>


        <div class="d-flex justify-content-between">
            <a href="{{ route('contact.index') }}" class="btn btn-secondary">Retour à la liste</a>
            {{-- <div>
                <a href="{{ route('contacts.reply', $contact->id) }}" class="btn btn-info">Répondre</a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div> --}}
        </div>
    </div>
    <!-- / Content -->
</div>


@endsection
