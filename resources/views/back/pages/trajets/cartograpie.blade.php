@extends('back.layouts.master')
@section('title', 'Vue d\'ensemble des trajets')

@section('customCSS')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .place-picker-container {
            padding: 20px;
        }
    </style>
@endsection

@section('content')
    <gmpx-api-loader key="AIzaSyCBteeTZAzfzhLkWeucdSI--ReIT_GLpmQ" solution-channel="GMP_GE_mapsandplacesautocomplete_v1"></gmpx-api-loader>

    <!-- Map Component -->
    <gmp-map id="myMap" center="40.749933,-73.98633" zoom="13">
        <div slot="control-block-start-inline-start" class="place-picker-container">
            <gmpx-place-picker placeholder="Entrez une adresse"></gmpx-place-picker>
        </div>
        <gmp-advanced-marker id="rideMarker"></gmp-advanced-marker>
    </gmp-map>
@endsection

@section('customJS')
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>

    <script>
        async function init() {
            await customElements.whenDefined('gmp-map');

            const map = document.querySelector('gmp-map');
            const marker = document.querySelector('gmp-advanced-marker');
            const infowindow = new google.maps.InfoWindow();

            map.innerMap.setOptions({
                mapTypeControl: false
            });

            // Exemple d'appel de la fonction updateRideLocation
            setInterval(() => {
                // Remplacer par des données dynamiques
                updateRideLocation(1, 40.749933, -73.98633, 500);  // Remplacer par des données en temps réel
            }, 5000);  // Actualiser toutes les 5 secondes

            // Méthode pour mettre à jour la position du véhicule en temps réel
            function updateRideLocation(rideId, latitude, longitude, distanceTravelled) {
                fetch(`/ride/${rideId}/update-location`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        latitude: latitude,
                        longitude: longitude,
                        distance_travelled: distanceTravelled
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Mise à jour de la position du marqueur sur la carte
                    const position = new google.maps.LatLng(latitude, longitude);
                    marker.position = position;
                    map.innerMap.panTo(position); // Déplacer la carte vers la nouvelle position
                    infowindow.setContent(`<strong>Trajet ${rideId}</strong><br><span>Distance parcourue: ${distanceTravelled} m</span>`);
                    infowindow.open(map.innerMap, marker);
                })
                .catch(error => console.error('Error:', error));
            }
        }

        document.addEventListener('DOMContentLoaded', init);
    </script>
@endsection
