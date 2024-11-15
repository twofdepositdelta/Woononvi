@extends('back.layouts.master')
@section('title', 'Statistique des reservations ')
@section('content')
    <!-- Crypto Home Widgets Start -->
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
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

                        <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
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
                        <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:calendar-check" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-xl mb-1">Totale</h6>
                            <p class="fw-medium text-secondary-light mb-0">Réservations remboursées</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                        <div class="">
                            <h6 class="mb-8"> {{ $bookingcountrefunded}}</h6>
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
                                <h6 class="mb-2 fw-bold text-lg">Comissions</h6>


                                <select id="periodSelect"
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                    <option value="yearly">Annuel</option>
                                    <option value="monthly">Mensuel</option>
                                    <option value="weekly">Hebdomadaire</option>
                                    <option value="today">Aujourd'hui</option>
                                </select>
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
       document.getElementById('periodSelect').addEventListener('change', function() {
    const period = this.value;
    fetch(`/api/bookings-report?period=${period}`)  // Appel API avec la période sélectionnée
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('bookingsChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',  // Le type de graphique
                data: {
                    labels: data.labels,  // Les labels (mois, années ou semaines)
                    datasets: [{
                        label: 'Nombre de Réservations',
                        data: data.amounts,  // Les valeurs de réservation
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        });
});

    </script>



@endsection
