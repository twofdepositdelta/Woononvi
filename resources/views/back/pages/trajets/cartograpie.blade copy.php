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
<script type="module">
// Fonction pour récupérer les trajets actifs
async function fetchActiveRides() {
    try {
        const response = await fetch('/api/active-rides'); // Remplacer par votre endpoint
        const data = await response.json();
        // console.log('Trajets récupérés :', data.rides); // Ajout d'un log pour vérifier les données
        return data.rides;
    } catch (error) {
        console.error('Erreur lors du chargement des trajets actifs:', error);
        return []; // Retourner un tableau vide en cas d'erreur
    }
}

// Fonction pour ajuster la vue de la carte et inclure tous les trajets
function adjustMapViewToMarkers(map, rides) {
    const bounds = new google.maps.LatLngBounds();

    rides.forEach(ride => {
        if (ride.latitude && ride.longitude) {
            const position = new google.maps.LatLng(ride.latitude, ride.longitude);
            bounds.extend(position);
        }
    });

    map.fitBounds(bounds); // Ajuster la vue de la carte pour inclure tous les markers
}

// Définir la fonction initMap globalement
window.initMap = async function() {
    // Initialisation de la carte centrée sur le sud du Bénin
    const map = new google.maps.Map(document.getElementById("myMap"), {
        center: {
            lat: 6.5,
            lng: 2.5
        }, // Centre sur le sud du Bénin
        zoom: 10, // Zoom ajusté pour couvrir cette zone
    });

    // Récupérer les trajets actifs via l'API
    const rides = await fetchActiveRides();
    if (rides.length === 0) {
        document.getElementById('errorMessage').style.display = 'block'; // Afficher un message d'erreur
        console.log('Aucun trajet actif à afficher.');
    }

    // Ajuster la vue de la carte pour inclure tous les trajets récupérés
    adjustMapViewToMarkers(map, rides);

    // Ajouter un marqueur pour chaque trajet actif
    rides.forEach(ride => {
        if (ride.latitude && ride.longitude) {
            const position = new google.maps.LatLng(ride.latitude, ride.longitude);
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: `Trajet ID: ${ride.id} - Conducteur ID: ${ride.driver_id}`,
                icon: {
                    url: "{{ asset('taxi-solid.svg') }}", // Chemin relatif vers l'icône SVG
                    scaledSize: new google.maps.Size(30,
                        30), // Ajustez la taille de l'icône selon vos besoins
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(30,
                        30), // Point d'ancrage pour centrer l'icône
                    strokeColor: '#FF0',
                }
            });
        }
    });
};

// Assurez-vous que le script Google Maps est chargé avant de lancer la carte
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter le script de l'API Google Maps
    const script = document.createElement('script');
    script.src =
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCBteeTZAzfzhLkWeucdSI--ReIT_GLpmQ&callback=initMap";
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);
});
</script>
@endsection