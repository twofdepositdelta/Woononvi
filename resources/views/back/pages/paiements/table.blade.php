
    <table class="table bordered-table sm-table mb-0">
        <thead>
            <tr>
                <th>Nom et Prénom(s)</th>
                <th>Référence</th>
                <th>Méthode</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($payments->isEmpty())
                <tr>
                    <td colspan="7" class="text-danger text-center">Aucun paiement enregistré</td>
                </tr>
            @else
                @foreach ($payments as $index => $payment)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($payment->user->profile->avatar ?? 'path/to/default/avatar.jpg') }}"
                                    alt="Avatar de {{ $payment->user->firstname }}" class="flex-shrink-0 me-12 radius-8"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $payment->user->firstname }} {{ $payment->user->lastname }}</h6>
                            </div>
                        </td>
                        <td>{{ $payment->reference }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td> {{ \Carbon\Carbon::parse($payment->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</td>
                        <td>{{ number_format($payment->amount, 0, ',', ' ') }} Fcfa</td>
                        <td>
                            @if ($payment->status == 'SUCCESSFUL')
                                <span class="badge bg-success">Réussi</span>
                            @elseif ($payment->status == 'PENDING')
                                <span class="badge bg-warning">En attente</span>
                            @elseif ($payment->status == 'FAILED')
                                <span class="badge bg-danger">Échoué</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                <!-- Bouton pour voir les détails -->
                                <a href="{{ route('payments.show', $payment) }}"
                                   class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if (!$payments->isEmpty())
    {{-- pagination --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
        <span>Affichage {{ $payments->firstItem() }} à {{ $payments->lastItem() }} de {{ $payments->total() }} paiements</span>
        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
            {{-- Previous Page Link --}}
            @if ($payments->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                       href="{{ $payments->previousPageUrl() }}">
                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($payments->links()->elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $payments->currentPage())
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
            @if ($payments->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                       href="{{ $payments->nextPageUrl() }}">
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


