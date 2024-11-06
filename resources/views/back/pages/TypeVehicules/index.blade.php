@extends('back.layouts.master')
@section('title', 'Liste des commentaires')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des Types de Véhicules</h5>
        {{-- <a href="{{ route($typevehicles.create') }}" class="btn btn-primary">Ajouter un Type de Véhicule</a> --}}
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">#</div>
                        </th>
                        <th scope="col">Nom du Type</th>
                        <th scope="col">Taux par km (FCFA)</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($typevehicles->isEmpty())
                        <tr>
                            <td colspan="4" class="text-danger text-center">Aucun type de véhicule enregistré</td>
                        </tr>
                    @else
                        @foreach ($typevehicles as $key => $typevehicle)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-10">
                                        {{ $key + 1 }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="text-md mb-0 fw-normal text-secondary-light">{{ $typevehicle->label }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{ $typevehicle->taux_per_km }} FCFA</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        {{-- <!-- Edit -->
                                        <a href="{{ route($typevehicles.edit', $typeVehicle) }}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a> --}}

                                        <!-- Delete -->
                                        <form action="{{ route('typevehicles.destroy', $typevehicle) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type de véhicule ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if (!$typevehicles->isEmpty())
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $typevehicles->firstItem() }} de {{ $typevehicles->lastItem() }} a
                        {{ $typevehicles->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{-- Pagination --}}
                        @if ($typevehicles->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $typevehicles->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </a>
                            </li>
                        @endif

                        @foreach ($typevehicles->links()->elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $typevehicles->currentPage())
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

                        @if ($typevehicles->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $typevehicles->nextPageUrl() }}">
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
            @endif
        </div>
    </div>
</div>


@endsection
