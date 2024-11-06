@extends('back.layouts.master')
@section('title', 'Liste des signalements')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des signalements</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                #
                            </div>
                        </th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Type de signalement</th>
                        <th scope="col">Réservation</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($reports->isEmpty())
                        <tr>
                            <td colspan="7" class="text-danger text-center">Aucun signalement enregistré</td>
                        </tr>
                    @else
                        @foreach($reports as $key => $report)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    {{ $key + 1 }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('users.show', $report->user->email) }}">
                                    {{ $report->user->firstname . ' ' . $report->user->lastname }}
                                </a>
                            </td>
                            <td>{{ $report->reportType->name }}</td> <!-- Type de signalement -->
                            <td>
                                <a href="{{ route('bookings.show', $report->booking->id) }}">
                                    {{ $report->booking->id }} <!-- ID de la réservation -->
                                </a>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($report->created_at)->locale('fr')->translatedFormat('D, d M Y,H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('reports.show', $report) }}" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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

@endsection
