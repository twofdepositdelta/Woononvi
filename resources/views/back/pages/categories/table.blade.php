<table class="table bordered-table sm-table mb-0">
    <thead>
        <tr>
            <th scope="col">
                <div class="d-flex align-items-center gap-10">#</div>
            </th>
            <th scope="col">Libellé</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($categories->isEmpty())
            <tr>
                <td colspan="6" class="text-danger text-center">Aucune catégorie enregistrée</td>
            </tr>
        @else
            @foreach ($categories as $key => $categorie)
                <tr> 
                    <td>
                        <div class="d-flex align-items-center gap-10">
                            {{ $key + 1 }}
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                              <span class="text-md mb-0 fw-normal text-secondary-light">{{ $categorie->label }}</span>
                            </div>
                          </div>
                    </td>

                    <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            <!-- Edit -->
                            <a href="{{ route('categories.edit', $categorie)}}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                            </a>
                            <!-- Show -->
                            <a href="#"  type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('categories.destroy', $categorie) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
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
