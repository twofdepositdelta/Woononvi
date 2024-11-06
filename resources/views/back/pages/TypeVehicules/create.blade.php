@extends('back.layouts.master')
@section('title', 'Type de Véhicule')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Créer un Type de Véhicule</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('typevehicles.store') }}" method="POST">
                    @csrf

                    <!-- Champ Label -->
                    <div class="mb-3">
                        <label for="label" class="form-label">Nom du Type de Véhicule</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Ex: Berline" value="{{ old('label') }}" required>
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Taux par Kilomètre -->
                    <div class="mb-3">
                        <label for="taux_per_km" class="form-label">Taux par Kilomètre (FCFA)</label>
                        <input type="number" class="form-control @error('taux_per_km') is-invalid @enderror" id="taux_per_km" name="taux_per_km" placeholder="Ex: 100" value="{{ old('taux_per_km') }}" required>
                        @error('taux_per_km')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons d'action -->
                    <!-- Bouton Soumettre -->
                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- / Content -->








@endsection
