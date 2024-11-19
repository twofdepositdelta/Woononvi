@extends('front.layouts.master')

@section('title', 'Accueil')
@section('content')

    @include('front.pages.includes.about._section_1')
    @include('front.pages.includes.about._section_2')
    @include('front.pages.includes._download-area')
    @include('front.pages.includes.about._section_3')
    @include('front.pages.includes._counter-area')
    @include('front.pages.includes._testimonial-area')
@endsection
