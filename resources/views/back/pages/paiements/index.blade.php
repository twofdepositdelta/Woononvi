@extends('back.layouts.master')
@section('title', 'Liste des Paiements ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">Liste des Paiements</h5>
            <div class="col-4">
                <select name="type_payment_filter" id="type_payment_filter" class="form-select form-select-sm">
                    <option value="">Tout</option>
                    @foreach ($typepayments as $typepayment)
                        <option value="{{ $typepayment->id }}">
                            {{ $typepayment->label_fr  }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm" id="typ">
              @include('back.pages.paiements.table', ['payments' => $payments])

            </div>
        </div>
        <!-- / Content -->
    </div>

    <script>
        $(document).ready(function() {
            // Fonction pour mettre à jour les données filtrées
            function updateTransactions(page = 1) {
                // Récupérer les valeurs des filtres
                var typeId = $('#type_payment_filter').val();

                // Créer l'URL avec les paramètres de filtre et de pagination
                var url = '/pa/filter/' + '?page=' + page + '&typeId=' + typeId ;

                // Envoi des données via AJAX pour récupérer les transactions filtrées
                $.ajax({
                    url: url,  // URL avec les paramètres de filtre et de pagination
                    method: 'GET',
                    success: function(response) {
                        // Remplacer le contenu de la table avec les résultats filtrés
                        $('#typ').html(response);
                    },
                    error: function(error) {
                        alert('Une erreur est survenue');
                    }
                });
            }


            // Écouteur d'événements pour la modification des filtres (changement dans le champ date ou statut)
            $('#type_payment_filter').on('change', function() {
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

    

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
         const typePaymentFilter = document.getElementById('type_payment_filter');

         typePaymentFilter.addEventListener('change', function () {
             const typeId = this.value;

             fetch(`{{ route("payments.filterByType") }}?type_id=${typeId}`, {
                 method: 'GET',
             })
             .then(response => {
                 if (!response.ok) {
                     throw new Error('Erreur de requête');
                 }
                 return response.text();
             })
             .then(html => {
                 document.querySelector('table').innerHTML = html;
             })
             .catch(error => {
                 console.error('Erreur:', error);
             });
         });
       });

    </script> --}}

@endsection
