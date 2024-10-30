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
                            {{-- <div id="editor" class="form-control"></div> --}}
                            <div id="editor" style="height: 300px;"></div>
                            <input type="hidden" name="description" id="description">
                            {{-- <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Entrez la description de l'actualité" rows="3" required>{{ old('description') }}</textarea> --}}

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>


                        <!-- Image URL -->
                        <div class="col-12">
                            <label class="form-label" for="image_url">Image</label>
                            <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" accept="image/*" required>
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                         <!-- Type d'Actualité -->
                         <div class="col-12 mt-5">
                            <label class="form-label" for="type_new_id">Type d'Actualité</label>
                            <select class="form-select @error('type_new_id') is-invalid @enderror" id="type_new" name="type_new_id" required>
                                <option value="">Sélectionnez un type</option>
                                @foreach($typenews as $typenew)
                                    <option value="{{ $typenew->id }}">{{ $typenew->name }}</option>
                                @endforeach
                            </select>
                            @error('type_new_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <!-- Sélection des Rôles -->
                         <div class="col-12">
                            <label class="form-label">Sélectionnez un Rôle</label>
                            <select class="form-select @error('roles') is-invalid @enderror"   name="roles[]" id="roles" multiple required style="width: 100%; height: 150px;">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="col-12 d-none" id="status">
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        let typenew = document.getElementById('type_new');
        let status = document.getElementById('status');

        // Écoutez les changements sur le select
        typenew.addEventListener('change', function() {
            // Vérifiez si le type sélectionné est celui qui nécessite d'afficher le statut
            if (typenew.value === '3') { // Remplacez '1' par l'ID du type qui doit afficher le statut
                status.classList.remove('d-none'); // Affiche le statut
            } else {
                status.classList.add('d-none'); // Cache le statut
            }
        });
    });
</script>

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



<!-- / Content -->








@endsection
