<div class="col-xxl-9 col-xl-12">
    <div class="card h-100">
        <div class="card-body p-24">

            <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab"
                            aria-controls="pills-to-do-list" aria-selected="true">
                            Trajets d'aujourd'hui
                            <span
                                class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">{{ BackHelper::getTodayRidesTotal() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab"
                            aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                            Réservations d'aujourd'hui
                            <span
                                class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">{{ backHelper::getTodayBookingsTotal() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center" id="pills-recent-users-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-users-leads" type="button" role="tab"
                            aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                            Dernières inscriptions
                            <span
                                class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">{{ backHelper::showLastFiftyUsersTotal() }}</span>
                        </button>
                    </li>
                </ul>
                <a href="{{ route('tarjets.cartograpie') }}"
                    class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    Vue d'ensemble
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                </a>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel"
                    aria-labelledby="pills-to-do-list-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Conducteurs</th>
                                    <th scope="col">Heure de Départ</th>
                                    <th scope="col">Point de Départ</th>
                                    <th scope="col">Point d'Arrivée</th>
                                    <th scope="col">Places</th>
                                    <th scope="col" class="text-center">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (BackHelper::getTodayRides() as $ride)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($ride->driver->profile->avatar) }}" alt="Avatar"
                                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">
                                                        {{ $ride->driver->lastname . ' ' . $ride->driver->firstname }}
                                                    </h6>
                                                    <span
                                                        class="text-sm text-secondary-light fw-medium">{{ $ride->driver->phone }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($ride->departure_time)->format('H:i') }}</td>
                                        <td>{{ $ride->start_location_name }}</td>
                                        <td>{{ $ride->end_location_name }}</td>
                                        <td>{{ $ride->available_seats }}</td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = match ($ride->status) {
                                                    'active' => 'bg-info-600',
                                                    'completed' => 'bg-success-600',
                                                    'cancelled' => 'bg-danger-600',
                                                    'suspend' => 'bg-neutral-800',
                                                    'pending' => 'bg-lilac-600',
                                                    default => 'bg-primary-600',
                                                };

                                                $statusLabel = match ($ride->status) {
                                                    'active' => 'En chemin',
                                                    'completed' => 'Terminé',
                                                    'cancelled' => 'Annulé',
                                                    'suspend' => 'Suspendu',
                                                    'pending' => 'En attente',
                                                    default => ucfirst($ride->status),
                                                };
                                            @endphp
                                            <span
                                                class="badge {{ $statusClass }} text-sm fw-semibold px-20 py-9 radius-4 text-white">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Aucun trajet prévu pour aujourd'hui.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ BackHelper::getTodayRides()->links() }}
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel"
                    aria-labelledby="pills-recent-leads-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Passager</th>
                                    <th scope="col">Trajet</th>
                                    <th scope="col">NPR</th>
                                    <th scope="col">Prix Total</th>
                                    <th scope="col">Date de Réservation</th>
                                    <th scope="col" class="text-center">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (BackHelper::getTodayBookings() as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_number }}</td>
                                        <td>{{ $booking->passenger->firstname . ' ' . $booking->passenger->lastname }}
                                        </td>
                                        <td>{{ $booking->ride->start_location_name }} -
                                            {{ $booking->ride->end_location_name }}</td>
                                        <td>{{ $booking->seats_reserved }}</td>
                                        <td>{{ $booking->total_price }} FCFA</td>
                                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Aucune réservation aujourd'hui</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ BackHelper::getTodayBookings()->links() }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-users-leads" role="tabpanel"
                    aria-labelledby="pills-recent-users-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Depuis le</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (backHelper::showLastFiftyUsers() as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($user->profile->avatar ?? 'default-avatar.png') }}"
                                                    alt="Avatar"
                                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">
                                                        {{ $user->lastname . ' ' . $user->firstname }}</h6>
                                                    <span
                                                        class="text-sm text-secondary-light fw-medium">{{ $user->phone }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-{{ $user->gender == 'male' ? 'info' : 'warning' }}">
                                            @if ($user->gender)
                                                {{ $user->gender == 'male' ? 'Homme' : 'Femme' }}
                                            @else
                                                Pas defini
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user->status == true ? 'bg-success-600' : 'bg-danger-600' }} text-sm fw-semibold px-20 py-9 radius-4 text-white">
                                                {{ $user->status == true ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun utilisateur trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ BackHelper::showLastFiftyUsers()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
