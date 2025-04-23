@extends('back.layouts.master')
@section('title', 'Liste des réclamations')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">@yield('title')</h5>
        <div class="col-4">

        </div>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">

            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Réservation</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($reclamations->isEmpty())
                        <tr>
                            <td colspan="5" class="text-danger text-center">Aucune réclamation enregistrée</td>
                        </tr>
                    @else
                        @foreach($reclamations as $reclamation)
                            <tr>
                                <td>
                                    @if ($reclamation->booking)
                                        <a href="{{ route('bookings.show', $reclamation->booking->id) }}">
                                            #{{ $reclamation->booking->booking_number ?? $reclamation->booking->booking_number }}
                                        </a>
                                    @else
                                        <span class="text-muted">Aucune réservation</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $reclamation->user->email) }}">
                                        {{ $reclamation->user->firstname }} {{ $reclamation->user->lastname }}
                                    </a>
                                </td>

                                <td>
                                    <span class="badge
                                        @if($reclamation->statut == 'en_attente') bg-warning
                                        @elseif($reclamation->statut == 'en_cours') bg-info
                                        @else bg-success
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $reclamation->statut)) }}
                                </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($reclamation->created_at)->locale('fr')->translatedFormat('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                        <!-- Icône Vue -->
                                        <a href="{{ route('reclamations.show', $reclamation) }}"
                                           class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                           title="Voir la réclamation">
                                            <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                        </a>

                                        <!-- Statut ou badge -->
                                        @if($reclamation->statut != 'resolue')
                                            <form action="{{ route('reclamations.updateStatut', $reclamation) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="statut" onchange="this.form.submit()"
                                                        class="form-select form-select-sm w-auto py-1 px-2"
                                                        style="min-width: 120px;">
                                                    <option value="en_attente" {{ $reclamation->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                    <option value="en_cours" {{ $reclamation->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                                    <option value="resolue" {{ $reclamation->statut == 'resolue' ? 'selected' : '' }}>Résolue</option>
                                                </select>
                                            </form>
                                        @else
                                            <span class="badge bg-success">Clôturée</span>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if (!$reclamations->isEmpty())
                {{-- pagination --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $reclamations->firstItem() }} de {{ $reclamations->lastItem() }} a {{ $reclamations->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($reclamations->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="{{ $reclamations->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($reclamations->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $reclamations->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link bg-primary-600 text-white fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($reclamations->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="{{ $reclamations->nextPageUrl() }}">
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
                {{-- endpagination --}}
            @endif
        </div>
    </div>
    <!-- / Content -->
</div>



@endsection
