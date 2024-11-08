@extends('back.layouts.master')
@section('title', 'Liste des Véhicules')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">Liste des Véhicules</h5>
            {{-- <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Ajouter un Véhicule</a> --}}

            <div class="col-4">
                <select name="type_id" id="type_vehicle_filter" class="form-select form-select-sm">
                    <option value="">Tous les types de véhicules</option>
                    @foreach($typevehicles as $typevehicle)
                        <option value="{{ $typevehicle->id }}" {{ request('type_id') == $typevehicle->id ? 'selected' : '' }}>
                            {{ $typevehicle->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                @include('back.pages.vehicules.table',['vehicles'=>$vehicles])

                @if (!$vehicles->isEmpty())
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $vehicles->firstItem() }} de {{ $vehicles->lastItem() }} sur {{ $vehicles->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        @if ($vehicles->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $vehicles->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </a>
                            </li>
                        @endif

                        @foreach ($vehicles->links()->elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $vehicles->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link bg-primary-600 text-white fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                                href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($vehicles->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $vehicles->nextPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-right"></iconify-icon>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-right"></iconify-icon>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>








<script>
    $(document).ready(function () {
        $('#type_vehicle_filter').on('change', function() {
        var typeId = $(this).val();

        // Utilisation de AJAX pour récupérer les véhicules filtrés
        $.ajax({
            url: '{{ route("vehicles.filterByType") }}',
            method: 'GET',
            data: {
                type_id: typeId
            },
            success: function(response) {
                // Remplacer le contenu de la table avec les nouveaux véhicules filtrés
                $('table').html(response);
            },
            error: function(xhr) {
                        // alert('bad');
                        console.error(xhr.responseText);
                    }
        });
    });
    });
</script>
@endsection


