@extends('front.layouts.master')
@section('title', 'Foire Aux Questions')
@section('content')

<div class="faq-area py-120">
    <div class="container">
        @foreach ($faqGroups as $index => $group)
            <div class="row mb-5">
                <!-- Alternance des positions image et texte -->
                @if ($index % 2 === 0)
                    <!-- Image à gauche -->
                    <div class="col-lg-6">
                        <div class="faq-right">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline justify-content-start">FAQ</span>
                                <h2 class="site-title my-3">{{ $group->name }}</h2>
                            </div>
                            <p class="about-text"> Voici les questions fréquemment posées pour ce type.</p>
                            <div class="faq-img mt-3">
                                <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/faq/01.jpg') }}" alt="{{ $group->name }}" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion" id="accordion-{{ $group->id }}">
                            @foreach ($group->faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse-{{ $faq->id }}">
                                            <span><i class="far fa-question"></i></span> {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#accordion-{{ $group->id }}">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Image à droite -->
                    <div class="col-lg-6">
                        <div class="accordion" id="accordion-{{ $group->id }}">
                            @foreach ($group->faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse-{{ $faq->id }}">
                                            <span><i class="far fa-question"></i></span> {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#accordion-{{ $group->id }}">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-right">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline justify-content-start">FAQ</span>
                                <h2 class="site-title my-3">{{ $group->name }}</h2>
                            </div>
                            <p class="about-text"> 'Voici les questions fréquemment posées pour ce type.' </p>
                            <div class="faq-img mt-3">
                                <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/faq/01.jpg') }}" alt="{{ $group->name }}" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>





 @endsection
