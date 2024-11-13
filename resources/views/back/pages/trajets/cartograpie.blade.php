@extends('back.layouts.master')
@section('title', 'Vue d\'ensemble des trajets')

@section('customCSS')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #myMap {
        height: 100vh;
        width: 100%;
    }
</style>
@endsection

@section('content')
    <!-- Inclure l'API Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBteeTZAzfzhLkWeucdSI--ReIT_GLpmQ&callback=initMap&libraries=places" async defer></script>

    <!-- Div pour la carte -->
    <div id="myMap"></div>
@endsection

@section('customJS')
<script>
    // Initialisation de la carte
    let map;

    async function initMap() {
        // Créer la carte avec un centre par défaut
        map = new google.maps.Map(document.getElementById("myMap"), {
            zoom: 13,
            center: { lat: 40.749933, lng: -73.98633 }  // Coordonnées par défaut
        });

        try {
            // Appeler l'API pour obtenir les trajets actifs
            const response = await fetch('/api/active-rides'); // Remplacer par votre endpoint API
            if (!response.ok) {
                throw new Error('Erreur lors du chargement des trajets actifs');
            }
            const data = await response.json();
            displayRides(data.rides);
        } catch (error) {
            console.error('Erreur lors du chargement des trajets actifs:', error);
        }
    }

    // Affichage des trajets sur la carte
    function displayRides(rides) {
        rides.forEach(ride => {
            const position = new google.maps.LatLng(ride.latitude, ride.longitude);
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: `Trajet ID: ${ride.id} - Conducteur ID: ${ride.driver_id}`
            });
        });
    }
</script>
@endsection
