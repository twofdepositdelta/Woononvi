@extends('front.layouts.master')
@section('title', 'Détails blog'. $actuality->name)

@section('content')
<div class="blog-single-area pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-single-wrapper">
                    <div class="blog-single-content">
                        <div class="blog-thumb-img">
                            <img src="{{ asset($actuality->image_url) }}" alt="thumb">
                        </div>
                        <div class="blog-info">
                            <div class="blog-meta">
                                <div class="blog-meta-left">
                                    <ul>
                                        <li><i class="far fa-calendar-alt"></i>
                                            {{ $actuality->created_at->format('F d,Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-details">
                                <h3 class="blog-details-title mb-20"> <a
                                        href="{{ route('actuality.show', $actuality->slug) }}">{{ $actuality->titre
                                        }}</a></h3>
                                <p class="mb-10">
                                    {!! $actuality->description !!}
                                </p>

                                <blockquote class="blockqoute">
                                    La lecture des articles est essentielle pour rester informé et acquérir de nouvelles connaissances.
                                    Prendre le temps de lire permet de mieux comprendre le contenu, d'approfondir les sujets importants et
                                    de développer une perspective enrichie.
                                    <h6 class="blockqoute-author">{{ FrontHelper::getAppName() }}</h6>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar">
                    <div class="widget recent-post">
                        <h5 class="widget-title">Récents Postes</h5>
                        @foreach($otherNews as $otherNew)
                            <div class="recent-post-single">
                                <div class="recent-post-img">
                                    <img src="{{ asset($otherNew->image_url) }}" alt="thumb">
                                </div>
                                <div class="recent-post-bio">
                                    <h6>
                                        <a href="{{ route('actuality.show', $otherNew->slug) }}">{{ $actuality->titre }}</a>
                                    </h6>
                                    <span><i class="far fa-clock"></i>{{ $otherNew->created_at->format('F d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
