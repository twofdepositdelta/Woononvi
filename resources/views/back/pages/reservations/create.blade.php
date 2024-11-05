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




                        <!-- Trajet associé -->
                        <div class="col-12">
                            <label class="form-label" for="ride_id">Trajet</label>
                            <select class="form-select @error('ride_id') is-invalid @enderror" id="ride_id" name="ride_id" required>
                                <option value="">Sélectionnez un trajet</option>
                                @foreach($rides as $ride)
                                    <option value="{{ $ride->id }}" {{ old('ride_id') == $ride->id ? 'selected' : '' }}>
                                        {{ $ride->departure }} - {{ $ride->destination }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ride_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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








@endsection
