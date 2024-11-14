@extends('back.layouts.master')

@section('title', 'Détails du document')
@section('content')
@php
// Définir la locale à français
setlocale(LC_TIME, 'fr_FR.UTF-8');
@endphp
<div class="dashboard-main-body">
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <img src="{{ asset('storage/back/assets/images/user-grid/user-grid-bg' . ($user->profile->genre == 'male' ? '10' : '7') . '.png') }}"
                    alt="" class="w-100 object-fit-cover" style="height: 30%">

                <div class="pb-24 ms-16 mb-24 me-16 mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="{{ asset($user->profile->avatar ? $user->profile->avatar : 'storage/back/assets/images/user-grid/user-grid-img14.png') }}"
                            alt=""
                            class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                        <h6 class="mb-0 mt-16">{{ strtoupper($user->lastname) . ' ' . ucfirst(strtolower($user->firstname)) }}</h6>
                        <span class="text-secondary-light mb-16">{{ $user->email }}</span>
                    </div>

                    <div class="mt-24 row">
                        <!-- Première colonne -->
                        <div class="col-lg-6">
                            <h6 class="text-xl mb-16">Informations Personnelles</h6>
                            <ul>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Nom Complet</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ strtoupper($user->lastname) . ' ' . ucfirst(strtolower($user->firstname)) }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Email</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $user->email }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Téléphone</span>
                                    <span class="w-70 text-secondary-light fw-medium">: ({{ $user->city->country->indicatif }}) {{ $user->phone }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Naissance</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $user->date_of_birth ? ucfirst(\Carbon\Carbon::parse($user->date_of_birth)->locale('fr_FR')->translatedFormat('D d M Y')) : 'N/A' }}</span>
                                </li>
                                @if ($user->gender)
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Genre</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $user->gender == 'male' ? 'Homme' : 'Femme' }}</span>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <!-- Deuxième colonne -->
                        <div class="col-lg-6">
                            <h6 class="text-xl mb-16">Plus d'Informations</h6>
                            <ul>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">NPI</span>
                                    <span class="w-70 text-secondary fw-medium">: {{ $user->npi ?? 'N/A' }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Compte</span>
                                    <span class="w-70 text-{{ $user->is_verified == true ? 'success' : 'danger' }} fw-medium">: {{ $user->is_verified ? 'Vérifié' : 'Non Vérifié' }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Adresse</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $user->profile->address ?? 'N/A' }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Depuis le</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ ucfirst(\Carbon\Carbon::parse($user->created_at)->locale('fr_FR')->translatedFormat('D d M Y')) }}</span>
                                </li>

                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Rôle</span>
                                    <span class="w-70 text-warning fw-medium">
                                        @if ($user->getRoleNames()->isNotEmpty())
                                        @foreach ($user->getRoleNames() as $role)
                                        <span>{{ \Spatie\Permission\Models\Role::where('name', $role)->first()->role }}</span>{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                        @else
                                        N/A
                                        @endif
                                    </span>
                                </li>

                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Nationalité</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $user->city->country->name }} <i class="{{ $user->city->country->icon }}"></i></span>
                                </li>

                                <li class="d-flex align-items-center gap-1">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Bio</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $user->profile->bio ?? 'N/A' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card h-100 col-12">
                <div class="card-body p-24">
                    <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex gap-4" id="pills-tab" role="tablist">
                        <li class="nav-item active show" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-edit-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab"
                                aria-controls="pills-edit-profile" aria-selected="true">
                                Liste des documents
                            </button>
                        </li>

                    </ul>
                    <div class=" d-flex justify-content-end mb-3">
                        <a href="{{ route('users.doc')}}" class="btn btn-info">
                            Retour
                        </a>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-edit-profile" role="tabpanel"
                            aria-labelledby="pills-edit-profile-tab" tabindex="0">

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
                                        @if ($user->documents->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-danger text-center">Aucun document enregistré</td>
                                            </tr>
                                        @else
                                            @foreach ($user->documents as $index => $document)
                                            @if ($document->vehicle_id == null)

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

                                           @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- End of table responsive -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var exampleModal = document.getElementById('exampleModal');
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Bouton qui a déclenché le modal
            var docId = button.getAttribute('data-document-id');  // Récupérer l'ID du devis


            // Assigner les valeurs aux champs cachés
            var inputDocumentId = document.getElementById('inputDocumentId');
            inputDocumentId.value = docId;
        });
    });
</script>


@endsection


