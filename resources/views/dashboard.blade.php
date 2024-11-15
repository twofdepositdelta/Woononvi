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

@endsection
