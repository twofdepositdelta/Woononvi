@extends('back.layouts.master')
@section('title', 'Liste des utilisateurs ')
@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
        </div>
        <a href="add-user.html" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Ajouter un utilisateur
        </a>
    </div>
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
              <thead>
                <tr>
                  <th scope="col">
                    <div class="d-flex align-items-center gap-10">
                        {{-- <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                        </div> --}}
                       #
                    </div>
                  </th>
                  {{-- <th scope="col">Join Date</th> --}}
                  <th scope="col">Nom et Prénom</th>
                  <th scope="col">Adresse email</th>
                  <th scope="col">Télephone</th>
                  <th scope="col">Ville</th>
                  {{-- <th scope="col">Designation</th> --}}
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    @forelse ($users as $index => $user )

                        <td>
                            <div class="d-flex align-items-center gap-10">
                                {{-- <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                </div> --}}
                            {{$index + 1}}
                            </div>
                        </td>

                        <td>
                        <div class="d-flex align-items-center">
                            <img src="{{asset($user->profile?->avatar)}}" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                            <span class="text-md mb-0 fw-normal text-secondary-light">{{$user->name.''.$user->firstname}}</span>
                            </div>
                        </div>
                        </td>

                        <td><span class="text-md mb-0 fw-normal text-secondary-light">{{$user->email}}</span></td>

                        <td>{{$user->phone}}</td>

                        <td>{{$user->city->name}}</td>

                        <td class="text-center">
                        <span class="bg-{{$user->status ?'success':'neutral'}}-focus text-{{$user->status ?'success':'neutral'}}-600 border border-{{$user->status ?'success':'neutral'}}-main px-24 py-4 radius-4 fw-medium text-sm">{{$status->status ?'Activé':'Inactif'}}</span>
                        </td>

                        <td class="text-center">
                        <div class="d-flex align-items-center gap-10 justify-content-center">
                            <button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                            </button>
                            <button type="button" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                            </button>
                        </div>
                        </td>
                    @empty
                            <tr>
                            <td class="text-center">Aucun utilisateur enregistré</td>
                            </tr>
                    @endforelse
                </tr>


              </tbody>
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
            <span>Showing 1 to 10 of 12 entries</span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)"><iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon></a>
                </li>
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md bg-primary-600 text-white" href="javascript:void(0)">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">5</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)"> <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon> </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
