@extends('back.layouts.master')
@section('title', 'Liste des contacts')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des contacts</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom & Prénom(s)</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Sujet</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($contacts->isEmpty())
                        <tr>
                            <td colspan="7" class="text-danger text-center">Aucun contact enregistré</td>
                        </tr>
                    @else
                        @foreach($contacts as $key => $contact)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $contact->fullname }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="{{ route('contact.show', $contact) }}" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                    </a>

                                    <form action="{{ route('contact.destroy', $contact) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
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

            @if (!$contacts->isEmpty())
                <!-- Pagination -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Affichage de {{ $contacts->firstItem() }} à {{ $contacts->lastItem() }} sur {{ $contacts->total() }} entrées</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        <!-- Previous Page Link -->
                        @if ($contacts->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                   href="{{ $contacts->previousPageUrl() }}">
                                    <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                                </a>
                            </li>
                        @endif

                        <!-- Pagination Elements -->
                        @foreach ($contacts->links()->elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $contacts->currentPage())
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

                        <!-- Next Page Link -->
                        @if ($contacts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                   href="{{ $contacts->nextPageUrl() }}">
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
                <!-- End Pagination -->
            @endif
        </div>
    </div>
    <!-- / Content -->
</div>


@endsection
