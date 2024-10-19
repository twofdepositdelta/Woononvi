@extends('back.layouts.master')
@section('title', 'Liste des utilisateurs')
@section('content')

<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-2" style="margin-bottom: 15px !important">Liste des utilisateurs</h5>
        <div class="d-flex align-items-center">
            <!-- Filtre par rôle -->
            <label for="role" class="me-2">Rôle:</label>
            <select name="role" id="role" class="form-select me-3">
                <option value="">Tous les rôles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">
                        {{ \Spatie\Permission\Models\Role::where('name', $role->name)->first()->role
                        }}
                    </option>
                @endforeach
            </select>

            <!-- Filtre par statut -->
            <label for="status" class="me-2">Statut:</label>
            <select name="status" id="status" class="form-select">
                <option value="">Tous les statuts</option>
                <option value="1">Actif</option>
                <option value="0">Inactif</option>
            </select>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">S.L</label>
                            </div>
                        </th>
                        <th scope="col">Nom Complet</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Status</th>
                        <th scope="col">Depuis le</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('back.pages.users.table')
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('customJS')
<script>
    $(document).ready(function() {
        $('#role, #status').on('change', function() {
            var role = $('#role').val();
            var status = $('#status').val();

            // Vérifiez si au moins un des filtres a une valeur
            if (role || status !== '') {
                $.ajax({
                    url: '{{ route('users.filter') }}',
                    method: 'GET',
                    data: {
                        role: role,
                        status: status
                    },
                    success: function(response) {
                        // alert('good');
                        // Mettre à jour le tableau avec les résultats filtrés
                        $('#dataTable tbody').html(response.html);
                    },
                    error: function(xhr) {
                        // alert('bad');
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Si aucun filtre n'est sélectionné, charger tous les utilisateurs
                location.reload(); // Cela rafraîchit la page pour charger tous les utilisateurs
            }
        });

        // Charger les utilisateurs par défaut
        // Supprimez la ligne ci-dessous si vous ne souhaitez pas effectuer de filtre au chargement
        // $('#role').trigger('change');
    });
</script>

@endsection
