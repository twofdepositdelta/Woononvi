@extends('back.layouts.master')
@section('title', 'Détails d\'actualité ')
@section('content')

<div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $actuality->titre }}</h5>
            </div>
            <div class="card-body">
                <div class="row py-2">
                  <div class="col">
                      <div class="mb-3">
                          <img src="{{ asset($actuality->image_url) }}" alt="Image" class="img-fluid">
                      </div>
                  </div>

                  <div class="col mt-5">
                    <div class="mb-3">
                        <h6>Description :</h6>
                        <p>{!! $actuality->description !!}</p>
                    </div>

                    <div class="mb-3">
                        <h6>Type d'Actualité :</h6>
                        <p>{{ $actuality->typeactualite->name }}</p> <!-- Assurez-vous que le modèle a une relation avec TypeNew -->
                    </div>

                    <div class="mb-3">
                        <h6>Publié :</h6>
                        <span class="badge {{ $actuality->published ? 'bg-success' : 'bg-warning' }}">
                            {{ $actuality->published ? 'Oui' : 'Non' }}
                        </span>
                    </div>
                  </div>
                </div>



                <div class="text-end">
                    <a href="{{ route('actualities.edit', $actuality) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('actualities.destroy', $actuality) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <a href="{{ route('actualities.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- / Content -->



        </div>
    </div>

@endsection



