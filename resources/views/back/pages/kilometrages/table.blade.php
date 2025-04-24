<table class="table bordered-table sm-table mb-0" style="max-width: 100%;">
    <thead>
        <tr>
            <th>Catégorie</th>
            <th>Intervalle (km)</th>
            <th>Taux (FCFA/km)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($kilos->isEmpty())
            <tr>
                <td colspan="7" class="text-danger text-center">Aucun kilometrage
                    enregistré</td>
            </tr>
        @else
            @foreach ($kilos as $index => $kilo)
                <tr>
                    <td>{{ $kilo->categorie->label ?? 'Non disponible' }}</td>

                    <td>{{ $kilo->min_km }} - {{ $kilo->max_km }} km</td>

                    <td>{{ $kilo->taux_par_km }} FCFA</td>

                    <td class="text-center">

                        <div
                            class="d-flex align-items-center gap-10 justify-content-center">

                            <a href="{{ route('kilometrages.edit', $kilo) }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal-{{ $kilo->id }}"
                                class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="lucide:edit"
                                    class="menu-icon"></iconify-icon>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('kilometrages.destroy', $kilo) }}"
                                method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="fluent:delete-24-regular"
                                        class="menu-icon"></iconify-icon>
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>

            @endforeach
        @endif
    </tbody>
</table>

@foreach ( $kilos as $kilo )

    <div class="modal fade" id="editModal-{{ $kilo->id }}" tabindex="-1"
        aria-labelledby="editModalLabel-{{ $kilo->id }}"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('kilometrages.update', $kilo->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h6 class="modal-title"
                            id="editModalLabel-{{ $kilo->id }}">Modifier
                            </h6>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kilomètre minimal</label>
                            <input type="number" name="min_km" min="1"
                                class="form-control"
                                value="{{ old('min_km', $kilo->min_km) }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kilomètre maximal</label>
                            <input type="number" name="max_km" min="1"
                                class="form-control"
                                value="{{ old('max_km', $kilo->max_km) }}"
                                required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Taux (FCFA)</label>
                            <input type="number" name="taux_par_km"
                                class="form-control"
                                value="{{ old('taux_par_km', $kilo->taux_par_km) }}"
                                required>
                        </div>

                        <input type="hidden" name="categorie_id"
                            value="{{ $kilo->categorie_id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Annuler</button>
                        <button type="submit"
                            class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endforeach

@if (!$kilos->isEmpty())
    {{-- pagination --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
        <span>Affichage {{ $kilos->firstItem() }} de {{ $kilos->lastItem() }} a
            {{ $kilos->total() }} entrées</span>
        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
            {{-- Previous Page Link --}}
            @if ($kilos->onFirstPage())
                <li class="page-item disabled">
                    <span
                        class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                        href="{{ $kilos->previousPageUrl() }}">
                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($kilos->links()->elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $kilos->currentPage())
                            <li class="page-item active">
                                <span
                                    class="page-link bg-primary-600 text-white fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md">{{ $page }}</span>
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

            {{-- Next Page Link --}}
            @if ($kilos->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                        href="{{ $kilos->nextPageUrl() }}">
                        <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span
                        class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                        <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                    </span>
                </li>
            @endif
        </ul>
    </div>
    {{-- endpagination --}}

@endif
