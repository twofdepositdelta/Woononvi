@extends('back.layouts.master')
@section('title', 'Paramétres de ville ')
@section('content')
    <div class="row gy-2 mb-4">
        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-body p-24">
                    <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-edit-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab"
                                aria-controls="pills-edit-profile" aria-selected="true">
                                 Paramétre Pays
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab"
                                aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                Configuration Ville
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show" id="pills-edit-profile" role="tabpanel"
                            aria-labelledby="pills-edit-profile-tab" tabindex="0">

                            <table class="table bordered-table sm-table mb-0" id="pays-table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="d-flex align-items-center gap-10">
                                                #
                                            </div>
                                        </th>
                                        {{-- <th scope="col">Join Date</th> --}}
                                        <th scope="col">Nom du pays</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Indicatif</th>

                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $index => $country)
                                        <tr>

                                            <td>
                                                <div class="d-flex align-items-center gap-10">
                                                    {{-- <div class="form-check style-check d-flex align-items-center">
                                                  <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                              </div> --}}
                                                    {{ $index + 1 }}
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="{{ $country->icon }}"></i>
                                                    <div class="flex-grow-1">
                                                        <span
                                                            class="text-md mb-0 fw-normal text-secondary-light">{{ $country->name }}</span>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>{{$country->code}}</td>

                                            <td>{{$country->indicatif}}</td>


                                            <td class="text-center">
                                                <a href="javascript:void(0)"
                                                    onclick="openConfirmationModal('{{ route('country.updatestatus', $country) }}', {{ $country->is_active }}, '{{ $country->name }}')"
                                                    class="bg-{{ $country->is_active ? 'success' : 'neutral' }}-focus text-{{ $country->is_active ? 'success' : 'neutral' }}-600 border border-{{ $country->is_active ? 'success' : 'neutral' }}-main px-24 py-4 radius-4 fw-medium text-sm">
                                                    {{ $country->is_active ? 'Activé' : 'Désactivé' }}
                                                </a>
                                            </td>


                                        </tr>


                                        @endforeach

                                    </tbody>
                            </table>

                                <!-- Modal Bootstrap -->
                                <div class="modal fade" id="confirmationModal" tabindex="-1"
                                    aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content radius-8 shadow-lg border-0">
                                            <div class="modal-header bg-warning-600 text-white">
                                                <h5 class="modal-title text-white " id="confirmationModalLabel">
                                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                    Confirmation de changement
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center py-4 ">
                                                <i class="bi bi-question-circle text-warning display-4 mb-3"></i>
                                                <p id="modalMessage" class="fs-5 text-secondary text-justify"></p>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-secondary "
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <a id="confirmAction" class="btn btn-warning ">Confirmer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            {{-- pagination --}}

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                                <span>Affichage  {{ $countries->firstItem() }} de {{ $countries->lastItem() }} a
                                    {{ $countries->total() }} entrées</span>
                                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                    {{-- Previous Page Link --}}
                                    @if ($countries->onFirstPage())
                                        <li class="page-item disabled">
                                            <span
                                                class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                                href="{{ $countries->previousPageUrl() }}">
                                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($countries->links()->elements as $element)
                                        {{-- "Three Dots" Separator --}}
                                        @if (is_string($element))
                                            <li class="page-item disabled"><span
                                                    class="page-link">{{ $element }}</span></li>
                                        @endif

                                        {{-- Array Of Links --}}
                                        @if (is_array($element))
                                            @foreach ($element as $page => $url)
                                                @if ($page == $countries->currentPage())
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
                                    @if ($countries->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                                href="{{ $countries->nextPageUrl() }}">
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

                        <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                            <!-- Filtre de pays -->
                            <div class="mb-3 col-4">
                                <label for="countrySelect" class="form-label">Filtrer par pays</label>
                                <select id="countrySelect" class="form-select">
                                    <option value="">Tous les pays</option>
                                    @foreach ($countryactives as $countryactive)
                                        <option value="{{ $countryactive->id }}" {{ $countryactive->code == 'BJ' ? 'selected' : '' }}>
                                            {{ $countryactive->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                             @include('back.pages.settings.city_table',['cities' => $cities])


                             <!-- Modal Bootstrap -->
                                    <div class="modal fade" id="confirmationModalcity" tabindex="-1"
                                    aria-labelledby="confirmationModalLabelcity" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content radius-8 shadow-lg border-0">
                                            <div class="modal-header bg-warning-600 text-white">
                                                <h5 class="modal-title text-white " id="confirmationModalLabelcity">
                                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                    Confirmation de changement
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center py-4 ">
                                                <i class="bi bi-question-circle text-warning display-4 mb-3"></i>
                                                <p id="modalMessagecity" class="fs-5 text-secondary text-justify"></p>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-secondary "
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <a id="confirmActioncity" class="btn btn-warning ">Confirmer</a>
                                            </div>
                                        </div>
                                    </div>

                              {{-- pagination --}}
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                                    <span>Showing {{ $cities->firstItem() }} to {{ $cities->lastItem() }} of
                                        {{ $cities->total() }} entrées</span>
                                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                        {{-- Previous Page Link --}}
                                        @if ($cities->onFirstPage())
                                            <li class="page-item disabled">
                                                <span
                                                    class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                                    href="{{ $cities->previousPageUrl() }}">
                                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($cities->links()->elements as $element)
                                            {{-- "Three Dots" Separator --}}
                                            @if (is_string($element))
                                                <li class="page-item disabled"><span
                                                        class="page-link">{{ $element }}</span></li>
                                            @endif

                                            {{-- Array Of Links --}}
                                            @if (is_array($element))
                                                @foreach ($element as $page => $url)
                                                    @if ($page == $cities->currentPage())
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
                                        @if ($cities->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                                    href="{{ $cities->nextPageUrl() }}">
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
                </div>
            </div>
        </div>
    </div>



    {{-- message country --}}
        <script>
            function openConfirmationModal(actionUrl, is_active, countryName) {
                let modalMessage = '';

                // Ajuster le message en fonction du statut (activation/désactivation) et inclure le nom du pays
                if (is_active) {
                    modalMessage =
                        `Attention! Vous êtes sur le point d'interrompre Wononvi dans le pays ${countryName}. Cela impliquera la cessation de toute activité  dans ce pays. Voulez-vous vraiment continuez?`;
                } else {
                    modalMessage =
                        `Vous êtes sur le point de lancer officiellement   Wononvi dans le pays ${countryName}. Voulez-vous vraiment continuez ?`;
                }

                // Mettre à jour le texte du message dans le modal
                document.getElementById('modalMessage').innerText = modalMessage;

                // Mettre à jour le lien d'action
                document.getElementById('confirmAction').setAttribute('href', actionUrl);

                // Ouvrir le modal
                var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'), {
                    keyboard: false
                });
                myModal.show();
            }
        </script>
    {{-- message end --}}

      {{-- message city --}}
        <script>
        function openConfirmationModalcity(actionUrlcity, status, cityName) {
            let modalMessage = '';

            // Ajuster le message en fonction du statut (activation/désactivation) et inclure le nom du pays
            if (status) {
                modalMessage =
                    `Attention! Vous êtes sur le point d'interrompre Wononvi dans le pays ${cityName}. Cela impliquera la cessation de toute activité  dans ce pays. Voulez-vous vraiment continuez?`;
            } else {
                modalMessage =
                    `Vous êtes sur le point de lancer officiellement   Wononvi dans le pays ${cityName}. Voulez-vous vraiment continuez ?`;
            }

            // Mettre à jour le texte du message dans le modal
            document.getElementById('modalMessagecity').innerText = modalMessage;

            // Mettre à jour le lien d'action
            document.getElementById('confirmActioncity').setAttribute('href', actionUrlcity);

            // Ouvrir le modal
            var myModal = new bootstrap.Modal(document.getElementById('confirmationModalcity'), {
                keyboard: false
            });
            myModal.show();
        }
        </script>
      {{-- message end --}}

    {{-- activation onglet --}}
        <script>
            // Vérifie si un onglet a été mémorisé dans le stockage local
            document.addEventListener("DOMContentLoaded", function() {
                // Récupère l'onglet actif à partir du stockage local ou définit un onglet par défaut
                const activeTab = localStorage.getItem('activeTab') || 'pills-edit-profile-tab';

                // Supprime l'état actif de tous les onglets
                document.querySelectorAll('.nav-link').forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-selected', 'false');
                });

                // Supprime l'affichage de tous les contenus d'onglets
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });

                // Affiche l'onglet actif
                const tab = document.getElementById(activeTab);
                if (tab) {
                    tab.classList.add('active');
                    tab.setAttribute('aria-selected', 'true');

                    // Affiche le contenu de l'onglet actif
                    const target = tab.getAttribute('data-bs-target');
                    document.querySelector(target).classList.add('show', 'active');
                }

                // Ajoute un écouteur d'événements pour chaque bouton d'onglet
                document.querySelectorAll('.nav-link').forEach(button => {
                    button.addEventListener('click', function() {
                        // Supprime l'état actif de tous les onglets
                        document.querySelectorAll('.nav-link').forEach(btn => {
                            btn.classList.remove('active');
                            btn.setAttribute('aria-selected', 'false');
                        });

                        // Supprime l'affichage de tous les contenus d'onglets
                        document.querySelectorAll('.tab-pane').forEach(pane => {
                            pane.classList.remove('show', 'active');
                        });

                        // Définit l'onglet actif
                        this.classList.add('active');
                        this.setAttribute('aria-selected', 'true');

                        // Affiche le contenu de l'onglet
                        const target = this.getAttribute('data-bs-target');
                        document.querySelector(target).classList.add('show', 'active');

                        // Enregistre l'onglet actif dans le stockage local
                        localStorage.setItem('activeTab', this.id);
                    });
                });
            });
        </script>
    {{-- activation onglet --}}



@endsection
