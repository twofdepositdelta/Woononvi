@extends('back.layouts.master')
@section('title','Actualité  ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Créer une Actualité</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('actualities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row gy-3">
                        <!-- Titre -->
                        <div class="col-12">
                            <label class="form-label" for="titre">Titre</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" placeholder="Entrez le titre de l'actualité" value="{{ old('titre') }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <div id="editor-container" style="height: 300px;"></div>
                            <input type="hidden" name="content" id="content">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image URL -->
                        <div class="col-12">
                            <label class="form-label" for="image_url">Image URL</label>
                            <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" accept="image/*" required>
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type d'Actualité -->
                        <div class="col-12">
                            <label class="form-label" for="type_new_id">Type d'Actualité</label>
                            <select class="form-select @error('type_new_id') is-invalid @enderror" id="type_new_id" name="type_new_id" required>
                                <option value="">Sélectionnez un type</option>
                                @foreach($typenews as $typenew)
                                    <option value="{{ $typenew->id }}">{{ $typenew->name }}</option>
                                @endforeach
                            </select>
                            @error('type_new_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Statut de Publication</label>
                            <div class="d-flex align-items-center flex-wrap gap-28">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <label class="form-check-label" for="published_yes">Publié</label>
                                    <input type="radio" class="form-check-input @error('published') is-invalid @enderror" id="published_yes" name="published" value="1" >
                                </div>
                                <div class="form-check  d-flex align-items-center gap-2">
                                    <label class="form-check-label" for="published_no">Non publié</label>
                                    <input type="radio" class="form-check-input @error('published') is-invalid @enderror" id="published_no" name="published" value="0">
                                </div>
                            </div>
                            @error('published')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- / Content -->








@endsection
