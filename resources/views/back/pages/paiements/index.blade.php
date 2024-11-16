@extends('back.layouts.master')
@section('title', 'Liste des Paiements ')
@section('content')

    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <h5 class="card-title mb-0">Liste des Paiements</h5>
            <div class="col-4">
                <select name="type_id" id="type_payment_filter" class="form-select form-select-sm">
                    <option value="">Tout</option>
                    @foreach ($typepayments as $typepayment)
                        <option value="{{ $typepayment->id }}"
                            {{ request('type_id') == $typepayment->id ? 'selected' : '' }}>
                            {{ $typepayment->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Content -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
              @include('back.pages.paiements.table', ['payments' => $payments])


              @if (!$payments->isEmpty())
              {{-- pagination --}}
              <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                  <span>Affichage {{ $payments->firstItem() }} à {{ $payments->lastItem() }} de {{ $payments->total() }} paiements</span>
                  <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                      {{-- Previous Page Link --}}
                      @if ($payments->onFirstPage())
                          <li class="page-item disabled">
                              <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
                                  <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                              </span>
                          </li>
                      @else
                          <li class="page-item">
                              <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                 href="{{ $payments->previousPageUrl() }}">
                                  <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                              </a>
                          </li>
                      @endif

                      {{-- Pagination Elements --}}
                      @foreach ($payments->links()->elements as $element)
                          @if (is_string($element))
                              <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                          @endif
                          @if (is_array($element))
                              @foreach ($element as $page => $url)
                                  @if ($page == $payments->currentPage())
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

                      {{-- Next Page Link --}}
                      @if ($payments->hasMorePages())
                          <li class="page-item">
                              <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                                 href="{{ $payments->nextPageUrl() }}">
                                  <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                              </a>
                          </li>
                      @else
                          <li class="page-item disabled">
                              <span class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px">
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
         const typePaymentFilter = document.getElementById('type_payment_filter');

         typePaymentFilter.addEventListener('change', function () {
             const typeId = this.value;

             fetch(`{{ route("payments.filterByType") }}?type_id=${typeId}`, {
                 method: 'GET',
             })
             .then(response => {
                 if (!response.ok) {
                     throw new Error('Erreur de requête');
                 }
                 return response.text();
             })
             .then(html => {
                 document.querySelector('table').innerHTML = html;
             })
             .catch(error => {
                 console.error('Erreur:', error);
             });
         });
     });

     </script>

@endsection
