@extends('back.layouts.master')
@section('title', 'Statistique des trajets ')
@section('content')

    <!-- Crypto Home Widgets Start -->
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:route" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Total</h6>
                            <p class="fw-medium text-secondary-light mb-0">Trajets</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $ridecount }}</h6>
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
                            class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:route" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Total </h6>
                            <p class="fw-medium text-secondary-light mb-0">Trajets actifs actuellement

                            </p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8"> {{ $ridecountactive }}</h6>
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
                            class="w-50-px h-50-px bg-danger-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:route" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Total</h6>
                            <p class="fw-medium text-secondary-light mb-0">Trajets suspendus</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8">{{ $ridecountcomplete }}</h6>
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
                                <h6 class="mb-2 fw-bold text-lg">Trajets</h6>



                                <select id="periodSelectrajet"
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                    <option value="yearlyride">Annuel</option>
                                    <option value="monthlyride">Mensuel</option>
                                    <option value="weeklyride" selected>Hebdomadaire</option>
                                    <option value="todayride">Aujourd'hui</option>
                                </select>


                            </div>

                            <div  class="d-flex align-items-center gap-2">
                                <h6 class="fw-semibold mb-0" id="total-ride">O </h6>
                                <p class="text-sm mb-0 d-flex align-items-center gap-1">
                                    Total des trajets
                                </p>
                            </div>

                            <canvas id="rideChart"></canvas>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Crypto Home Widgets End -->


    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rideChart; // Variable pour stocker le graphique

            // Fonction pour initialiser ou réinitialiser le graphique
            function initRidesChart(data) {
                if (rideChart) {
                    rideChart.destroy(); // Détruit l'ancien graphique
                }

                const ctx = document.getElementById('rideChart').getContext('2d');
                rideChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels, // Labels dynamiques (mois, année, semaine, jour)
                        datasets: [{
                            label: 'Trajets',
                            data: data.amounts, // Montants des trajets pour chaque période
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur de fond
                            borderColor: 'rgba(54, 162, 235, 1)', // Couleur des bordures
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Fonction pour charger les données
            function loadRideData(period) {
                fetch(`/ride-report?period=${period}`)
                    .then(response => response.json())
                    .then(data => {
                        initRidesChart(data); // Initialise ou met à jour le graphique
                        document.getElementById('total-ride').innerText = `${data.total}`;
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des données :', error);
                    });
            }

            // Charger les données hebdomadaires par défaut
            loadRideData('weeklyride');

            // Mettre à jour les données lorsque l'utilisateur change la période
            document.getElementById('periodSelectrajet').addEventListener('change', function() {
                const period = this.value;
                loadRideData(period);
            });
        });
    </script>



@endsection
