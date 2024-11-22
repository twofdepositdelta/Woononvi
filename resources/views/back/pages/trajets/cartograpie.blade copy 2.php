@extends('back.layouts.master')
@section('title', 'Vue d\'ensemble des trajets')

@section('customCSS')
<style>
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}

#myMap {
    height: 100vh;
    /* La carte occupe toute la hauteur de la page */
    width: 100%;
}
</style>
@endsection

@section('content')
<!-- Div où la carte sera affichée -->
<div id="myMap"></div>
<div id="errorMessage" style="display:none; color: red; text-align: center; padding: 20px;">
    Aucun trajet actif à afficher.
</div>
@endsection

@section('customJS')
<script>
// Fonction pour ajuster la vue de la carte et inclure tous les trajets
function adjustMapViewToMarkers(map, rides) {
    const bounds = new google.maps.LatLngBounds();

    rides.forEach(ride => {
        if (ride.start_latitude && ride.start_longitude) {
            bounds.extend(new google.maps.LatLng(ride.start_latitude, ride.start_longitude));
        }
        if (ride.end_latitude && ride.end_longitude) {
            bounds.extend(new google.maps.LatLng(ride.end_latitude, ride.end_longitude));
        }
    });

    if (!bounds.isEmpty()) {
        map.fitBounds(bounds);
    } else {
        // Si aucun trajet n'est trouvé, centre la carte sur le Bénin avec un bon zoom
        const centerLatLng = new google.maps.LatLng(9.5, 2.6); // Latitude, Longitude du centre du Bénin
        map.setCenter(centerLatLng);
        map.setZoom(7); // Zoom ajusté pour couvrir la largeur du Bénin
    }
}

// Fonction pour récupérer les trajets actifs
async function fetchActiveRides() {
    try {
        const response = await fetch("/api/active-rides"); // Remplacez par votre endpoint
        const data = await response.json();

        // Vérifie si les données sont correctement structurées
        console.log("Données des trajets récupérées :", data);

        return data.rides.map(ride => ({
            start_latitude: ride.start_latitude,
            start_longitude: ride.start_longitude,
            end_latitude: ride.end_latitude,
            end_longitude: ride.end_longitude,
            numero: ride.numero,
        }));
    } catch (error) {
        console.error("Erreur lors du chargement des trajets actifs:", error);
        return [];
    }
}

// Fonction initMap avec les marqueurs de départ, d'arrivée et le tracé des trajets
window.initMap = async function() {
    const map = new google.maps.Map(document.getElementById("myMap"), {
        center: {
            lat: 9.5,
            lng: 2.6
        }, // Latitude et longitude du centre du Bénin
        zoom: 7, // Zoom pour afficher le Bénin (ajustez si nécessaire)
        restriction: {
            latLngBounds: {
                north: 11.5, // Limite nord du Bénin
                south: 6, // Limite sud du Bénin
                east: 3.5, // Limite est du Bénin
                west: 1, // Limite ouest du Bénin
            },
            strictBounds: false, // Permet à la carte de sortir un peu des limites définies
        },
    });

    // Optionnel: ajouter une ligne de frontières pour illustrer le pays (facultatif)
    const bounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(6, 1), // Point SW
        new google.maps.LatLng(11.5, 3.5) // Point NE
    );

    // Définir la limite géographique sur la carte
    map.fitBounds(bounds);

    // Récupération des trajets actifs via l'API
    const rides = await fetchActiveRides();

    if (rides.length === 0) {
        document.getElementById("errorMessage").style.display = "block";
        return;
    }

    adjustMapViewToMarkers(map, rides);

    // Ajout des marqueurs et tracé des trajets pour chaque trajet
    rides.forEach(ride => {
        const startLatLng = new google.maps.LatLng(ride.start_latitude, ride.start_longitude);
        const endLatLng = new google.maps.LatLng(ride.end_latitude, ride.end_longitude);

        // Marqueur pour le point de départ
        if (ride.start_latitude && ride.start_longitude) {
            const startMarker = new google.maps.Marker({
                position: startLatLng,
                map: map,
                title: `Départ : ${ride.numero}`,
                icon: {
                    url: "{{ asset('taxi-solid.svg') }}", // Icône pour le départ
                    scaledSize: new google.maps.Size(30, 30),
                    anchor: new google.maps.Point(15, 15),
                },
            });

            // Affichage de la distance lorsque le marqueur de départ est survolé
            google.maps.event.addListener(startMarker, "mouseover", function() {
                const distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
                    startLatLng, endLatLng);
                const distanceInKm = (distanceInMeters / 1000).toFixed(
                2); // Convertir en km et formater à 2 décimales

                const infoWindow = new google.maps.InfoWindow({
                    content: `<div><strong>Distance:</strong> ${distanceInKm} km</div>`,
                });

                infoWindow.open(map, startMarker);
            });

            // Fermer l'infobulle lorsque le survol est terminé
            google.maps.event.addListener(startMarker, "mouseout", function() {
                google.maps.InfoWindow.prototype.close();
            });
        }

        // Marqueur pour le point d'arrivée
        if (ride.end_latitude && ride.end_longitude) {
            new google.maps.Marker({
                position: endLatLng,
                map: map,
                title: `Arrivée : ${ride.numero}`,
            });
        }

        // Tracer le trajet entre le point de départ et d'arrivée
        if (ride.start_latitude && ride.start_longitude && ride.end_latitude && ride.end_longitude) {
            new google.maps.Polyline({
                path: [startLatLng, endLatLng], // Tracer entre départ et arrivée
                geodesic: true, // Utiliser une courbe géodésique pour tracer
                strokeColor: "#FF0000", // Couleur de la ligne (rouge)
                strokeOpacity: 1.0, // Opacité de la ligne
                strokeWeight: 2, // Épaisseur de la ligne
                map: map,
            });
        }
    });
};

// Charger Google Maps API avec la bibliothèque geometry pour calculer les distances
document.addEventListener("DOMContentLoaded", function() {
    const script = document.createElement("script");
    script.src =
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCBteeTZAzfzhLkWeucdSI--ReIT_GLpmQ&callback=initMap&libraries=geometry";
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);
});
</script>

@endsection