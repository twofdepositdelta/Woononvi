@extends('back.layouts.master')
@section('title', 'Détails du Véhicule')
@section('content')

<div class="row gy-4">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Détails du Véhicule</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Image du véhicule -->
                    <div class="col-md-5 text-center mb-3">
                        <img src="{{ asset($vehicle->main_image) }}" alt="Image du véhicule" class="img-fluid rounded" style="max-height: 300px;">
                    </div>

                    <!-- Informations du véhicule -->
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Marque :</strong>
                                <p>{{ $vehicle->vehicle_mark }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Modèle :</strong>
                                <p>{{ $vehicle->vehicle_model }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Année :</strong>
                                <p>{{ $vehicle->vehicle_year }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Couleur :</strong>
                                <p>{{ $vehicle->color }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Nombre de places :</strong>
                                <p>{{ $vehicle->seats }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Immatriculation :</strong>
                                <p>{{ $vehicle->licence_plate ?? 'Non renseigné' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Type de Véhicule :</strong>
                                <p>{{ $vehicle->typeVehicle->label }} ({{ $vehicle->typeVehicle->taux_per_km }} FCFA/km)</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Propriétaire :</strong>
                                <p>{{$vehicle->driver->firstname.' '.$vehicle->driver->lastname  }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="text-end mt-4">
                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary ms-2">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



