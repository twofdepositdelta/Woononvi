@extends('back.layouts.master')
@section('title', 'Ajouter des tranches de kilométrage')
@section('content')


    <!-- Content -->
    <div class="row gy-4">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@yield('title')</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kilometrages.store') }}" method="POST">
                        @csrf

                        <div id="kilometrage-container">
                            <div class="row gy-3 kilometrage-row">
                                <div class="col-md-4">
                                    <label class="form-label">Kilomètre minimal</label>
                                    <input type="number" min="1" class="form-control" name="min_km[]" placeholder="Min km" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Kilomètre maximal</label>
                                    <input type="number" min="1" class="form-control" name="max_km[]" placeholder="Max km" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Taux (FCFA)</label>
                                    <input type="number" class="form-control" name="taux_par_km[]" placeholder="Taux" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Catégorie de véhicule</label>
                                    <select class="form-select" name="categorie_id[]" required>
                                        <option value="">Sélectionnez un catégorie</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-btn" style="display:none;">Supprimer</button>
                                </div>

                                <hr class="mb-3">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <button type="button" class="btn btn-secondary" id="add-kilometrage">
                                    + Ajouter un intervalle
                                </button>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>




<script>
    document.getElementById('add-kilometrage').addEventListener('click', function () {
        let container = document.getElementById('kilometrage-container');
        let firstRow = container.querySelector('.kilometrage-row');
        let clone = firstRow.cloneNode(true);

        // Réinitialise les champs
        clone.querySelectorAll('input').forEach(input => input.value = '');
        clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        // Affiche bouton de suppression
        clone.querySelector('.remove-btn').style.display = 'inline-block';

        container.appendChild(clone);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-btn')) {
            e.target.closest('.kilometrage-row').remove();
        }
    });
</script>



    <!-- / Content -->








@endsection
