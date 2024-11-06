@extends('back.layouts.master')
@section('title', 'Liste des Transactions ')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class=" card-title mb-0">Liste des Transactions</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Passager</th>
                        <th>Conducteur</th>
                        <th>Montant</th>
                        <th>Trajet</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transactions->isEmpty())
                        <tr>
                            <td colspan="8" class="text-danger text-center">Aucune transaction enregistrée</td>
                        </tr>
                    @else
                        @foreach ($transactions as $index => $transaction)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $transaction->booking->passenger->firstname.' '.$transaction->booking->passenger->lastname ?? 'N/A' }}</td>
                                <td>{{ $transaction->driver->firstname.' '.$transaction->driver->lastname ?? 'N/A' }}</td>
                                <td>{{ number_format($transaction->booking->total_price,0, ',', ' ') }} Fcfa</td>
                                <td>{{ ($transaction->booking->ride->departure.'-'.$transaction->booking->ride->destination) }}</td>

                                <td>
                                    @if ($transaction->status == 'completed')
                                        <span class="badge bg-success">Réussi </span>
                                    @elseif ($transaction->status == 'pending')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif ($transaction->status == 'cancelled')
                                        <span class="badge bg-danger">Annulé</span>
                                    @elseif ($transaction->status == 'refunded')
                                        <span class="badge bg-secondary">Remboursé</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <!-- Bouton pour voir les détails -->
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                           class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                        </a>

                                            {{-- <form action="{{ route('transactions.status',[$transaction,'status'=> 'refunded']) }}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-primary text-sm" {{ $transaction->status != 'cancelled' ? 'disabled' : '' }}>
                                                    Remboursé
                                                </button>
                                            </form> --}}

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if (!$transactions->isEmpty())
                {{-- pagination --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage {{ $transactions->firstItem() }} à {{ $transactions->lastItem() }} de {{ $transactions->total() }} transactions</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($transactions->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                   href="{{ $transactions->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($transactions->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $transactions->currentPage())
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

                        {{-- Next Page Link --}}
                        @if ($transactions->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                   href="{{ $transactions->nextPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
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
    <!-- / Content -->
</div>



@endsection
