@extends('back.layouts.master')
@section('title', 'Catégorie ')
@section('content')


    <!-- Content -->
    <div class="row gy-4">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une Catégorie</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="row gy-3">
                            <!-- Titre -->
                            <div class="col-12">
                                <label class="form-label" for="label">Libellé</label>
                                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Entrez le libellé de la catégorie" value="{{ old('label') }}" required>
                                @error('label')
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let role = document.getElementById('role');
            let newtype = document.getElementById('type_new');

            newtype.addEventListener('change', function() {

                if (newtype.value === '2' || newtype.value === '1') {

                    role.classList.remove('d-none')
                } else {

                    role.classList.add('d-none')

                }

            });

        });
    </script>

    <!-- / Content -->








@endsection
