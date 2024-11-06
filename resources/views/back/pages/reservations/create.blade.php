@extends('back.layouts.master')
@section('title', 'Creer un trajet  ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Formulaire de Création de Réservation</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf

                    <div class="row gy-3">

                        <div class="row mt-3">
                            <!-- Heure de départ -->
                            <div class="col-md-6">
                                <label class="form-label" for="departure_time">Heure de départ</label>
                                <input type="time" class="form-control" id="time_departure" name="time_departure" >
                            </div>

                            {{-- <!-- Heure d'arrivée -->
                            <div class="col-md-6">
                                <label class="form-label" for="arrival_time">Heure d'arrivée</label>
                                <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                            </div> --}}
                        </div>

                        <div class="row mt-3">
                            <!-- Ville de départ -->
                            <div class="col-md-6">
                                <label class="form-label" for="departure_city">Ville de départ</label>
                                <input type="text" class="form-control" id="departure_city" name="departure_city" placeholder="Ville de départ" >
                            </div>

                            <!-- Ville d'arrivée -->
                            <div class="col-md-6">
                                <label class="form-label" for="destination_city">Ville d'arrivée</label>
                                <input type="text" class="form-control" id="destination_city" name="destination_city" placeholder="Ville d'arrivée" >
                            </div>
                        </div>


                        <!-- Trajet associé -->
                        <div class="col-12 mt-3">
                            <label class="form-label" for="ride_id">Trajet</label>
                            <select class="form-select" id="ride_id" name="ride_id" required>
                                <option value="">Sélectionnez un trajet</option>
                                <!-- Les options seront dynamiquement chargées ici -->
                            </select>
                        </div>
                        <div id="no-results-message" style="display: none; color: red; margin-top: 10px;"></div>

                        <div class="row mt-3">
                            <!-- Nombre de places réservées -->
                            <div class="col-md-6">
                                <label class="form-label" for="seats_reserved">Nombre de places réservées</label>
                                <input type="number" class="form-control @error('seats_reserved') is-invalid @enderror" id="seats_reserved" name="seats_reserved" placeholder="Entrez le nombre de places réservées" value="{{ old('seats_reserved') }}" min="1" required>
                                @error('seats_reserved')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Prix total -->
                            <div class="col-md-6">
                                <label class="form-label" for="total_price">Prix total</label>
                                <input type="number" class="form-control @error('total_price') is-invalid @enderror" id="total_price" name="total_price" placeholder="Entrez le prix total" value="{{ old('total_price') }}" min="1000"  required>
                                @error('total_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Créer la réservation</button>
                        </div>


                       

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- / Content -->

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const departureTime = document.getElementById('time_departure');
    const departureCity = document.getElementById('departure_city');
    const destinationCity = document.getElementById('destination_city');
    const rideSelect = document.getElementById('ride_id');
    const messageContainer = document.getElementById('no-results-message');

    // Fonction pour charger les trajets
    function loadRides() {
        const params = {
            departure_time: departureTime.value,
            departure_city: departureCity.value,
            destination_city: destinationCity.value
        };

        fetch("{{ route('rides.filter') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(params)
        })
        .then(response => response.json())
        .then(data => {
            rideSelect.innerHTML = '<option value="">Sélectionnez un trajet</option>';

            if (data.rides.length > 0) {
                // S'il y a des trajets, on les affiche
                data.rides.forEach(ride => {
                    rideSelect.innerHTML += `<option value="${ride.id}">${ride.departure} - ${ride.destination}</option>`;
                });
                messageContainer.style.display = 'none'; // Masquer le message s'il y a des résultats
            } else {
                // Aucun trajet trouvé, afficher un message
                messageContainer.innerHTML = 'Aucun trajet ne correspond à votre recherche.';
                messageContainer.style.display = 'block'; // Afficher le message
            }
        })
        .catch(error => console.error('Erreur:', error));
    }

    // Ajouter les événements de changement sur les champs pour charger les trajets
    [departureTime, departureCity, destinationCity].forEach(element => {
        element.addEventListener('change', loadRides);
    });
});

</script>







@endsection
