@extends('back.layouts.master')
@section('title', 'Liste des demandes ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">

        </div>
       <!-- Content -->
<div class="card-body p-24">
    <div class="table-responsive scroll-sm">
        <table class="table bordered-table sm-table mb-0">
            <thead>
                <tr>
                    <th scope="col">
                        <div class="d-flex align-items-center gap-10">

                           #
                        </div>
                    </th>
                    <th scope="col">Date</th>
                    <th scope="col">Départ</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Places Disponibles</th>
                    <th scope="col">Statut</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rideRequests as $key => $ride)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-10">

                            {{ $key + 1 }}
                        </div>
                    </td>
                    <td>{{ $ride->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="text-md mb-0 fw-normal text-secondary-light">{{ $ride->departure }}</span>
                        </div>
                    </td>
                    <td><span class="text-md mb-0 fw-normal text-secondary-light">{{ $ride->destination }}</span></td>

                    <td>{{ $ride->preferred_amount }}</td>
                    <td>
                        <span class="badge
                            {{ $ride->status == 'pending' ? 'bg-primary' : ($ride->status == 'responded' ? 'bg-success' : ($ride->status == 'completed' ? 'bg-info' : ($ride->status == 'refunded' ? 'bg-warning' : 'bg-danger'))) }}">
                            {{ $ride->status == 'pending' ? 'En attente' : ($ride->status == 'responded' ? 'Répondu' : ($ride->status == 'completed' ? 'Complété' : ($ride->status == 'refunded' ? 'Remboursé' : 'Annulé'))) }}
                        </span>
                    </td>

                    <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            <!-- View -->

                             <form action="{{ route('ride_requests.status',[$ride,'status'=> 'refunded']) }}" method="GET">
                                <button type="submit" class="btn btn-primary text-sm "
                                    {{ $ride->status != 'cancelled' ? 'disabled' : '' }}>
                                    Remboursé
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

                {{-- pagination --}}

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage  {{ $rideRequests->firstItem() }} de {{ $rideRequests->lastItem() }} a
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
                                <li class="page-item disabled"><span
                                        class="page-link">{{ $element }}</span></li>
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
    </div>
</div>
<!-- / Content -->



        </div>
    </div>

@endsection