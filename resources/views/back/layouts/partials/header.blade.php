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
                <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
                <div class="dropdown d-none d-sm-inline-block">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/flags/flag9.png') }}" alt="image" class="w-24 h-24 object-fit-cover rounded-circle" id="default">
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-0">Choisir votre langue</h6>
                            </div>
                        </div>


                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">

                            <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="benin">
                                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/flags/flag9.png') }}" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0" id="Benin">
                                        <span class="text-md fw-semibold mb-0">Benin</span>
                                    </span>
                                </label>
                                <input class="form-check-input" type="radio" name="crypto" id="benin" checked>
                            </div>


                            <div class="form-check style-check d-flex align-items-center justify-content-between mb-16" >
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="france">
                                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/flags/flag3.png') }}" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0" id="France">
                                        <span class="text-md fw-semibold mb-0">France</span>
                                    </span>
                                </label>
                                <input class="form-check-input" type="radio" name="crypto" id="france">
                            </div>






                        </div>
                    </div>
                </div><!-- Language dropdown end -->



                <div class="dropdown">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                        type="button" data-bs-toggle="dropdown">
                        <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                        <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                            </div>
                            <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center" id="unread-count">0</span>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4" id="notifications-container">
                            <!-- Notifications dynamiques ici -->
                        </div>
                        <div class="text-center py-12 px-16">
                            <button class="btn btn-link text-primary-600 fw-semibold text-md" id="mark-all-read">Tout marquer comme lu</button>
                        </div>
                    </div>
                </div>
                <!-- Notification dropdown end -->

                <div class="dropdown">
                    <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset(Auth::user()->profile->avatar) }}" alt="image {{ Auth::user()->lastname }}" class="w-40-px h-40-px object-fit-cover rounded-circle">
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ BackHelper::getFullname(Auth::user()) }}</h6>
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
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="{{ route('profile.edit') }}">
                                    <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> Mon Profil
                                </a>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="email.php">
                                    <iconify-icon icon="tabler:message-check" class="icon text-xl"></iconify-icon> Inbox
                                </a>
                            </li> --}}
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="{{ route('settings') }}">
                                    <iconify-icon icon="icon-park-outline:setting-two" class="icon text-xl"></iconify-icon> Paramètres
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="{{ route('logout') }}">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Sélectionner les boutons radio pour chaque pays
        const benin = document.getElementById('benin');
        const france = document.getElementById('france');
        const img_france = document.getElementById('France');
        const img_benin = document.getElementById('Benin');
        const img_default = document.getElementById('default');

        // Fonction pour mettre à jour l'image en fonction du pays sélectionné
        function handleEnvironmentChange() {
            if (benin.checked) {
                img_default.setAttribute('src', img_benin.src); // Met à jour l'image par défaut avec l'image du Benin
            } else if (france.checked) {
                img_default.setAttribute('src', img_france.src); // Met à jour l'image par défaut avec l'image de la France
            }
        }

        // Ajouter un écouteur d’événement pour chaque bouton radio pour surveiller les changements
        benin.addEventListener('change', handleEnvironmentChange);
        france.addEventListener('change', handleEnvironmentChange);

        // Appeler la fonction au chargement pour afficher la bonne section par défaut
        handleEnvironmentChange();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationsContainer = document.getElementById('notifications-container');
        const unreadCount = document.getElementById('unread-count');
        const markAllReadButton = document.getElementById('mark-all-read');

        // Charger les notifications
        function loadNotifications() {
            fetch('/notifications')
                .then(response => response.json())
                .then(data => {
                    notificationsContainer.innerHTML = '';
                    unreadCount.textContent = data.unread_count;

                    data.notifications.forEach(notification => {
                        notificationsContainer.innerHTML += `
                            <a href="#" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                    <span class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                        ${notification.data.icon || 'N/A'}
                                    </span>
                                    <div>
                                        <h6 class="text-md fw-semibold mb-4">${notification.data.title}</h6>
                                        <p class="mb-0 text-sm text-secondary-light text-w-200-px">${notification.data.message}</p>
                                    </div>
                                </div>
                                <span class="text-sm text-secondary-light flex-shrink-0">${new Date(notification.created_at).toLocaleTimeString()}</span>
                            </a>
                        `;
                    });
                });
        }

        // Marquer toutes les notifications comme lues
        markAllReadButton.addEventListener('click', function () {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    loadNotifications();
                    unreadCount.textContent = 0;
                    alert(data.message);
                });
        });

        // Charger les notifications au chargement de la page
        loadNotifications();
    });

</script>


