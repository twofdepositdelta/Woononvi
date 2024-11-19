@extends('back.layouts.master')
@section('title', 'Statistique des commissions ')
@section('content')

    <!-- Crypto Home Widgets Start -->
    {{-- <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-orange rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:coins" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Commissions</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $totalcommission }} FCFA</h6>
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
                            class="w-50-px h-50-px bg-orange rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:coins" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale </h6>
                            <p class="fw-medium text-secondary-light mb-0">Commissions en attente</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $totalpendingcomiss }} Fcfa</h6>
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
                            class="w-50-px h-50-px bg-orange rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:coins" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Comissions generée</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $totalactifcomiss }} Fcfa</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div> --}}
    <!-- Crypto Home Widgets End -->

    <div class="row gy-4 mt-4">

        <!-- Crypto Home Widgets Start -->
        <div class="col-xxl-8">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Comissions</h6>


                                <select id="commission-period"
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                    <option value="yearly">Annuel</option>
                                    <option value="monthly">Mensuel</option>
                                    <option value="weekly"selected>Hebdomadaire</option>

                                </select>
                            </div>

                            <div id="commission-summary" class="d-flex align-items-center gap-2">
                                <h6 class="fw-semibold mb-0" id="total-commission">O Fcfa</h6>
                                <p class="text-sm mb-0 d-flex align-items-center gap-1">
                                    Total Commissions
                                </p>
                            </div>
                            <canvas id="commissionChart"></canvas>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Crypto Home Widgets End -->


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let commissionChart; // Variable pour stocker le graphique

            // Fonction pour initialiser ou réinitialiser le graphique
            function initCommissionChart(data) {
                const ctx = document.getElementById('commissionChart').getContext('2d');

                // Si le graphique existe déjà, on le détruit
                if (commissionChart) {
                    commissionChart.destroy();
                }

                // Création d'un nouveau graphique
                commissionChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels, // Labels dynamiques (mois, années, etc.)
                        datasets: [{
                            label: 'Commissions',
                            data: data.amounts, // Montants des commissions
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true // Assure que l'axe Y commence à 0
                            }
                        }
                    }
                });
            }

            // Fonction pour charger les données en fonction de la période sélectionnée
            function loadCommissionData(period) {
                fetch(`/commissions/report?period=${period}`)
                    .then(response => response.json())
                    .then(data => {
                        // Met à jour le total des commissions
                        document.getElementById('total-commission').innerText = `${data.total} Fcfa`;

                        // Initialise ou met à jour le graphique avec les nouvelles données
                        initCommissionChart(data);
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des données :', error);
                    });
            }

            // Écouteur pour le changement de période
            document.getElementById('commission-period').addEventListener('change', function() {
                const period = this.value; // Récupère la période sélectionnée
                loadCommissionData(period); // Charge les données correspondantes
            });

            // Charge les données mensuelles par défaut au chargement de la page
            loadCommissionData('weekly');
        });
    </script>

@endsection
