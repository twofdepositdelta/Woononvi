<table class="table bordered-table sm-table mb-0">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Heure de départ</th>
            <th>Départ</th>
            <th>Destination</th>
            <th>Prix/km</th>
            <th>Conducteur</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($rides->isEmpty())
            <tr>
                <td colspan="11" class="text-danger text-center">Aucun trajet enregistré</td>
            </tr>
        @else
            @foreach ($rides as $index => $ride)
                <tr>
                    <td>#{{ $ride->numero_ride }}</td>

                    <td>{{ \Carbon\Carbon::parse($ride->departure_time)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</td>

                    <td>{{ $ride->start_location_name }}</td>
                    <td>{{ $ride->end_location_name }}</td>
                    <td>{{ $ride->price_per_km }} FCFA</td>
                    <td>
                        @if ($ride->driver)
                            <a href="{{ route('users.show', $ride->driver->email) }}">
                                {{ $ride->driver->firstname }} {{ $ride->driver->lastname }}
                            </a>
                        @else
                            <span class="text-muted">Non disponible</span>
                        @endif
                    </td>
                    {{-- <td>{{$ride->start_location->getLat()}}  {{$ride->start_location->getLng()}}</td> --}}

                    <td>
                        @switch($ride->status)
                            @case('active')
                                <span class="badge bg-success">Active</span>
                                @break
                            @case('pending')
                                <span class="badge bg-warning">En attente</span>
                                @break
                            @case('completed')
                                <span class="badge bg-info">Terminé</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-secondary">Annulée</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Non défini</span>
                        @endswitch
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            <!-- Voir -->
                            <a href="{{ route('rides.show', $ride) }}" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </a>
                            {{-- <!-- Suspendre -->
                            <form action="{{ route('rides.status', [$ride, 'status' => 'suspend']) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir suspendre ce trajet ?');">
                                @csrf
                                <button type="submit" class="btn btn-primary text-sm" {{ $ride->status != 'pending' ? 'disabled' : '' }}>
                                    Suspendre
                                </button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

@if (!$rides->isEmpty())

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

@endif
