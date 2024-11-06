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

                    <div class="mb-3">
                        <label for="taux_per_km" class="form-label">Taux par km (FCFA)</label>
                        <input type="number" name="taux_per_km" id="taux_per_km" class="form-control" value="{{ old('taux_per_km', $typevehicle->taux_per_km) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $typevehicle->description) }}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                        <a href="{{ route('typevehicles.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
