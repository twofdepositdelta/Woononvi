@extends('back.layouts.master')
@section('title', 'Creer un trajet  ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Formulaire de Création de Trajet</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('rides.store') }}" method="POST">
                    @csrf

                    <div class="row gy-3">
                       <div class="row mt-3">
                           <!-- Ville de départ -->
                           <div class="col-md-6">
                               <label class="form-label" for="departure">Ville de départ</label>
                               <input type="text" class="form-control @error('departure') is-invalid @enderror" id="departure" name="departure" placeholder="Entrez la ville de départ" value="{{ old('departure') }}" required>
                               @error('departure')
                                   <div class="invalid-feedback">{{ $message }}</div>
                               @enderror
                           </div>
                           <!-- Ville de destination -->
                           <div class="col-md-6">
                               <label class="form-label" for="destination">Ville de destination</label>
                               <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" placeholder="Entrez la ville de destination" value="{{ old('destination') }}" required>
                               @error('destination')
                                   <div class="invalid-feedback">{{ $message }}</div>
                               @enderror
                           </div>

                        </div>

                        <div class="row mt-4 ">
                            <!-- Heure de départ -->
                            <div class="col-md-6">
                                <label class="form-label" for="departure_time">Heure de départ prévue</label>
                                <input type="datetime-local" class="form-control @error('departure_time') is-invalid @enderror" id="departure_time" name="departure_time" value="{{ old('departure_time') }}" required>
                                @error('departure_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombre de places disponibles -->
                            <div class="col-md-6">
                                <label class="form-label" for="available_seats">Nombre de places disponibles</label>
                                <input type="number" class="form-control @error('available_seats') is-invalid @enderror" id="available_seats" name="available_seats" placeholder="Entrez le nombre de places disponibles" value="{{ old('available_seats') }}" required>
                                @error('available_seats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mt-4">

                            <!-- Prix par kilomètre -->
                            <div class="col-md-6">
                                <label class="form-label" for="price_per_km">Prix par kilomètre</label>
                                <input type="number" class="form-control @error('price_per_km') is-invalid @enderror" id="price_per_km" name="price_per_km" placeholder="Entrez le prix par kilomètre" value="{{ old('price_per_km') }}" required>
                                @error('price_per_km')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Trajet à proximité -->
                            <div class="col-md-6">
                                <label class="form-label" for="is_nearby_ride">Trajet à proximité</label>
                             <div class="d-flex align-items-center flex-wrap gap-28">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <span class="form-check-label">Cochez si c'est un trajet à proximité</span>
                                    <input class="form-check-input" type="checkbox" id="is_nearby_ride" name="is_nearby_ride" value="1" {{ old('is_nearby_ride') ? 'checked' : '' }}>
                                </div>
                                @error('is_nearby_ride')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                             </div>
                            </div>
                        </div>





                        <!-- Bouton de soumission -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Créer le trajet</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- / Content -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        now.setHours(now.getHours() + 1);
        const minDateTime = now.toISOString().slice(0, 16);

        const departureTimeInput = document.getElementById('departure_time');
        departureTimeInput.min = minDateTime;
        departureTimeInput.value = minDateTime;

        // Validation supplémentaire pour empêcher la sélection des jours précédents
        departureTimeInput.addEventListener('input', function() {
            const selectedDate = new Date(departureTimeInput.value);
            if (selectedDate < new Date(minDateTime)) {
                alert('Veuillez sélectionner une date et une heure valides.');
                departureTimeInput.value = minDateTime; // Réinitialise à la valeur minimale
            }
        });
    });
 </script>








@endsection
