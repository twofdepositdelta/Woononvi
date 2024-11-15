@extends('back.layouts.master')
@section('title', 'Statistique des reservations ')
@section('content')
    <!-- Crypto Home Widgets Start -->
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:calendar-check" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Réservations</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $bookingcount }}</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-1">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div
                            class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:calendar-check" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale </h6>
                            <p class="fw-medium text-secondary-light mb-0">Réservation en attente

                            </p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8"> {{ $bookingcountpending }}</h6>
                            <span class="text-danger-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-5">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:calendar-check" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Réservations remboursées</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8"> {{ $bookingcountrefunded }}</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Crypto Home Widgets End -->

    <div class="row gy-4 mt-4">

        <!-- Crypto Home Widgets Start -->
        <div class="col-xxl-8">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Réservations</h6>



                                <select id="periodSelect"
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                    <option value="yearly">Annuel</option>
                                    <option value="monthly">Mensuel</option>
                                    <option value="weekly">Hebdomadaire</option>
                                    <option value="today">Aujourd'hui</option>
                                </select>
                            </div>



                            <div id="commission-summary" class="d-flex align-items-center gap-2">
                                <h6 class="fw-semibold mb-0" id="total-booking">O </h6>
                                <p class="text-sm mb-0 d-flex align-items-center gap-1">
                                    Total des reservations
                                </p>
                            </div>

                            <canvas id="bookingsChart"></canvas>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Crypto Home Widgets End -->

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let bookingsChart; // Variable pour stocker le graphique

            // Fonction pour initialiser ou réinitialiser le graphique
            function initBookingsChart(data) {
                // Si un graphique existe déjà, détruis-le avant de le recréer
                if (bookingsChart) {
                    bookingsChart.destroy(); // Détruit l'ancien graphique
                }

                // Crée un nouveau graphique
                const ctx = document.getElementById('bookingsChart').getContext('2d');
                bookingsChart = new Chart(ctx, {
                    type: 'bar', // Type de graphique (ici un graphique à barres)
                    data: {
                        labels: data.labels, // Labels dynamiques (mois, année, semaine, jour)
                        datasets: [{
                            label: 'Réservations',
                            data: data.amounts, // Montants des réservations pour chaque période
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur de fond des barres
                            borderColor: 'rgba(54, 162, 235, 1)', // Couleur des bordures des barres
                            borderWidth: 1 // Largeur des bordures
                        }]
                    },
                    options: {
                        responsive: true, // Le graphique est responsive (s'adapte à la taille de l'écran)
                        scales: {
                            y: {
                                beginAtZero: true // Assure que l'axe Y commence à 0
                            }
                        }
                    }
                });
            }

            // Appel AJAX pour récupérer les données et mettre à jour le graphique
            document.getElementById('periodSelect').addEventListener('change', function() {
                const period = this.value; // Récupère la période choisie (jour, semaine, mois, année)

                // Effectue une requête vers l'API pour obtenir les données en fonction de la période sélectionnée
                fetch(`/bookings-report?period=${period}`)
                    .then(response => response.json()) // Parse la réponse JSON
                    .then(data => {
                        initBookingsChart(
                        data); // Initialise ou met à jour le graphique avec les nouvelles données
                        document.getElementById('total-booking').innerText = `${data.total}`;

                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des données :', error);
                    });
            });

        });
    </script>



@endsection
