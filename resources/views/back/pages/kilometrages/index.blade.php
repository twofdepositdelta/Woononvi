@extends('back.layouts.master')
@section('title', 'Liste des kilomètrages ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">@yield('title')</h5>

            <div class="col-md-4">
                <select name="categorie" id="categorie" class="form-select">
                    <option value="">-- Filtrer par categorie --</option>
                    @foreach ($categories as $categorie )
                    <option value="{{$categorie->id}}" {{ $categorie->id == 1 ? 'selected' : '' }}>{{ $categorie->label}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4 text-end">
                <a href="{{ route('kilometrages.create') }}" class="btn btn-info">
                    Ajouter
                </a>
            </div>

        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm" id="table-resp">
                @include('back.pages.kilometrages.table',['kilos'=>$kilos])
            </div>
        </div>
        <!-- / Content -->
    </div>


    <script>
        $(document).ready(function() {
            // Fonction pour mettre à jour les données filtrées
            function updateTransactions(page = 1) {
                // Récupérer les valeurs des filtres
                var categorie = $('#categorie').val();

                // Créer l'URL avec les paramètres de filtre et de pagination
                var url = '/kilo/filter' + '?page=' + page + '&categorie=' + categorie ;

                // Envoi des données via AJAX pour récupérer les transactions filtrées
                $.ajax({
                    url: url,  // URL avec les paramètres de filtre et de pagination
                    method: 'GET',
                    success: function(response) {
                        // Remplacer le contenu de la table avec les résultats filtrés
                        $('#table-resp').html(response);
                    },
                    error: function(error) {
                        alert('Une erreur est survenue');
                    }
                });
            }


            // Écouteur d'événements pour la modification des filtres (changement dans le champ date ou statut)
            $('#categorie').on('change', function() {
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
