@extends('front.layouts.master')

@section('title', 'Accueil')

@section('customCSS')
<style>
    .testimonial-single {
        min-height: 370px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .blog-item-img img {
        width: 100%;
        min-height: 200px;
        object-fit: cover; /* pour que l'image garde ses proportions */
    }
</style>
@endsection

@section('content')

    @include('front.pages.includes._feature-area')
    @include('front.pages.includes._counter-area')
    {{-- taxi-rate --}}
    @include('front.pages.includes._choose-area')
    {{-- team-area --}}

    @include('front.pages.includes._faq-area')
    @include('front.pages.includes._testimonial-area')

    @include('front.pages.includes._blog-area')
    {{-- @include('front.pages.includes._partner-area') --}}
@endsection
