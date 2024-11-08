@extends('back.layouts.master')
@section('title', 'Liste des signalements')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des signalements</h5>
        <div class="col-4">
            <select name="type_id" id="type_signaler_filter" class="form-select form-select-sm">
                <option value="">Tous les types de signalement</option>
                @foreach($reportypes as $reportype)
                    <option value="{{ $reportype->id }}" {{ request('type_id') == $reportype->id ? 'selected' : '' }}>
                        {{ $reportype->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">

            @include('back.pages.signaler.table',['reports'=>$reports])
            @if (!$reports->isEmpty())
                {{-- pagination --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $reports->firstItem() }} de {{ $reports->lastItem() }} a {{ $reports->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($reports->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="{{ $reports->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($reports->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $reports->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link bg-primary-600 text-white fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($reports->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="{{ $reports->nextPageUrl() }}">
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
                {{-- endpagination --}}
            @endif
        </div>
    </div>
    <!-- / Content -->
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const typeSignalerFilter = document.getElementById('type_signaler_filter');

    typeSignalerFilter.addEventListener('change', function () {
        const typeId = this.value;

        fetch(`{{ route("reports.filterByType") }}?type_id=${typeId}`, {
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

@endsection
