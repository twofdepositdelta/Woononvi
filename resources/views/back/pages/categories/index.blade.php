@extends('back.layouts.master')
@section('title', 'Liste des Catégories')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des Catégories</h5>
        <div class="col-4">
            <select name="type_id" id="type_actuality_filter" class="form-select form-select-sm">
                <option value="">Tous les types de catégorie</option>
                {{--@foreach($typenews as $typenew)
                    <option value="{{ $typenew->id }}" {{ request('type_id') == $typenew->id ? 'selected' : '' }}>
                        {{ $typenew->name }}
                    </option>
                @endforeach--}}
            </select>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une Catégorie</a>

    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">

            @include('back.pages.categories.table',['categories'=>$categories])

            @if (!$categories->isEmpty())

            {{-- pagination --}}

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $categories->firstItem() }} de {{ $categories->lastItem() }} a
                        {{ $categories->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($categories->onFirstPage())
                            <li class="page-item disabled">
                                <span
                                    class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $categories->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($categories->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $categories->currentPage())
                                        <li class="page-item active">
                                            <span
                                                class="page-link bg-primary-600 text-white fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md">{{ $page }}</span>
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

                        {{-- Next Page Link --}}
                        @if ($categories->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $categories->nextPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span
                                    class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>

            {{-- endpagination --}}

            @endif
        </div>
    </div>
</div>

{{--
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeActualityFilter = document.getElementById('type_actuality_filter');

        typeActualityFilter.addEventListener('change', function () {
            const typeId = this.value;

            fetch(`{{ route("categories.filterByType") }}?type_id=${typeId}`, {
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur de requête');
                }
                return response.text();
            })
            .then(html => {
                document.querySelector('table').innerHTML = html;
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    });
 </script>
 --}}

        </div>
    </div>

@endsection


