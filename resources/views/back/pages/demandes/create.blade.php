@extends('back.layouts.master')
@section('title', 'Faire une demande ')
@section('content')


   <!-- Content -->
<div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Formulaire de Demande de Trajet</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ride_requests.store') }}" method="POST">
                    @csrf

                    <div class="row gy-3">
                      <div class="row mt-3">
                          <!-- Départ -->
                          <div class="col-md-6">
                              <label class="form-label" for="departure">Ville de départ</label>
                              <input type="text" class="form-control @error('departure') is-invalid @enderror" id="departure" name="departure" placeholder="Entrez la ville de départ" value="{{ old('departure') }}" required>
                              @error('departure')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>

                          <!-- Destination -->
                          <div class="col-md-6">
                              <label class="form-label" for="destination">Ville de destination</label>
                              <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" placeholder="Entrez la ville de destination" value="{{ old('destination') }}" required>
                              @error('destination')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>

                      </div>

                      <div class="row mt-4">

                          <!-- Heure de départ préférée -->
                          <div class="col-md-6">
                              <label class="form-label" for="preferred_time">Heure de départ préférée</label>
                              <input type="datetime-local" class="form-control @error('preferred_time') is-invalid @enderror" id="preferred_time" name="preferred_time" value="{{ old('preferred_time') }}" required>
                              @error('preferred_time')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>

                          <!-- Nombre de places disponibles -->
                          <div class="col-md-6">
                              <label class="form-label" for="preferred_amount">Nombre de places disponibles</label>
                              <input type="number" class="form-control @error('preferred_amount') is-invalid @enderror" id="preferred_amount" name="preferred_amount" placeholder="Entrez le nombre de places disponibles" value="{{ old('preferred_amount') }}" required>
                              @error('preferred_amount')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>



                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->





{{-- <script>
    function initAutocomplete() {
        // Initialisation de l'autocomplétion pour la ville de départ
        var departureInput = document.getElementById('departure');
        var departureAutocomplete = new google.maps.places.Autocomplete(departureInput, { types: ['(cities)'] });

        // Initialisation de l'autocomplétion pour la ville de destination
        var destinationInput = document.getElementById('destination');
        var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput, { types: ['(cities)'] });

        // Quand la ville de départ est sélectionnée, géolocalisez la ville
        departureAutocomplete.addListener('place_changed', function() {
            var place = departureAutocomplete.getPlace();
            if (place.geometry) {
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                console.log("Ville de départ : " + place.formatted_address + " | Lat: " + latitude + " | Lng: " + longitude);
                // Vous pouvez envoyer latitude et longitude au serveur ici si nécessaire
            }
        });

        // Quand la ville de destination est sélectionnée, géolocalisez la ville
        destinationAutocomplete.addListener('place_changed', function() {
            var place = destinationAutocomplete.getPlace();
            if (place.geometry) {
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                console.log("Ville de destination : " + place.formatted_address + " | Lat: " + latitude + " | Lng: " + longitude);
                // Vous pouvez envoyer latitude et longitude au serveur ici si nécessaire
            }
        });
    }

    // Remplace google.maps.event.addDomListener par addEventListener pour une meilleure performance
    window.addEventListener('load', initAutocomplete);
</script> --}}


@endsection
