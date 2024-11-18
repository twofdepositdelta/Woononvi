@extends('front.layouts.master')
@section('title', 'Nos blos & Infos')
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
<div class="blog-area py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline"><i class="flaticon-drive"></i> Notre Blog</span>
                    <h2 class="site-title">Dernières Nouvelles & Blog</h2>
                    <div class="heading-divider"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($actualities as $actuality)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="blog-item-img">
                            <!-- Remplacez l'image statique par l'URL de l'image dynamique -->
                            <img src="{{ asset($actuality->image_url) }}" alt="Thumb">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <!-- Utilisez la date de publication de l'actualité -->
                                    <li><a href="{{ route('actuality.show', $actuality->slug) }}"><i class="far fa-calendar-alt"></i> {{ $actuality->created_at->format('F d, Y') }}</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <!-- Titre de l'actualité -->
                                <a href="{{ route('actuality.show', $actuality->slug) }}">{{ $actuality->titre }}</a>
                            </h4>
                            <p>{{ \Str::limit($actuality->description, 100) }}</p> <!-- Description limitée à 100 caractères -->
                            <a class="theme-btn" href="{{ route('actuality.show', $actuality->slug) }}">Lire plus<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-area">
            <div aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Lien de la page précédente -->
                    <li class="page-item">
                        <a class="page-link" href="{{ $actualities->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>
                        </a>
                    </li>

                    <!-- Affichage des numéros de page -->
                    @for ($i = 1; $i <= $actualities->lastPage(); $i++)
                        <li class="page-item {{ $i == $actualities->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $actualities->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Lien de la page suivante -->
                    <li class="page-item">
                        <a class="page-link" href="{{ $actualities->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


    </div>
</div>
@endsection
