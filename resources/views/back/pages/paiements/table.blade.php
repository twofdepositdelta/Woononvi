
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


