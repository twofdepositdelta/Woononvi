@extends('back.layouts.master')
@section('title', 'Liste des documents ')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class="card-title mb-0">Liste des documents</h5>
    </div>
    <!-- Content -->
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom & Prénom(s)</th>
                        <th>Nbre doc</th>
                        <th>Date d'inscription</th>
                        <th>Etat</th>
                        {{-- <th>Validation</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="7" class="text-danger text-center">Aucun document enregistré</td>
                        </tr>
                    @else
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->email) }}">
                                        {{ $user->firstname . ' ' . $user->lastname ?? 'Non disponible' }}
                                    </a>
                                </td>
                                <td>{{ count($user->documents) }}</td>

                                <td>
                                    {{ $user->created_at ?
                                    ucfirst(\Carbon\Carbon::parse($user->created_at)->locale('fr_FR')->translatedFormat('D d M Y')) : 'N/A' }}
                                </td>
                                <td>
                                    <span class="badge {{$user->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>


                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                            <a href="{{ route('documents.show', $user->email) }}" class="btn btn-primary text-sm">
                                                Validation
                                            </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{-- pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>Affichage {{ $users->firstItem() }} de {{ $users->lastItem() }} à {{ $users->total() }} entrées</span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Lien de page précédente --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $users->previousPageUrl() }}">
                                <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination --}}
                    @foreach ($users->links()->elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $users->currentPage())
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

                    {{-- Lien de page suivante --}}
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $users->nextPageUrl() }}">
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
            {{-- fin de pagination --}}
        </div>
    </div>
    <!-- / Content -->
</div>


@endsection


