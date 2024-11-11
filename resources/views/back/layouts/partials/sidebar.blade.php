<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.php" class="sidebar-logo">
            {{-- <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/assets/images/logo-light.png') }}" alt="site logo" class="dark-logo"> --}}

            <h6 class="text-warning">WONONVI</h6>
            <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Tableau de bord</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="index.php"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Back office</a>
                    </li>
                    <li>
                        <a href="index-2.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Vue d'ensemble</a>
                    </li>
                    {{-- <li>
                        <a href="index-3.php"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> eCommerce</a>
                    </li>
                    <li>
                        <a href="index-4.php"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Cryptocurrency</a>
                    </li>
                    <li>
                        <a href="index-5.php"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Investment</a>
                    </li> --}}
                </ul>
            </li>


            <li class="sidebar-menu-group-title">Application</li>
            {{-- <li>
                <a href="email.php">
                    <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                    <span>Email</span>
                </a>
            </li>
            <li>
                <a href="chat-message.php">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Chat</span>
                </a>
            </li>
            <li>
                <a href="calendar-main.php">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Calendar</span>
                </a>
            </li>
            <li>
                <a href="kanban.php">
                    <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                    <span>Kanban</span>
                </a>
            </li> --}}

            {{-- trajets --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ic:baseline-directions-car" class="menu-icon"></iconify-icon>
                    <span>TRAJETS</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('rides.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Liste</a>
                    </li>
                    <li>
                        <a href="{{route('rides.create')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Creer un trajet</a>
                    </li>
                    <li>
                        <a href="{{route('ridesearches.index')}}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Recherche</a>
                    </li>
                    <li>
                        <a href="{{route('rides.historique')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Historiques</a>
                    </li>
                </ul>
            </li>



            {{-- Reservation --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:calendar-check" class="menu-icon"></iconify-icon>
                    <span>RESERVATION</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('bookings.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Liste</a>
                    </li>
                    <li>
                        {{-- <a href="{{route('bookings.create')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Faire une reservation</a> --}}
                    </li>

                    <li>
                        <a href="{{route('bookings.historique')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Historiques</a>
                    </li>
                </ul>
            </li>

            {{-- demandes --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-question-line"></i>
                    <span>DEMANDES</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('ride_requests.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Liste</a>
                    </li>
                    <li>
                        <a href="{{route('ride_requests.create')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>Faire une demande</a>
                    </li>
                    <li>
                        <a href="{{route('ride_requests.historique')}}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>Historiques</a>
                    </li>
                </ul>
            </li>

            {{-- <li class="sidebar-menu-group-title">UI Elements</li> --}}

            {{-- transactions --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:transfer" class="menu-icon"></iconify-icon>
                    <span>TRANSACTIONS</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('transactions.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Liste</a>
                    </li>
                    {{-- <li>
                        <a href="colors.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Nouvelle transac</a>
                    </li> --}}
                    <li>
                        <a href="{{route('transactions.historique')}}"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Historiques</a>
                    </li>
                </ul>
            </li>

             {{-- avis --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:comment-text-outline" class="menu-icon"></iconify-icon>
                    <span>AVIS</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('reports.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Signaler</a>
                    </li>
                    <li>
                        <a href="{{route('reviews.index')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>Commentaire</a>
                    </li>
                </ul>
            </li>

            {{-- support --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>SUPPORT</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('chat.index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> chat en direct</a>
                    </li>
                    <li>
                        <a href="{{route('faqs.index')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>faq</a>
                    </li>
                    <li>
                        <a href="form-validation.php"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i>documentation</a>
                    </li>

                    <li>
                        <a href="{{route('contact.index')}}"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i>Contact</a>
                    </li>
                </ul>
            </li>


            {{-- rapport --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:file-chart" class="menu-icon"></iconify-icon>
                    <span>RAPPORTS</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="table-basic.php"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Ville</a>
                    </li>
                    <li>
                        <a href="table-data.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Pays</a>
                    </li>

                    <li>
                        <a href="table-data.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Trajet</a>
                    </li>

                    <li>
                        <a href="table-data.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Utilisateur</a>
                    </li>

                    <li>
                        <a href="table-data.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Véhicules</a>
                    </li>

                    <li>
                        <a href="{{route('commissions.index')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Comission</a>
                    </li>

                    <li>
                        <a href="table-data.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Transaction</a>
                    </li>
                </ul>
            </li>

            {{-- actualité --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:rss" class="menu-icon"></iconify-icon>
                    <span>ACTUALITES</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('actualities.index')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Liste</a>
                    </li>
                    <li>
                        <a href="{{route('actualities.create')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>Ajouter</a>
                    </li>
                    <li>
                        <a href="{{route('typenews.index')}}"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Type actualité</a>
                    </li>
                </ul>
            </li>

              {{-- vehicule --}}
              <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ic:baseline-directions-car" class="menu-icon"></iconify-icon>
                    <span>VEHICULE</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('vehicles.index')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Liste</a>
                    </li>
                    {{-- <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>Ajouter</a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{route('typevehicles.index')}}"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Type vehicule</a>
                    </li> --}}
                </ul>
              </li>

            {{-- document --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ic:baseline-insert-drive-file" class="menu-icon"></iconify-icon>
                    <span>DOCUMENTS</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('users.doc')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Liste</a>
                    </li>
                    {{-- <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>Ajouter</a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{route('typevehicles.index')}}"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Type vehicule</a>
                    </li> --}}
                </ul>
              </li>


              {{-- utilisateur --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>UTILISATEURS</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('users.index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Liste</a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>Nouveau</a>
                    </li>
                    <li>
                        <a href="{{route('users.Role')}}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>Roles & Permission</a>
                    </li>

                </ul>
            </li>



            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Paramètres</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('settings')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Globaux</a>
                    </li>
                    @hasrole('developer')
                    <li>
                        <a href="{{route('setting.city')}}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Gestion des villes</a>
                    </li>
                    @endhasrole
                    <li>
                        <a href="{{route('apis')}}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> API</a>
                    </li>

                </ul>
            </li>

              <li>
                <a href="{{route('profile.edit')}}">
                    <iconify-icon icon="solar:user-linear" class="menu-icon "></iconify-icon>
                    <span>Profil</span>
                </a>
            </li>


            <li>
                <a href="{{ route('logout') }}">
                    <iconify-icon icon="lucide:power" class="menu-icon"></iconify-icon> Déconnexion
                </a>
            </li>
        </ul>
    </div>
</aside>
