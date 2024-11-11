@extends('back.layouts.master')
@section('title', 'Modifier une actualité   ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Modifier l'Actualité</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('actualities.update', $actuality) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row gy-3">
                        <!-- Titre -->
                        <div class="col-12">
                            <label class="form-label" for="titre">Titre</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" placeholder="Entrez le titre de l'actualité" value="{{ old('titre', $actuality->titre) }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <input type="hidden" name="description" id="description" value="{{ old('description', $actuality->description) }}">
                            <div id="editor" class="form-control">{!! old('description', $actuality->description) !!}</div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image URL -->
                        <div class="col-12">
                            <label class="form-label" for="image_url">Image URL</label>
                            <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" accept="image/*">
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                         <!-- Type d'Actualité -->
                         <div class="col-12">
                            <label class="form-label" for="type_new_id">Type d'Actualité</label>
                            <select class="form-select @error('type_new_id') is-invalid @enderror" id="type_new" name="type_new_id" required>
                                <option value="">Sélectionnez un type</option>
                                @foreach($typenews as $typenew)
                                    <option value="{{ $typenew->id }}" {{ $typenew->id === $actuality->type_new_id ? 'selected' : '' }}>{{ $typenew->name }}</option>
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
                                    <input type="radio" class="form-check-input @error('published') is-invalid @enderror" id="published_yes" name="published" value="1" {{ old('published', $actuality->published ?? false) ? 'checked' : '' }}>
                                </div>
                                <div class="form-check d-flex align-items-center gap-2">
                                    <label class="form-check-label" for="published_no">Non publié</label>
                                    <input type="radio" class="form-check-input @error('published') is-invalid @enderror" id="published_no" name="published" value="0" {{ old('published', $actuality->published ?? true) ? '' : 'checked' }}>
                                </div>
                            </div>
                            @error('published')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- / Content -->








<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialisation de Quill avec le thème Snow
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Mettre à jour le champ caché lors des changements dans l'éditeur
        quill.on('text-change', function() {
            // Récupérer le contenu HTML de l'éditeur
            var content = document.querySelector('input[name=description]');
            content.value = quill.root.innerHTML;
        });

        // Transférer le contenu de l'éditeur dans le champ caché lors de la soumission du formulaire
        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Récupérer le contenu HTML de l'éditeur (bien que cela soit déjà fait à chaque changement)
            var content = document.querySelector('input[name=description]');
            content.value = quill.root.innerHTML;
        };
    });
</script>


@endsection
