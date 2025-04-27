<div class="navbar-header">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-4">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                    <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>

            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <button type="button" data-theme-toggle
                    class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>


                <div class="dropdown d-none d-sm-inline-block">
                    @if ( !auth()->user()->hasRole(['support','manager']))
                       <form id="country-form" method="GET" action="{{ route('country.select') }}">
                            <button
                                class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                                type="button" data-bs-toggle="dropdown">

                                @php
                                  $selectedCountry = session('selected_country', 'benin'); // Pays sélectionné par défaut
                                    $country = BackHelper::getCountryByName($selectedCountry); // Récupère le pays à partir de son nom
                                    $icon = $country->icon ?? 'default-icon-class'; // Valeur par défaut si aucune icône n'est définie
                                @endphp
                                <i class="{{ $icon }}"></i> <!-- Affichage de l'icône -->

                            </button>

                            <div class="dropdown-menu to-top dropdown-menu-sm">
                                <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <h6 class="text-lg text-primary-light fw-semibold mb-0">Choisir un pays</h6>
                                </div>


                                <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
                                        @foreach (BackHelper::countries() as $countrie )
                                            <!-- Bénin -->
                                            <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                                                <label for="benin">
                                                    <span class="d-flex align-items-center gap-3">
                                                        <i class="{{$countrie->icon}}"></i>
                                                        <span>{{$countrie->name}}</span>
                                                    </span>
                                                </label>
                                                <input class="form-check-input" type="radio" name="country" value="{{$countrie->name}}"
                                                    onchange="document.getElementById('country-form').submit();"
                                                    @if(session('selected_country','Bénin') == $countrie->name) checked @endif>
                                            </div>


                                        @endforeach
                                </div>
                            </div>
                        </form>
                    @endif
                    </div>




                    <div class="dropdown" id="notificationDropdown">
                        <button
                            class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                            @if(BackHelper::getUserNotifications()['count_unread'] > 0)
                                <span id="notificationCountBadge"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ BackHelper::getUserNotifications()['count_unread'] }}
                                </span>
                            @endif
                        </button>

                        <div class="dropdown-menu to-top dropdown-menu-lg p-0" id="notificationMenu">
                            <div
                                class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                <div>
                                    <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                                </div>
                                <span
                                    class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">
                                    {{ BackHelper::getUserNotifications()['count_unread'] }}
                                </span>
                            </div>

                            <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                                @forelse (BackHelper::getUserNotifications()['all'] as $notif)
                                    <a href="#"
                                        class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between {{ $notif->read_at ? '' : 'bg-light' }}">
                                        <div class="text-black d-flex align-items-center gap-3">
                                            <span class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                                <iconify-icon icon="bitcoin-icons:verify-outline" class="icon text-xxl"></iconify-icon>
                                            </span>
                                            <div>
                                                <h6 class="text-md fw-semibold mb-4">{{ $notif->data['title'] ?? 'Notification' }}</h6>
                                                <p class="mb-0 text-sm text-secondary-light text-w-200-px">
                                                    {{ \Illuminate\Support\Str::limit($notif->data['message'] ?? '', 50) }}
                                                </p>
                                            </div>
                                        </div>
                                        <span class="text-sm text-secondary-light flex-shrink-0">
                                            {{ $notif->created_at->diffForHumans() }}
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-center text-muted py-3">Aucune notification</p>
                                @endforelse
                            </div>


                            <div class="text-center py-12 px-16">
                                <a href="{{route('notifications.index')}}" class="text-primary-600 fw-semibold text-md">Voir toutes les notifications</a>
                            </div>
                        </div>
                    </div>
                <!-- Notification dropdown end -->

                <div class="dropdown">
                    <button class="d-flex justify-content-center align-items-center rounded-circle" type="button"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset(Auth::user()->profile->avatar) }}" alt="image {{ Auth::user()->lastname }}"
                            class="w-40-px h-40-px object-fit-cover rounded-circle">
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div
                            class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-2">
                                    {{ BackHelper::getFullname(Auth::user()) }}</h6>
                                <span class="text-secondary-light fw-medium text-sm">
                                    @if (Auth::user()->getRoleNames()->isNotEmpty())
                                        @foreach (Auth::user()->getRoleNames() as $role)
                                            <span>{{ \Spatie\Permission\Models\Role::where('name', $role)->first()->role }}</span>{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <button type="button" class="hover-text-danger">
                                <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                            </button>
                        </div>
                        <ul class="to-top-list">
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                    href="{{ route('profile.edit') }}">
                                    <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> Mon
                                    Profil
                                </a>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="email.php">
                                    <iconify-icon icon="tabler:message-check" class="icon text-xl"></iconify-icon> Inbox
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                    href="{{ route('settings') }}">
                                    <iconify-icon icon="icon-park-outline:setting-two"
                                        class="icon text-xl"></iconify-icon> Paramètres
                                </a>
                            </li> --}}
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3"
                                    href="{{ route('logout') }}">
                                    <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Profile dropdown end -->
            </div>
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner les boutons radio pour chaque pays
        const benin = document.getElementById('benin');
        const france = document.getElementById('france');
        const img_france = document.getElementById('France');
        const img_benin = document.getElementById('Benin');
        const img_default = document.getElementById('default');

        // Fonction pour mettre à jour l'image en fonction du pays sélectionné
        function handleEnvironmentChange() {
            if (benin.checked) {
                img_default.setAttribute('src', img_benin
                    .src); // Met à jour l'image par défaut avec l'image du Benin
            } else if (france.checked) {
                img_default.setAttribute('src', img_france
                    .src); // Met à jour l'image par défaut avec l'image de la France
            }
        }

        // Ajouter un écouteur d’événement pour chaque bouton radio pour surveiller les changements
        benin.addEventListener('change', handleEnvironmentChange);
        france.addEventListener('change', handleEnvironmentChange);

        // Appeler la fonction au chargement pour afficher la bonne section par défaut
        handleEnvironmentChange();
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bouton "Tout marquer comme lu"
        document.getElementById('mark-all-read').addEventListener('click', function() {
            // Envoi de la requête pour marquer toutes les notifications comme lues
            fetch('{{ route('notifications.markAllRead') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);

                    // Supprimer toutes les notifications de la liste (après la réponse du serveur)
                    const notificationsContainer = document.querySelector('.max-h-400-px');

                    notificationsContainer.innerHTML =
                        `<p class="text-center py-12 px-16">Aucune notification</p>`;

                    // Supprimer le badge des notifications non lues
                    const badge = document.querySelector('.badge');
                    if (badge) {
                        badge.remove(); // On supprime le badge
                    }

                    // Mettre à jour le compteur global dans la dropdown
                    const counter = document.querySelector('.dropdown .text-primary-600');

                    if (counter) {
                        counter.textContent =
                        '0'; // Met à jour à 0 car toutes les notifications sont lues
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });

        // Marquer une notification spécifique comme lue
        document.querySelectorAll('.notification-link').forEach(function(notification) {
            notification.addEventListener('click', function() {
                const notificationId = this.dataset.id;
                const clickedElement = this; // Référence sauvegardée

                fetch(`/notifications/${notificationId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);

                        // Supprimer la notification cliquée
                        clickedElement.remove();

                        // Décrémenter le badge si nécessaire
                        const badge = document.querySelector('.badge');
                        if (badge) {
                            let unreadCount = parseInt(badge.textContent, 10) || 0;
                            unreadCount = Math.max(0, unreadCount -
                            1); // Empêcher un compteur négatif
                            if (unreadCount > 0) {
                                badge.textContent = unreadCount;
                            } else {
                                badge
                            .remove(); // Si aucune notification non lue, supprimer le badge
                            }
                        }

                        // Mettre à jour le compteur global dans la dropdown
                        const counter = document.querySelector(
                            '.dropdown .text-primary-600');
                        if (counter) {
                            let unreadCount = parseInt(counter.textContent, 10) || 0;
                            unreadCount = Math.max(0, unreadCount - 1);
                            counter.textContent = unreadCount;
                        }

                        // Vérifier si toutes les notifications ont été lues
                        const notificationsContainer = document.querySelector(
                            '.max-h-400-px');
                        if (!notificationsContainer.querySelector('.notification-link')) {
                            notificationsContainer.innerHTML =
                                `<p class="text-center py-12 px-16">Aucune notification</p>`;
                        }
                    })
                    .catch(error => console.error('Erreur:', error));
            });
        });
    });
</script>

@section('notification')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationMenu = document.getElementById('notificationMenu');
        const badge = document.getElementById('notificationCountBadge');

        // Quand le menu s'affiche
        notificationDropdown.addEventListener('show.bs.dropdown', function () {
            fetch('{{ route('notifications.markAllRead') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && badge) {
                    badge.textContent = '0';
                    badge.classList.add('d-none'); // Masque le badge si tu veux
                }
            });
        });
    });
</script>
@endsection
