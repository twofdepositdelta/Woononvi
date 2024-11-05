@extends('back.layouts.master')
@section('title', 'Liste des commentaires')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class=" card-title mb-0">Liste des commentaires</h5>
    </div>
   <!-- Content -->
   <div class="card-body p-24">
       <div class="table-responsive scroll-sm">
           <table class="table bordered-table sm-table mb-0">
               <thead>
                   <tr>
                       <th scope="col">
                           <div class="d-flex align-items-center gap-10">
                               #
                           </div>
                       </th>
                       <th scope="col">Commentateur</th>
                       <th scope="col">Trajet</th>
                       <th scope="col">Note</th>
                       {{-- <th scope="col">Commentaire</th> --}}
                       <th scope="col">Date</th>
                       <th scope="col" class="text-center">Action</th>
                   </tr>
               </thead>
               <tbody>
                   @if ($reviews->isEmpty())
                       <tr>
                           <td colspan="7" class="text-danger text-center">Aucun commentaire enregistré</td>
                       </tr>
                   @else
                       @foreach($reviews as $key => $review)
                       <tr>
                           <td>
                               <div class="d-flex align-items-center gap-10">
                                   {{ $key + 1 }}
                               </div>
                           </td>
                           <td><a href="{{route('users.show',$review->reviewer->email)}}"> {{ $review->reviewer->firstname.' '.$review->reviewer->lastname}}</a></td> <!-- Affiche le nom de l'utilisateur -->
                           <td> <a href="{{ route('rides.show',$review->booking->ride->id) }}">{{ $review->booking->ride->departure }} - {{ $review->booking->ride->destination }}</a></td> <!-- Affiche le trajet -->
                           <td>{{ $review->rating }}</td> <!-- Affiche la note -->
                           <td>{{ \Carbon\Carbon::parse($review->created_at)->locale('fr')->translatedFormat('D, d M Y,H:i')  }}</td>
                           <td class="text-center">
                            <a href="{{ $review->comment != null ? route('reviews.show', $review) : '#' }}"
                                class="btn btn-primary text-sm"
                                {{ $review->comment == null ? 'onclick="event.preventDefault();"' : '' }}>
                                 Lire le commentaire
                             </a>
                           </td>
                       </tr>
                       @endforeach
                   @endif
               </tbody>
           </table>
           @if (!$reviews->isEmpty())
                  {{-- pagination --}}
               <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>Affichage  {{ $reviews->firstItem() }} de {{ $reviews->lastItem() }} a
                    {{ $reviews->total() }} entrées</span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($reviews->onFirstPage())
                        <li class="page-item disabled">
                            <span
                                class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $reviews->previousPageUrl() }}">
                                <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($reviews->links()->elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled"><span
                                    class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $reviews->currentPage())
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
                    @if ($reviews->hasMorePages())
                        <li class="page-item">
                            <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                href="{{ $reviews->nextPageUrl() }}">
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
   <!-- / Content -->
</div>

@endsection
