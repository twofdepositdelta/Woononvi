<table class="table bordered-table sm-table mb-0">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Date de réservation</th>
            <th>Trajet</th>
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
                    <td>{{ \Carbon\Carbon::parse($booking->created_at)->locale('fr')->translatedFormat('D, d M Y') }}
                    </td>

                    <!-- Trajet (Départ et Destination) -->
                    <td>
                        <a href="{{ route('rides.show', $booking->ride->numero_ride) }}">
                            {{ $booking->ride->start_location_name }} -
                            {{ $booking->ride->end_location_name }}
                        </a>
                    </td>

                    <!-- Passager -->
                    <td>
                        <a href="{{ route('users.show', $booking->passenger->email) }}">
                            {{ $booking->passenger->firstname }}
                            {{ $booking->passenger->lastname ?? 'Non disponible' }}
                        </a>
                    </td>

                    <!-- Prix total -->
                    <td>{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</td>

                    <!-- Statut -->
                    <td>
                        @if ($booking->status === 'accepted')
                            <span class="badge bg-success">Acceptée</span>
                        @elseif ($booking->status === 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif ($booking->status === 'rejected')
                            <span class="badge bg-danger">Rejetée</span>
                        @elseif ($booking->status === 'completed' && $booking->is_by_driver && $booking->is_by_passenger)
                            <span class="badge bg-info">Terminé</span>
                        @elseif ($booking->status === 'refunded')
                            <span class="badge bg-info">Remboursée</span>
                        @elseif ($booking->status === 'cancelled')
                            <span class="badge bg-secondary">Annulée</span>
                        @else
                            <span class="badge bg-success">Acceptée</span>
                        @endif

                    </td>

                    <!-- Actions -->
                    <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            <!-- Vue -->
                            <a href="{{ route('bookings.show', $booking) }}"
                                class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="majesticons:eye-line"
                                    class="icon text-xl"></iconify-icon>
                            </a>

                            <!-- Remboursement (si le statut est 'cancelled') -->
                            @hasanyrole(['super admin','manager','dev'])
                                <form
                                    action="{{ route('bookings.status', [$booking, 'status' => 'refunded']) }}"
                                    method="get" class="ms-2">
                                    @csrf
                                    <button type="submit" class="bg-danger-focus bg-hover-info-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                        {{ $booking->status != 'cancelled' ? 'disabled' : '' }}>
                                        <iconify-icon icon="fluent:arrow-sync-24-regular" class="menu-icon"></iconify-icon>


                                    </button>
                                </form>

                            @endrole
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


@if (!$bookings->isEmpty())
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

@endif

