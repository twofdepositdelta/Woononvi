@extends('back.layouts.master')
@section('title', 'Liste des demandes ')
@section('content')

    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4 mb-5">
        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-orange rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:question-circle" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Demandes</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $rideRequestcount }}</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-1">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-orange rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:question-circle" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>

                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale </h6>
                            <p class="fw-medium text-secondary-light mb-0">Demandes en attente
                            </p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8"> {{ $rideRequestcountpending }}</h6>
                            <span class="text-danger-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-5">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-orange rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:question-circle" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Demandes répondus</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $rideRequestcountresponded }}</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card h-100 p-0 radius-12 ">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">

        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Départ</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Nbr places</th>
                            <th scope="col">Demandeur</th>
                            <th scope="col">Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rideRequests->isEmpty())
                            <tr>
                                <td colspan="7" class="text-danger text-center">Aucune demande enregistrée</td>
                            </tr>
                        @else
                            @foreach ($rideRequests as $key => $rideRequest)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rideRequest->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $rideRequest->start_location_name }}

                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $rideRequest->end_location_name }}

                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $rideRequest->seats }}</td>
                                    <td>
                                        @if ($rideRequest->passenger)
                                            <a href="{{ route('users.show', $rideRequest->passenger->email) }}">
                                                {{ $rideRequest->passenger->firstname }}
                                                {{ $rideRequest->passenger->lastname }}
                                            </a>
                                        @else
                                            <span class="text-muted">Non disponible</span>
                                        @endif
                                    </td>
                                    <td>

                                        @if ($rideRequest->status === 'accepted')
                                            <span class="badge bg-success">Acceptée</span>
                                        @elseif ($rideRequest->status === 'pending')
                                            <span class="badge bg-warning">En attente</span>
                                        @elseif ($rideRequest->status === 'rejected')
                                            <span class="badge bg-danger">Rejetée</span>
                                        @elseif ($rideRequest->status === 'completed' && $rideRequest->is_by_driver && $rideRequest->is_by_passenger)
                                            <span class="badge bg-info">Terminé</span>
                                        @elseif ($rideRequest->status === 'refunded')
                                            <span class="badge bg-info">Remboursée</span>
                                        @elseif ($rideRequest->status === 'cancelled')
                                            <span class="badge bg-secondary">Annulée</span>
                                        @else
                                            <span class="badge bg-success">Acceptée</span>
                                        @endif

                                    </td>


                                    <td class="text-center">
                                        <div class="d-flex align-items-center gap-10 justify-content-center">
                                            <!-- Vue -->
                                            <a href="{{ route('ride_requests.show', $rideRequest) }}"
                                                class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                <iconify-icon icon="majesticons:eye-line"
                                                    class="icon text-xl"></iconify-icon>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                @if (!$rideRequests->isEmpty())

                    {{-- pagination --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                        <span>Affichage {{ $rideRequests->firstItem() }} de {{ $rideRequests->lastItem() }} a
                            {{ $rideRequests->total() }} entrées</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($rideRequests->onFirstPage())
                                <li class="page-item disabled">
                                    <span
                                        class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                        href="{{ $rideRequests->previousPageUrl() }}">
                                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($rideRequests->links()->elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $rideRequests->currentPage())
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
                            @if ($rideRequests->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                        href="{{ $rideRequests->nextPageUrl() }}">
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
            </div>
        </div>
        <!-- / Content -->



    </div>
    </div>

@endsection
