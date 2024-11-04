@extends('back.layouts.master')
@section('title', 'Recherches des trajet')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            {{-- <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ville de départ</th>
                        <th>Ville de destination</th>
                        <th>Passager</th>
                        <th>Date de recherche</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ridesearches->isEmpty())
                    <tr>
                        <td colspan="6" class="text-danger text-center">Aucune recherche enregistrée</td>
                    </tr>
                    @else
                        @foreach ($ridesearches as $index => $search)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $search->departure }}</td>
                                <td>{{ $search->destination }}</td>
                                <td>{{ $search->passenger->firstname ?? 'Inconnu' }}</td>
                                <td>{{ $search->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="#" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table> --}}

            {{-- @if (!$ridesearches->isEmpty()) --}}

                {{-- pagination --}}

                {{-- <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $ridesearches->firstItem() }} de {{ $ridesearches->lastItem() }} a
                        {{ $ridesearches->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center"> --}}
                        {{-- Previous Page Link --}}
                        {{-- @if ($ridesearches->onFirstPage())
                            <li class="page-item disabled">
                                <span
                                    class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $ridesearches->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </a>
                            </li>
                        @endif --}}

                        {{-- Pagination Elements --}}
                        {{-- @foreach ($ridesearches->links()->elements as $element)

                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif


                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $ridesearches->currentPage())
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
                        @endforeach --}}

                        {{-- Next Page Link --}}
                        {{-- @if ($ridesearches->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                    href="{{ $ridesearches->nextPageUrl() }}">
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
                </div> --}}

            {{-- endpagination --}}
            {{-- @endif
        </div>
    </div> --}}
    <!-- / Content -->
{{-- </div> --}}

@endsection
