@extends('back.layouts.master')
@section('title', 'Liste des Documents ')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des Documents</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Document</th>
                        <th>Numéro</th>
                        <th>Date d'expiration</th>
                        <th>Conducteur</th>
                        <th>Validation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="7" class="text-danger text-center">Aucun document enregistré</td>
                        </tr>
                    @else
                        @foreach ($documents as $index => $document)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $document->typeDocument->label ?? 'Non défini' }}</td>
                                <td>{{ $document->number ?? 'Non disponible' }}</td>
                                <td>{{ \Carbon\Carbon::parse($document->expiry_date)->locale('fr')->translatedFormat('D, d M Y') }}</td>
                                <td>
                                    <a href="{{ route('users.show', $document->user->email) }}">
                                        {{ $document->user->firstname . ' ' . $document->user->lastname ?? 'Non disponible' }}
                                    </a>
                                </td>
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
                                        <!-- Valider le document -->
                                        <form action="{{ route('documents.validated', $document) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary text-sm">
                                                {{ $document->is_validated ? 'Annuler ' : 'Valider' }}
                                            </button>
                                        </form>
                                        @if ($document->is_validated ==false)
                                        <button  class="btn btn-danger text-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-document-id="{{ $document->id}}" {{$document->is_rejected==true ?'disabled':''}}>
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
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Devis</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                         <form action="{{route('documents.reason',['id' => ''])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="document_id" id="inputDocumentId">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Raison:</label>
                                                <textarea rows="5" cols="5" name="reason" required class="form-control"
                                                    placeholder="Description de la raison">{{ old('reason') }}</textarea>
                                                @error('reason')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
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
            {{-- pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>Affichage {{ $documents->firstItem() }} de {{ $documents->lastItem() }} à {{ $documents->total() }} entrées</span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Lien de page précédente --}}
                    @if ($documents->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $documents->previousPageUrl() }}">
                                <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination --}}
                    @foreach ($documents->links()->elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $documents->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link bg-primary-600 text-white fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                            href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Lien de page suivante --}}
                    @if ($documents->hasMorePages())
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $documents->nextPageUrl() }}">
                                <iconify-icon icon="ep:d-arrow-right"></iconify-icon>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                <iconify-icon icon="ep:d-arrow-right"></iconify-icon>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
            {{-- fin de pagination --}}
        </div>
    </div>
    <!-- / Content -->
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
