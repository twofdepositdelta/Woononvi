@extends('back.layouts.master')
@section('title', 'Type d\'actualité  ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Formulaire de Création de Type d'Actualité</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('typenews.store') }}" method="POST">
                    @csrf

                    <div class="row gy-3">
                        <!-- Nom -->
                        <div class="col-12">
                            <label class="form-label" for="nom">Nom du Type</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Entrez le nom du type" value="{{ old('nom') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Entrez la description du type" rows="3">{{ old('description') }}</textarea>
                            @error('description')
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







<script>
    // Initialiser Snow Editor
    const editor = new SnowEditor('#editor', {
        toolbar: [
            'bold',
            'italic',
            'underline',
            'strikeThrough',
            'orderedList',
            'unorderedList',
            'link',
            'image',
            'code'
        ]
    });

    // Gestion de l'envoi du formulaire
    document.getElementById('myForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const title = document.getElementById('title').value;
        const content = editor.getContent(); // Obtenir le contenu de l'éditeur

        console.log('Titre:', title);
        console.log('Contenu:', content);
        // Vous pouvez ici envoyer les données à un serveur ou les traiter comme bon vous semble
    });
</script>
@endsection
