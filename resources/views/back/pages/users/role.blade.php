@extends('back.layouts.master')
@section('title', 'Assigner role')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div
        class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">


        </div>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                       
                        <th scope="col">Nom et prénom(s)</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $index => $user)
                        <tr>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($user->profile->avatar ?? 'path/to/default/avatar.jpg') }}"
                                            alt="Avatar de {{ $user->firstname }}" class="flex-shrink-0 me-12 radius-8"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $user->firstname }} {{ $user->lastname }}</h6>
                                    </div>
                                </td>
                            <td class="text-center">
                                @foreach($user->roles as $role)
                                <span class="badge bg-primary"> {{ $role->role }}</span>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-outline-primary-600 not-active px-18 py-11 dropdown-toggle toggle-icon"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">Assigner Role
                                        </button>
                                    <ul class="dropdown-menu" style="">
                                        @foreach ($roles as $role)
                                        @if (!$user->roles->contains('id', $role->id))
                                            <form action="{{ route('users.assignRole', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                <li>
                                                    <a href="javascript:void(0)" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" onclick="this.closest('form').submit();">
                                                        {{ $role->role }}
                                                    </a>
                                                </li>
                                            </form>
                                        @endif
                                    @endforeach

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

             {{-- pagination --}}

             <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>Affichage {{ $users->firstItem() }} de {{ $users->lastItem() }} a
                    {{ $users->total() }} entrées</span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span
                                class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $users->previousPageUrl() }}">
                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($users->links()->elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $users->currentPage())
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
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $users->nextPageUrl() }}">
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
        </div>


    </div>
</div>

@endsection
