@extends('back.layouts.master')
@section('title', 'Détails du Véhicule')
@section('content')

<div class="row gy-4">
    <div class="col-lg-12">
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



                <div class="col-md-12 mb-5">
                    <!-- Table responsive pour adapter la taille de la table -->
                    <div class="table-responsive">
                        <table class="table bordered-table sm-table mb-0" style="max-width: 100%;">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Document</th>
                                    <th>Date d'expiration</th>
                                    <th>Raison</th>
                                    <th>Validation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($vehicle->documents->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-danger text-center">Aucun document enregistré</td>
                                    </tr>
                                @else
                                    @foreach ($vehicle->documents as $index => $document)
                                    @if ($document->vehicle_id != null)
                                        <tr>
                                            <td>#{{ $document->number ?? 'Non disponible' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <iconify-icon icon="ic:baseline-description" class="menu-icon" style="font-size: 24px; color: red;"></iconify-icon>
                                                    <a href="{{ asset($document->paper) }}" target="_blank" class="text-md mb-0 fw-medium flex-grow-1">{{ $document->typeDocument->label ?? 'Non défini' }}</a>

                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($document->expiry_date)->locale('fr')->translatedFormat('D, d M Y') }}</td>
                                            <td class="{{$document->reason ?'':'text-center'}}" >{{ $document->reason ?$document->reason :'-' }}</td>
                                            <td>

                                                @if($document->is_rejected)
                                                    <span class="badge bg-danger">Rejeté</span>
                                                @elseif($document->is_validated)
                                                    <span class="badge bg-success">Validé</span>
                                                @else
                                                    <span class="badge bg-warning">En attente</span>
                                                @endif
                                            </td>


                                            <td class="text-center">
                                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                                    <!-- Formulaire de validation -->
                                                    <form action="{{ route('documents.validated', $document) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir {{$document->is_validated ? 'annuler':'valider'}} ce document ?');">
                                                        @csrf

                                                             <button type="submit"
                                                                    class="btn text-sm {{ $document->is_validated ? 'btn-secondary text-muted' : 'btn-primary' }}"
                                                                    {{ $document->is_validated || $document->is_rejected ? 'disabled' : '' }} >
                                                                {{ $document->is_validated ? 'Déjà validé' : 'Valider' }}
                                                            </button>

                                                @if($document->is_validated)
                                                    <button id="statusButton"  type="submit" class="btn btn-danger text-sm">
                                                        Annuler
                                                    </button>
                                                @endif
                                                    </form>
                                                    @if ($document->is_validated == false)
                                                        <button class="btn btn-danger text-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                            data-document-id="{{ $document->id }}" {{ $document->is_rejected == true ? 'disabled' : '' }}>
                                                            Rejeter
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Raison</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                     <form action="{{route('documents.reason',['id' => ''])}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="document_id" id="inputDocumentId">
                                                        <div class="input-block mb-3">
                                                            <label class="col-form-label">Raison:</label>
                                                            <textarea rows="5" cols="5" name="reason" required class="form-control" maxlength="50"
                                                                placeholder="Description de la raison">{{ old('reason') }}</textarea>
                                                            @error('reason')
                                                                <span class="text-danger">
                                                                    {{$message}}
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Valider</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                </form>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- End of table responsive -->
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



