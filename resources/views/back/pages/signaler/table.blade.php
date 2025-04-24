<table class="table bordered-table sm-table mb-0">
    <thead>
        <tr>
            <th scope="col">
                <div class="d-flex align-items-center gap-10">
                    Réservation
                </div>
            </th>
            <th scope="col">Auteur</th>
            <th scope="col">Type de signalement</th>
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
                        <a href="{{ route('bookings.show', $report->booking->booking_number) }}">
                            #{{ $report->booking->booking_number }} <!-- ID de la réservation -->
                        </a>
                    </div>
                </td>
                <td>
                    <a href="{{ route('users.show', $report->user->email) }}">
                        {{ $report->user->firstname . ' ' . $report->user->lastname }}
                    </a>
                </td>
                <td>{{ $report->reportType->name }}</td> <!-- Type de signalement -->


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
