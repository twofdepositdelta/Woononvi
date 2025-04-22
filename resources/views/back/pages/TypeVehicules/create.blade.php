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

                    <!-- Champs Catégories  -->
                    <div class="col-md-12">
                        <label class="form-label">Sélectionnez une catégorie</label>
                        <select class="form-select" name="categorie_id" required>
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Boutons d'action -->
                    <!-- Bouton Soumettre -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- / Content -->








@endsection
