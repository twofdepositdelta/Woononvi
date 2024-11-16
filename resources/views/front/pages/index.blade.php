@extends('front.layouts.master')

@section('title', 'Accueil')
@section('content')

    @include('front.pages.includes._feature-area')
    @include('front.pages.includes._counter-area')
    {{-- taxi-rate --}}
    @include('front.pages.includes._choose-area')
    {{-- team-area --}}

    @include('front.pages.includes._faq-area')
    @include('front.pages.includes._testimonial-area')

    @include('front.pages.includes._blog-area')
    @include('front.pages.includes._partner-area')
@endsection
