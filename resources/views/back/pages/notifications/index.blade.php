@extends('back.layouts.master')
@section('title', 'Liste des notifications')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">@yield('title')</h5>
            <div class="col-4"></div>
        </div>

        <!-- Contenu -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $key => $notif)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ Str::limit($notif->data['message'] ?? '', 60) }}</td>
                                <td>{{ $notif->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if ($notif->read_at)
                                        <span class="badge bg-success">Lue</span>
                                    @else
                                        <span class="badge bg-warning">Non lue</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                        @if (is_null($notif->read_at))
                                        <form action="{{ route('notifications.markAsRead', $notif->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                Marquer comme lue
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-success">Déjà lue</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-danger text-center">Aucune notification trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if (!$notifications->isEmpty())
                    {{-- pagination --}}
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                            <span>Affichage {{ $notifications->firstItem() }} de {{ $notifications->lastItem() }} a
                                {{ $notifications->total() }} entrées</span>
                            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                {{-- Previous Page Link --}}
                                @if ($notifications->onFirstPage())
                                    <li class="page-item disabled">
                                        <span
                                            class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                            <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                            href="{{ $notifications->previousPageUrl() }}">
                                            <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($notifications->links()->elements as $element)
                                    {{-- "Three Dots" Separator --}}
                                    @if (is_string($element))
                                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                    @endif

                                    {{-- Array Of Links --}}
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $notifications->currentPage())
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
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($notifications->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                            href="{{ $notifications->nextPageUrl() }}">
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
                        </div>
                    {{-- endpagination --}}
                @endif
            </div>
        </div>
    </div>




@endsection


