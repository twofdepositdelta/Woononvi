@extends('back.layouts.master')
@section('title', 'Modifier un type d\'actualité   ')
@section('content')
   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Modifier le Type d'Actualité</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('typenews.update', $typenew) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row gy-3">
                        <!-- name du Type -->
                        <div class="col-12">
                            <label class="form-label" for="name">Nom du Type</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Entrez le name du type" value="{{ old('name', $typenew->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Entrez la description du type" rows="3">{{ old('description', $typenew->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Bouton de soumission -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- / Content -->








@endsection
