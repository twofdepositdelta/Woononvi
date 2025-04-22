@extends('back.layouts.master')
@section('title', 'Paramétres ')
@section('content')

    <!-- Content -->
    <div class="row gy-4">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulaire de Paramètres de l'Entreprise</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row gy-3">
                            @foreach ($settings as $setting)
                                <div class="col-12 d-flex">
                                    <label class="form-label col-3" for="{{ $setting->key }}">
                                        {{ __('settings.' . $setting->key) }}
                                        @if ($setting->description)
                                            <span class="text-secondary " style="font-style: italic;">
                                                {{ $setting->description }}
                                            </span>
                                        @endif
                                    </label>

                                    @if ($setting->key == 'company_logo')
                                        <input type="file" class="form-control" id="{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]">
                                    @else
                                        <input type="text" class="form-control" id="{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.' . $setting->key, $setting->value) }}">
                                    @endif

                                </div>
                            @endforeach

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary-600">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card h-100 col-12 col-md-10 offset-1">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kilométrage</h5>
                </div>
                <div class="card-body p-24 ">

                    <div class=" d-flex justify-content-end mb-3">
                        <a href="{{ route('kilometrages.create') }}" class="btn btn-info">
                            Ajouter
                        </a>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-edit-profile" role="tabpanel"
                            aria-labelledby="pills-edit-profile-tab" tabindex="0">

                            <!-- Table responsive pour adapter la taille de la table -->
                            <div class="table-responsive">
                                <table class="table bordered-table sm-table mb-0" style="max-width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Catégorie</th>
                                            <th>Intervalle (km)</th>
                                            <th>Taux (FCFA/km)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($kilos->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-danger text-center">Aucun kilometrage
                                                    enregistré</td>
                                            </tr>
                                        @else
                                            @foreach ($kilos as $index => $kilo)
                                                <tr>
                                                    <td>{{ $kilo->categorie->label ?? 'Non disponible' }}</td>

                                                    <td>{{ $kilo->min_km }} - {{ $kilo->max_km }} km</td>

                                                    <td>{{ $kilo->taux_par_km }} FCFA</td>

                                                    <td class="text-center">

                                                        <div
                                                            class="d-flex align-items-center gap-10 justify-content-center">

                                                            <a href="{{ route('kilometrages.edit', $kilo) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal-{{ $kilo->id }}"
                                                                class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                                <iconify-icon icon="lucide:edit"
                                                                    class="menu-icon"></iconify-icon>
                                                            </a>

                                                            <!-- Delete -->
                                                            <form action="{{ route('kilometrages.destroy', $kilo) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                                    <iconify-icon icon="fluent:delete-24-regular"
                                                                        class="menu-icon"></iconify-icon>
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>


                                                <!-- Modal -->

                                                <div class="modal fade" id="editModal-{{ $kilo->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel-{{ $kilo->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('kilometrages.update', $kilo->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title"
                                                                        id="editModalLabel-{{ $kilo->id }}">Modifier
                                                                        </h6>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Fermer"></button>
                                                                </div>
                                                                <div class="modal-body row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label">Kilomètre minimal</label>
                                                                        <input type="number" name="min_km" min="1"
                                                                            class="form-control"
                                                                            value="{{ old('min_km', $kilo->min_km) }}"
                                                                            required>
                                                                    </div>

                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label">Kilomètre maximal</label>
                                                                        <input type="number" name="max_km" min="1"
                                                                            class="form-control"
                                                                            value="{{ old('max_km', $kilo->max_km) }}"
                                                                            required>
                                                                    </div>

                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">Taux (FCFA)</label>
                                                                        <input type="number" name="taux_par_km"
                                                                            class="form-control"
                                                                            value="{{ old('taux_par_km', $kilo->taux_par_km) }}"
                                                                            required>
                                                                    </div>

                                                                    <input type="hidden" name="categorie_id"
                                                                        value="{{ $kilo->categorie_id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Modifier</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- End of table responsive -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
