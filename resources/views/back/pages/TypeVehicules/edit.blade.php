@extends('back.layouts.master')
@section('title', 'Détails du commentaire')
@section('content')

<div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Modifier le Type de Véhicule</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('typevehicles.update', $typevehicle) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="label" class="form-label">Nom du Type de Véhicule</label>
                        <input type="text" name="label" id="label" class="form-control" value="{{ old('label', $typevehicle->label) }}" required>
                    </div>

                    <!-- Champs Catégories  -->
                    <div class="col-md-12">
                        <label class="form-label">Sélectionnez une catégorie</label>
                        <select class="form-select" name="categorie_id" required>
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ $categorie->id == $typevehicle->categorie_id ? 'selected' : '' }}>{{ $categorie->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                        <a href="{{ route('typevehicles.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
