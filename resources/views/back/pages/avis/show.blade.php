@extends('back.layouts.master')
@section('title', 'Détails du commentaire')
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <h5 class=" card-title mb-0">Détails du commentaire</h5>
        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>

    <div class="card-body p-24">
        <div class="mb-4">
            <strong>Commentaire :</strong>
            <p>{{ $review->comment }}</p>
        </div>
        <hr>
        <div class="mb-4 mt-4">
            <strong>Commentateur:</strong>
            <p> <a href="{{route('users.show',$review->reviewer->email)}}"> {{ $review->reviewer->firstname.' '.$review->reviewer->lastname}}</a></p>
        </div>

         <div class="mb-4">
            <strong>Trajet :</strong>
            <a href="{{ route('rides.show',$review->booking->ride->numero_ride) }}">{{ $review->booking->ride->start_location_name }} - {{ $review->booking->ride->end_location_name }}
        </div>

        <div class="mb-4">
            <strong>Créateur du trajet :</strong>
            <p>{{ $review->booking->ride->driver->firstname.' '.$review->booking->ride->driver->lastname }}</p>
        </div>

        <div class="mb-4">
            <strong>Note :</strong>
            <p>{{ $review->rating }}</p>
        </div>


        <div class="mb-4">
            <strong>Date de création :</strong>
            <p>{{  \Carbon\Carbon::parse($review->created_at)->locale('fr')->translatedFormat('D, d M Y, H:i') }}</p>
        </div>
    </div>
</div>

@endsection
