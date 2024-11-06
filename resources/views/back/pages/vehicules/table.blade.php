<table class="table bordered-table sm-table mb-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Modèle</th>
            <th scope="col">Immatriculation</th>
            <th scope="col">Marque</th>
            <th scope="col">Année</th>
            <th scope="col">Propriétaire</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($vehicles->isEmpty())
            <tr>
                <td colspan="8" class="text-danger text-center">Aucun véhicule enregistré</td>
            </tr>
        @else
            @foreach ($vehicles as $key => $vehicle)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($vehicle->main_image ?? 'path/to/default/avatar.jpg') }}"
                                alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden"
                                style="width: 40px; height: 40px; object-fit: cover;">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $vehicle->vehicle_model }}</h6>
                        </div>
                    </td>
                    <td>{{ $vehicle->licence_plate }}</td>
                    <td>{{ $vehicle->vehicle_mark }}</td>
                    <td>{{ $vehicle->vehicle_year }}</td>
                    <td>{{ $vehicle->driver->firstname.' '.$vehicle->driver->lastname }}</td>
                    <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            <a href="{{ route('vehicles.show', $vehicle)}}"  type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </a>
                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
