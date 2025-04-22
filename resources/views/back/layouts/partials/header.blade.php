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
                {{-- <div class="dropdown d-none d-sm-inline-block">
                    <button
                        class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                        type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/flags/flag9.png') }}"
                            alt="image" class="w-24 h-24 object-fit-cover rounded-circle" id="default">
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div
                            class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-0">Choisir un pays</h6>
                            </div>
                        </div>


                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">

                            <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="benin">
                                    <span
                                        class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/flags/flag9.png') }}"
                                            alt=""
                                            class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0"
                                            id="Benin">
                                        <span class="text-md fw-semibold mb-0">Benin</span>
                                    </span>
                                </label>
                                <input class="form-check-input" type="radio" name="crypto" id="benin" checked>
                            </div>


                            <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="france">
                                    <span
                                        class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/flags/to.png') }}"
                                            alt=""
                                            class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0"
                                            id="France">
                                        <span class="text-md fw-semibold mb-0">Togo</span>
                                    </span>
                                </label>
                                <input class="form-check-input" type="radio" name="crypto" id="france">
                            </div>






                        </div>
                    </div>
                </div> --}}

                <div class="dropdown d-none d-sm-inline-block">
                    @if ( !auth()->user()->hasRole('support'))
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
                                                <input class="form-check-input" type="radio" name="country" value="{{$countrie->name}}" id="benin"
                                                    onchange="document.getElementById('country-form').submit();"
                                                    @if(session('selected_country') == $countrie->name) checked @endif>
                                            </div>


                                        @endforeach
                                </div>
                            </div>
                        </form>
                    @endif
                    </div>




                <div class="dropdown">
                    <button
                        class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                        type="button" data-bs-toggle="dropdown">
                        <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                        @if (BackHelper::getNotifications()['unread_count'] > 0)
                          <span
                            class="position-absolute top-0 start-50 translate-middle-y badge rounded-pill bg-danger-600 border-0">{{ BackHelper::getNotifications()['unread_count'] }}</span>
                         @endif
                        </button>
                    <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                        <div
                            class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                            </div>
                            {{-- <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">
                                {{ BackHelper::getNotifications()['unread_count'] }}
                            </span> --}}
                        </div>

                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                            @if (BackHelper::getNotifications()['unread_count'] > 0)
                                @foreach (BackHelper::getNotifications()['notifications'] as $notification)
                                    @if (!$notification->read_at)
                                        <a href="javascript:void(0)" data-id="{{ $notification->id }}"
                                            class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between notification-link {{ $notification->read_at ? '' : 'bg-neutral-50' }}">
                                            <div
                                                class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                                <span
                                                    class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                                    <iconify-icon icon="bitcoin-icons:verify-outline"
                                                        class="icon text-xxl"></iconify-icon>
                                                </span>
                                                <div>
                                                    <h6 class="text-md fw-semibold mb-4">
                                                        {{ $notification->data['title'] ?? 'Notification' }}</h6>
                                                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">
                                                        {{ $notification->data['message'] ?? '' }}</p>
                                                </div>
                                            </div>
                                            <span
                                                class="text-sm text-secondary-light flex-shrink-0">{{ $notification->created_at->diffForHumans() }}</span>
                                        </a>
                                    @endif
                                @endforeach

                                <!-- Afficher le bouton si des notifications non lues existent -->
                                <div class="text-center py-12 px-16">
                                    <button id="mark-all-read"
                                        class="btn btn-link text-primary-600 fw-semibold text-md">Tout marquer comme
                                        lu</button>
                                </div>
                            @else
                                <!-- Si aucune notification non lue -->
                                <p class="text-center py-12 px-16">Aucune notification</p>
                            @endif
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
