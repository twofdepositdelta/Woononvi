@extends('back.layouts.master')
@section('title', 'historique des trajets ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">

        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ville de départ</th>
                            <th>Ville de destination</th>
                            <th>Heure de départ</th>
                            <th>Places disponibles</th>
                            <th>Prix par km</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rides as $index => $ride)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $ride->departure }}</td>
                                <td>{{ $ride->destination }}</td>
                                <td>{{ $ride->departure_time }}</td>
                                <td>{{ $ride->available_seats }}</td>
                                <td>{{ $ride->price_per_km }} FCFA</td>
                                <td>
                                    @if ($ride->status == 'active')
                                        <span class="badge bg-success">Actif</span>
                                    @elseif ($ride->status == 'completed')
                                        <span class="badge bg-info">Complété</span>
                                    @elseif ($ride->status == 'cancelled')
                                        <span class="badge bg-danger">Annulé</span>
                                    @elseif ($ride->status == 'pending')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif ($ride->status == 'suspend')
                                        <span class="badge bg-secondary">Suspendu</span>
                                    @endif
                                </td>

                                 <td class="text-end">
                                   <a href="{{ route('rides.show',$ride) }}"  type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                        </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- pagination --}}

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                        <span>Affichage {{ $rides->firstItem() }} de {{ $rides->lastItem() }} a
                            {{ $rides->total() }} entrées</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($rides->onFirstPage())
                                <li class="page-item disabled">
                                    <span
                                        class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                        href="{{ $rides->previousPageUrl() }}">
                                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($rides->links()->elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $rides->currentPage())
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
                            @if ($rides->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                        href="{{ $rides->nextPageUrl() }}">
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
            </div>
        </div>
        <!-- / Content -->
    </div>
    </div>

@endsection