@extends('back.layouts.master')
@section('title', 'Liste des trajets ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">@yield('title')</h5>

            <div class="col-md-4">
                <input type="text" name="numero" id="numero" value="{{ request('numero') }}" class="form-control"
                       placeholder="Rechercher par numéro de trajet">
            </div>

            <div class="col-md-4">
                <select name="status_ride" id="status_ride" class="form-select">
                    <option value="">-- Filtrer par statut --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                    <option value="suspend" {{ request('status') == 'suspend' ? 'selected' : '' }}>Suspendu</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm" id="table-respons">
                @include('back.pages.trajets.table',['rides'=>$rides])
            </div>
        </div>
        <!-- / Content -->
    </div>
    </div>


    <script>

        $(document).ready(function() {
            // Fonction pour mettre à jour les données filtrées
            function updateTransactions(page = 1) {
                // Récupérer les valeurs des filtres
                var numero = $('#numero').val();
                var status = $('#status_ride').val();

                // Créer l'URL avec les paramètres de filtre et de pagination
                var url = '/trajet/filter' + '?page=' + page + '&numero=' + numero  + '&status_ride=' + status ;

                // Envoi des données via AJAX pour récupérer les transactions filtrées
                $.ajax({
                    url: url,  // URL avec les paramètres de filtre et de pagination
                    method: 'GET',
                    success: function(response) {
                        // Remplacer le contenu de la table avec les résultats filtrés
                        $('#table-respons').html(response);
                    },
                    error: function(error) {
                        alert('Une erreur est survenue');
                    }
                });
            }

            $('#numero').on('keyup', function () {
                updateTransactions();
            });

            // Écouteur d'événements pour la modification des filtres (changement dans le champ date ou statut)
            $('#status_ride').on('change', function() {
                // Mettre à jour les transactions lors du changement de filtre
                updateTransactions();
            });

            // Écouteur d'événements pour les liens de pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();  // Empêcher l'action par défaut du lien

                // Récupérer la page de la pagination
                var page = $(this).attr('href').split('page=')[1];

                // Mettre à jour les transactions pour la page suivante avec les paramètres actuels
                updateTransactions(page);
            });

            // Charger les transactions lors du chargement initial (si des filtres sont déjà appliqués)
            updateTransactions();
        });


    </script>

@endsection
