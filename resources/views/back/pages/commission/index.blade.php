@extends('back.layouts.master')
@section('title', 'Statistique des commissions ')
@section('content')

    <!-- Crypto Home Widgets Start -->
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <img src="assets/images/currency/crypto-img1.png" alt=""
                            class="w-40-px h-40-px rounded-circle flex-shrink-0">
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
                        <div id="bitcoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-none border bg-gradient-end-1">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <img src="assets/images/currency/crypto-img2.png" alt=""
                            class="w-40-px h-40-px rounded-circle flex-shrink-0">
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
                        <div id="ethereumAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
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
                            <h6 class="mb-8">{{ $totalactifcomiss }} Fcfa</h6>
                            <span class="text-success-main text-md"></span>
                        </div>
                        <div id="solanaAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
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


                                <select id="commission-period"
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                    <option value="yearly">Annuel</option>
                                    <option value="monthly">Mensuel</option>
                                    <option value="weekly">Hebdomadaire</option>
                                    <option value="today">Aujourd'hui</option>
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
                {{-- <div class="col-xxl-6">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg">Coin Analytics</h6>
                                <div
                                    class="border radius-4 px-3 py-2 pe-0 d-flex align-items-center gap-1 text-sm text-secondary-light">
                                    Currency:
                                    <select
                                        class="form-select form-select-sm w-auto bg-base border-0 text-primary-light fw-semibold text-sm">
                                        <option>USD</option>
                                        <option>BDT</option>
                                        <option>RUP</option>
                                    </select>
                                </div>
                            </div>

                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <img src="assets/images/currency/crypto-img1.png" alt=""
                                        class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0">Bitcoin</h6>
                                    </div>
                                </div>
                                <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                <span class="text-success-main text-md fw-medium">+3.85%</span>
                                <div id="markerBitcoinChart" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>

                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <img src="assets/images/currency/crypto-img2.png" alt=""
                                        class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0">Ethereum</h6>
                                    </div>
                                </div>
                                <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                <div id="markerEthereumChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>

                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <img src="assets/images/currency/crypto-img3.png" alt=""
                                        class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0">Solana</h6>
                                    </div>
                                </div>
                                <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                <span class="text-success-main text-md fw-medium">+3.85%</span>
                                <div id="markerSolanaChart" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>

                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <img src="assets/images/currency/crypto-img4.png" alt=""
                                        class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0">Litecoin</h6>
                                    </div>
                                </div>
                                <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                <span class="text-success-main text-md fw-medium">+3.85%</span>
                                <div id="markerLitecoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>

                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <img src="assets/images/currency/crypto-img5.png" alt=""
                                        class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0">Dogecoin</h6>
                                    </div>
                                </div>
                                <h6 class="text-md fw-medium mb-0">$15,000.00</h6>
                                <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                <div id="markerDogecoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>

                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-4 radius-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <img src="assets/images/currency/crypto-img1.png" alt=""
                                        class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0">Crypto</h6>
                                    </div>
                                </div>
                                <h6 class="text-md fw-medium mb-0">$15,000.00</h6>
                                <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                <div id="markerCryptoChart" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-6">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg">My Orders</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Today</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Amount ETH </th>
                                            <th scope="col">Price PLN</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td><span class="text-success-main">0.265415.00</span></td>
                                            <td>29.4251512</td>
                                            <td>2.154</td>
                                            <td class="text-center line-height-1">
                                                <button type="button"
                                                    class="text-lg text-danger-main remove-btn"><iconify-icon
                                                        icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-success-main">0.265415.00</span></td>
                                            <td>29.4251512</td>
                                            <td>2.154</td>
                                            <td class="text-center line-height-1">
                                                <button type="button"
                                                    class="text-lg text-danger-main remove-btn"><iconify-icon
                                                        icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-danger-main">0.265415.00</span></td>
                                            <td>29.4251512</td>
                                            <td>2.154</td>
                                            <td class="text-center line-height-1">
                                                <button type="button"
                                                    class="text-lg text-danger-main remove-btn"><iconify-icon
                                                        icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-success-main">0.265415.00</span></td>
                                            <td>29.4251512</td>
                                            <td>2.154</td>
                                            <td class="text-center line-height-1">
                                                <button type="button"
                                                    class="text-lg text-danger-main remove-btn"><iconify-icon
                                                        icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-danger-main">0.265415.00</span></td>
                                            <td>29.4251512</td>
                                            <td>2.154</td>
                                            <td class="text-center line-height-1">
                                                <button type="button"
                                                    class="text-lg text-danger-main remove-btn"><iconify-icon
                                                        icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-danger-main">0.265415.00</span></td>
                                            <td>29.4251512</td>
                                            <td>2.154</td>
                                            <td class="text-center line-height-1">
                                                <button type="button"
                                                    class="text-lg text-danger-main remove-btn"><iconify-icon
                                                        icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Recent Transaction</h6>
                                <a href="javascript:void(0)"
                                    class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                </a>
                            </div>
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0 xsm-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ast</th>
                                            <th scope="col">Date & Time</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Address</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                        <iconify-icon icon="tabler:arrow-up-right"
                                                            class="icon"></iconify-icon>
                                                    </span>
                                                    <span class="fw-medium">Bitcoin</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">10:34
                                                    AM</span>
                                                <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">+ 0.431
                                                    BTC</span>
                                                <span class="text-secondary-light text-sm">$3,480.90</span>
                                            </td>
                                            <td>Abc.........np562</td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class="text-danger-main bg-danger-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                        <iconify-icon icon="tabler:arrow-down-left"
                                                            class="icon"></iconify-icon>
                                                    </span>
                                                    <span class="fw-medium">Bitcoin</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">10:34
                                                    AM</span>
                                                <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">+ 0.431
                                                    BTC</span>
                                                <span class="text-secondary-light text-sm">$3,480.90</span>
                                            </td>
                                            <td>Abc.........np562</td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-danger-focus text-danger-main px-16 py-4 radius-4 fw-medium text-sm">Terminated</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                        <iconify-icon icon="tabler:arrow-up-right"
                                                            class="icon"></iconify-icon>
                                                    </span>
                                                    <span class="fw-medium">Bitcoin</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">10:34
                                                    AM</span>
                                                <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">+ 0.431
                                                    BTC</span>
                                                <span class="text-secondary-light text-sm">$3,480.90</span>
                                            </td>
                                            <td>Abc.........np562</td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class="text-danger-main bg-danger-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                        <iconify-icon icon="tabler:arrow-down-left"
                                                            class="icon"></iconify-icon>
                                                    </span>
                                                    <span class="fw-medium">Bitcoin</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">10:34
                                                    AM</span>
                                                <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">+ 0.431
                                                    BTC</span>
                                                <span class="text-secondary-light text-sm">$3,480.90</span>
                                            </td>
                                            <td>Abc.........np562</td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-danger-focus text-danger-main px-16 py-4 radius-4 fw-medium text-sm">Terminated</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                        <iconify-icon icon="tabler:arrow-up-right"
                                                            class="icon"></iconify-icon>
                                                    </span>
                                                    <span class="fw-medium">Bitcoin</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">10:34
                                                    AM</span>
                                                <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                            </td>
                                            <td>
                                                <span class="text-primary-light d-block fw-medium">+ 0.431
                                                    BTC</span>
                                                <span class="text-secondary-light text-sm">$3,480.90</span>
                                            </td>
                                            <td>Abc.........np562</td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- Crypto Home Widgets End -->

       
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('commission-period').addEventListener('change', function() {
                const period = this.value;

                // Envoie une requête AJAX pour obtenir les données des commissions
                fetch(`/commissions/report?period=${period}`)
                    .then(response => response.json())
                    .then(data => {
                        // Met à jour le total des commissions affiché
                        document.getElementById('total-commission').innerText = `${data.total} Fcfa`;

                        // Met à jour les données du graphique
                        commissionChart.data.labels = data.labels;
                        commissionChart.data.datasets[0].data = data.amounts;
                        commissionChart.update();
                    });
            });



            // Initialise le graphique
            const ctx = document.getElementById('commissionChart').getContext('2d');
            const commissionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [], // Labels dynamiques en fonction de la période sélectionnée
                    datasets: [{
                        label: 'Commissions',
                        data: [],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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

            // Écouteur pour mettre à jour les labels et les données en fonction de la période
            document.getElementById('commission-period').addEventListener('change', function() {
                const period = this.value;

                if (period === 'monthly') {
                    // Labels pour les mois
                    commissionChart.data.labels = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                        "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
                    ];

                    // Requête pour les données mensuelles
                    fetch(`/commissions/report?period=monthly`)
                        .then(response => response.json())
                        .then(data => {
                            commissionChart.data.datasets[0].data = data
                            .amounts; // Montants des commissions par mois
                            commissionChart.update();
                        });
                } else {
                    // Labels et données par défaut pour les autres périodes (annuel, hebdomadaire, aujourd'hui)
                    commissionChart.data.labels = []; // Par exemple, ici les noms des jours ou des années
                    fetch(`/commissions/report?period=${period}`)
                        .then(response => response.json())
                        .then(data => {
                            commissionChart.data.datasets[0].data = data.amounts;
                            commissionChart.update();
                        });
                }
            });

        });
    </script>

@endsection
