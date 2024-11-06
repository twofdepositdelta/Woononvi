@extends('back.layouts.master')
@section('title', 'Foire Aux Questions')
@section('content')

<div class="card-body bg-base responsive-padding-40-150">
    <div class="row gy-4">
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('faqs.create') }}" class="btn btn-primary">Ajouter une FAQ</a>
        </div>
        <div class="col-lg-4">
            <div class="active-text-tab nav flex-column nav-pills bg-base shadow py-0 px-24 radius-12 border"
                id="v-pills-tab" role="tablist" aria-orientation="vertical">

                <!-- Boucle à travers les types de FAQ -->
                @foreach($faqTypes as $type)
                    <button
                        class="nav-link text-secondary-light fw-semibold text-xl px-0 py-16 border-bottom {{ $loop->first ? 'active' : '' }}"
                        id="v-pills-{{ $type->id }}-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#v-pills-{{ $type->id }}"
                        type="button"
                        role="tab"
                        aria-controls="v-pills-{{ $type->id }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ ucfirst($type->name) }} <!-- Affichage du type (Passager / Conducteur) -->
                    </button>
                @endforeach

            </div>
        </div>
        <div class="col-lg-8">
            <div class="tab-content" id="v-pills-tabContent">

                <!-- Boucle à travers les types de FAQ pour afficher les questions -->
                @foreach($faqTypes as $type)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="v-pills-{{ $type->id }}" role="tabpanel"
                        aria-labelledby="v-pills-{{ $type->id }}-tab" tabindex="0">

                        <div class="accordion" id="accordionExample{{ $type->id }}">
                            @foreach($type->faqs as $faq) <!-- Boucle à travers les FAQ associées à ce type -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button text-primary-light text-xl"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->question }} <!-- Affichage de la question -->
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample{{ $type->id }}">
                                        <div class="accordion-body">
                                            {{ $faq->answer }} <!-- Affichage de la réponse -->
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('faqs.edit', $faq)}}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                            </a>

                                             <!-- Delete -->
                                        <form action="{{ route('faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette faq ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                                <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection
