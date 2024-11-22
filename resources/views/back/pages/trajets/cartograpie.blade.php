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
    <div id="myMap" style="width: 100%;"></div>
    <div id="errorMessage" style="display:none; color: red; text-align: center; padding: 20px;">
        Aucun trajet actif à afficher.
    </div>
@endsection

@section('customJS')
    <script>
    let infoWindow = null; // Variable pour garder une référence de l'infoWindow ouvert
    let markers = []; // Tableau pour stocker les marqueurs
    let polylines = []; // Tableau pour stocker les polylignes

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

    // Fonction pour nettoyer la carte
    function clearMap() {
        markers.forEach(marker => marker.setMap(null));
        polylines.forEach(polyline => polyline.setMap(null));
        markers = [];
        polylines = [];
    }

    // Fonction pour récupérer les trajets actifs
    async function fetchActiveRides() {
        try {
            const response = await fetch(`/api/active-rides?timestamp=${Date.now()}`);
            const data = await response.json();
            console.log("Trajets récupérés :", data.rides); // Inspecte les données renvoyées par l'API
            return data.rides.map(ride => ({
                start_latitude: ride.start_latitude,
                start_longitude: ride.start_longitude,
                end_latitude: ride.end_latitude,
                end_longitude: ride.end_longitude,
                start_location_name: ride.start_location_name,
                end_location_name: ride.end_location_name,
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
            center: { lat: 9.5, lng: 2.6 },  // Centré sur le Bénin
            zoom: 10,  // Zoom ajusté pour couvrir le Bénin de manière plus confortable
            restriction: {
                latLngBounds: {
                    north: 11.5,  // Limite nord du Bénin
                    south: 6,     // Limite sud du Bénin
                    east: 3.5,    // Limite est du Bénin
                    west: 1,      // Limite ouest du Bénin
                },
                strictBounds: false,  // Permet aux utilisateurs de sortir légèrement des limites si nécessaire
            },
        });

        // Récupération des trajets actifs via l'API
        const rides = await fetchActiveRides();

        if (rides.length === 0) {
            document.getElementById("errorMessage").textContent = "Aucun trajet actif disponible.";
            document.getElementById("errorMessage").style.display = "block";
            return;
        }

        // Nettoie la carte avant d'ajouter les nouveaux trajets
        clearMap();

        adjustMapViewToMarkers(map, rides);

        // Ajout des marqueurs et tracé des trajets pour chaque trajet
        const colors = ["#FF0000", "#00FF00", "#0000FF", "#FFA500"]; // Couleurs variées pour différencier les trajets

        rides.forEach((ride, index) => {
            const startLatLng = new google.maps.LatLng(ride.start_latitude, ride.start_longitude);
            const endLatLng = new google.maps.LatLng(ride.end_latitude, ride.end_longitude);

            // Marqueur pour le point de départ
            if (ride.start_latitude && ride.start_longitude) {
                const startMarker = new google.maps.Marker({
                    position: startLatLng,
                    map: map,
                    title: `Départ : ${ride.start_location_name} (${ride.numero})`,
                    icon: {
                        url: "{{ asset('taxi-solid.svg') }}",
                        scaledSize: new google.maps.Size(30, 30),
                        anchor: new google.maps.Point(15, 15),
                    },
                });

                // Affichage de l'infobulle
                google.maps.event.addListener(startMarker, "click", function() {
                    const distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(startLatLng, endLatLng);
                    const distanceInKm = (distanceInMeters / 1000).toFixed(2);

                    const content = `
                        <div>
                            <strong>Départ:</strong> ${ride.start_location_name} <br>
                            <strong>Arrivée:</strong> ${ride.end_location_name} <br>
                            <strong>Numéro:</strong> ${ride.numero} <br>
                            <strong>Distance:</strong> ${distanceInKm} km
                        </div>
                    `;
                    if (infoWindow) {
                        infoWindow.close();
                    }

                    infoWindow = new google.maps.InfoWindow({ content: content });
                    infoWindow.open(map, startMarker);
                });

                markers.push(startMarker);
            }

            // Marqueur pour le point d'arrivée
            if (ride.end_latitude && ride.end_longitude) {
                const endMarker = new google.maps.Marker({
                    position: endLatLng,
                    map: map,
                    title: `Arrivée : ${ride.end_location_name} (${ride.numero})`,
                });
                markers.push(endMarker);
            }

            // Tracer le trajet
            if (ride.start_latitude && ride.start_longitude && ride.end_latitude && ride.end_longitude) {
                const polyline = new google.maps.Polyline({
                    path: [startLatLng, endLatLng],
                    geodesic: true,
                    strokeColor: colors[index % colors.length],
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                    map: map,
                });
                polylines.push(polyline);
            }
        });
    };

    // Charger Google Maps API avec la bibliothèque geometry pour calculer les distances
    document.addEventListener("DOMContentLoaded", function() {
        const script = document.createElement("script");
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCBteeTZAzfzhLkWeucdSI--ReIT_GLpmQ&callback=initMap&libraries=geometry";
        script.async = true;
        script.defer = true;
        document.body.appendChild(script);
    });
</script>

@endsection
