@extends('back.layouts.master')
@section('title', 'Modifier une catégorie   ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Modifier la catégorie</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $actuality) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row gy-3">
                        <!-- Titre -->
                        <div class="col-12">
                            <label class="form-label" for="label">Libellé</label>
                            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Entrez le libellé de la catégorie" value="{{ old('label', $categorie->label) }}" required>
                            @error('label')
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
