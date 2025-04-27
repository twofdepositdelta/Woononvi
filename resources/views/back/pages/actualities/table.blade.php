<table class="table bordered-table sm-table mb-0">
    <thead>
        <tr>
            <th scope="col">
                <div class="d-flex align-items-center gap-10">#</div>
            </th>
            <th scope="col">Titre</th>
          
            <th scope="col">Publié</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($actualities->isEmpty())
            <tr>
                <td colspan="6" class="text-danger text-center">Aucune actualité enregistrée</td>
            </tr>
        @else
            @foreach ($actualities as $key => $actuality)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-10">
                            {{ $key + 1 }}
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if ($actuality->typeNew->name=="Blog" )
                                 <img src="{{ asset($actuality->image_url ? $actuality->image_url : 'storage/back/assets/images/flags/flag9.png') }}" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            @endif
                            <div class="flex-grow-1">
                              <span class="text-md mb-0 fw-normal text-secondary-light">{{ $actuality->titre }}</span>
                            </div>
                          </div>
                    </td>

                    <td>
                        <span class="badge {{ $actuality->published ? 'bg-success' : 'bg-warning' }}">
                            {{ $actuality->published ? 'Oui' : 'Non' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            @if ($actuality->typeNew->name=="Blog")
                            <!-- Edit -->
                            <a href="{{ route('actualities.edit', $actuality)}}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                            </a>

                            @endif

                            <a href="{{ route('actualities.show', $actuality)}}"  type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('actualities.destroy', $actuality) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
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
