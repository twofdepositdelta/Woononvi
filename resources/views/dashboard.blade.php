@extends('back.layouts.master')
@section('title', 'Tableau de bord')
@section('content')
<div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    @include('back.pages.statistics.users-statistics')
    @include('back.pages.statistics.rides-statistics')
    @include('back.pages.statistics.amount-statistics')
</div>
@endsection
