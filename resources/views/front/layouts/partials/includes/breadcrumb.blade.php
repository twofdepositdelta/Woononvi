<div class="site-breadcrumb" style="background: url({{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/breadcrumb/01.jpg') }})">
    <div class="container">
        <h2 class="breadcrumb-title">@yield('title')</h2>
        <ul class="breadcrumb-menu">
            <li><a href="{{ route('index') }}">Citygo</a></li>
            <li class="active">@yield('title')</li>
        </ul>
    </div>
</div>
