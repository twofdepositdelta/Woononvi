@extends('back.layouts.master')
@section('title', 'Liste des réservations ')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des Réservations</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Date de réservation</th>
                        {{-- <th>Trajet</th> --}}
                        <th>Passager</th>
                        <th>Prix total</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bookings->isEmpty())
                        <tr>
                            <td colspan="7" class="text-danger text-center">Aucune réservation enregistrée</td>
                        </tr>
                    @else
                        @foreach ($bookings as $booking)
                            <tr>
                                <!-- Numéro de réservation -->
                                <td>#{{ $booking->booking_number }}</td>

                                <!-- Date de réservation -->
                                <td>{{ \Carbon\Carbon::parse($booking->created_at)->locale('fr')->translatedFormat('D, d M Y') }}</td>

                                <!-- Trajet (Départ et Destination) -->
                                {{-- <td>
                                    <a href="{{ route('rides.show', $booking->ride->id) }}">
                                        {{ $booking->ride->start_location }} - {{ $booking->ride->end_location }}
                                    </a>
                                </td> --}}

                                <!-- Passager -->
                                <td>
                                    <a href="{{ route('users.show', $booking->passenger->email) }}">
                                        {{ $booking->passenger->firstname }} {{ $booking->passenger->lastname ?? 'Non disponible' }}
                                    </a>
                                </td>

                                <!-- Prix total -->
                                <td>{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</td>

                                <!-- Statut -->
                                <td>
                                    @switch($booking->status)
                                        @case('accepted')
                                            <span class="badge bg-success">Acceptée</span>
                                            @break
                                        @case('pending')
                                            <span class="badge bg-warning">En attente</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">Rejetée</span>
                                            @break
                                        @case('validated_by_passenger')
                                            <span class="badge bg-info">Confirmée  passager</span>
                                            @break
                                        @case('validated_by_driver')
                                            <span class="badge bg-primary">Confirmée conducteur</span>
                                            @break
                                        @case('refunded')
                                            <span class="badge bg-info">Remboursée</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-secondary">Annulée</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">Non défini</span>
                                    @endswitch
                                </td>

                                <!-- Actions -->
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <!-- Vue -->
                                        <a href="{{ route('bookings.show', $booking) }}" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                        </a>

                                       
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
             {{-- pagination --}}
             <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>Affichage {{ $bookings->firstItem() }} de {{ $bookings->lastItem() }} a
                    {{ $bookings->total() }} entrées</span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($bookings->onFirstPage())
                        <li class="page-item disabled">
                            <span
                                class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $bookings->previousPageUrl() }}">
                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($bookings->links()->elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $bookings->currentPage())
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
                    @if ($bookings->hasMorePages())
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $bookings->nextPageUrl() }}">
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

@endsection
