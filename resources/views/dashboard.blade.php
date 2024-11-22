@extends('back.layouts.master')
@section('title', 'Tableau de bord')
@section('content')
<div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    @include('back.pages.home.statistics.amount-statistics')
    @include('back.pages.home.statistics.rides-statistics')
    @include('back.pages.home.statistics.users-statistics')
</div>

<div class="row gy-4 mt-1">
    @include('back.pages.home.graphes.rides_booking-graphics')
    @include('back.pages.home.tables.rides_booking-tables')
</div>
@endsection

@section('customJS')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Vérifier si une valeur active existe dans sessionStorage
        const activeTab = sessionStorage.getItem('activeTab');

        // Si une valeur active est trouvée, on active l'onglet correspondant
        if (activeTab) {
            const tab = document.getElementById(activeTab);
            if (tab) {
                // Supprimer la classe active de tous les onglets
                const allTabs = document.querySelectorAll('.nav-link');
                allTabs.forEach(tab => tab.classList.remove('active'));

                // Ajouter la classe active au bon onglet
                tab.classList.add('active');

                // Mettre à jour le contenu actif du tab
                const activeContent = document.querySelector(tab.getAttribute('data-bs-target'));
                if (activeContent) {
                    const allContent = document.querySelectorAll('.tab-pane');
                    allContent.forEach(content => content.classList.remove('show', 'active'));
                    activeContent.classList.add('show', 'active');
                }
            }
        }

        // Ajouter un écouteur d'événements pour chaque onglet
        const tabs = document.querySelectorAll('.nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Sauvegarder l'onglet actif dans sessionStorage
                sessionStorage.setItem('activeTab', tab.id);
            });
        });
    });
</script>

{{-- reservation --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Réservations',
                        data: data.amounts,
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
        }

        // Fonction pour charger les données dynamiquement via AJAX
        function loadBookingsData(period) {
            fetch(`/bookings-report?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    initBookingsChart(data); // Met à jour le graphique
                    document.getElementById('total-booking').innerText = `${data.total}`;
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des données :', error);
                });
        }

        // Charger les données par défaut (weekly) au chargement de la page
        loadBookingsData('weekly');

        // Ajouter un listener pour changer la période
        document.getElementById('periodSelect').addEventListener('change', function () {
            const period = this.value; // Récupère la période choisie
            loadBookingsData(period); // Charge les données pour la période sélectionnée
        });
    });
</script>

{{-- trajet --}}
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
        document.getElementById('periodSelectride').addEventListener('change', function() {
            const period = this.value;
            loadRideData(period);
        });
    });
</script>


@endsection
