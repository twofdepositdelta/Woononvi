@extends('back.layouts.master')
@section('title', 'Statistique des trajets ')
@section('content')

    <!-- Crypto Home Widgets Start -->
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:route" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
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

                        <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:route" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale </h6>
                            <p class="fw-medium text-secondary-light mb-0">Trajets actifs actuellemnt

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

        {{-- <div class="col">
            <div class="card shadow-none border bg-gradient-end-5">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <img src="assets/images/currency/crypto-img3.png" alt=""
                            class="w-40-px h-40-px rounded-circle flex-shrink-0">
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Comissions generée</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8"> Fcfa</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                        <div id="solanaAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                </div>
            </div>
        </div> --}}


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
                                <h6 class="mb-2 fw-bold text-lg">Trajet</h6>
                            </div>


                            <canvas id="ridesChart" width="400" height="200"></canvas>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Crypto Home Widgets End -->


    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var rideData = @json($rides); // Les données des trajets récupérées en PHP
            var labels = [];
            var data = [];

            rideData.forEach(function(ride) {
                labels.push(ride.departure + ' -> ' + ride.destination);
                data.push(ride.count);
            });

            var ctx = document.getElementById('ridesChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar', // Type de graphique : barre
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nombre de trajets',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + ' trajets';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>


@endsection
