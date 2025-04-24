@extends('back.layouts.master')
@section('title', 'Liste des réservations ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">Liste des Réservations</h5>

            <div class="col-md-4">
                <input type="text" name="numero_ride" id="numero_ride" value="{{ request('numero_ride') }}" class="form-control"
                       placeholder="Rechercher par numéro de trajet">
            </div>

            <div class="col-md-4">
                <select name="status" id="status" class="form-select">
                    <option value="">-- Filtrer par statut --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Acceptée</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejetée</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Remboursée</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm" id="table-responsive">
                @include('back.pages.reservations.table',['bookings'=>$bookings])
            </div>
        </div>
        <!-- / Content -->
    </div>


    <script>

        $(document).ready(function() {
            // Fonction pour mettre à jour les données filtrées
            function updateTransactions(page = 1) {
                // Récupérer les valeurs des filtres
                var numero = $('#numero_ride').val();
                var status = $('#status').val();



                // Créer l'URL avec les paramètres de filtre et de pagination
                var url = '/reservation/filter' + '?page=' + page + '&numero_ride=' + numero  + '&status=' + status ;

                // Envoi des données via AJAX pour récupérer les transactions filtrées
                $.ajax({
                    url: url,  // URL avec les paramètres de filtre et de pagination
                    method: 'GET',
                    success: function(response) {
                        // Remplacer le contenu de la table avec les résultats filtrés
                        $('#table-responsive').html(response);
                    },
                    error: function(error) {
                        alert('Une erreur est survenue');
                    }
                });
            }

            $('#numero_ride').on('keyup', function () {
                updateTransactions();
            });

            // Écouteur d'événements pour la modification des filtres (changement dans le champ date ou statut)
            $('#status').on('change', function() {
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
