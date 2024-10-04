@include('front.layouts.partials.start')


    @include('front.layouts.partials.header')

    @include('front.layouts.partials.sidebar-popup')


    <main class="main">

        @if (Route::currentRouteName() == 'index')
            @include('front.layouts.partials.includes.hero-section')
        @else
            @include('front.layouts.partials.includes.breadcrumb')
        @endif

        @yield('content')

    </main>

    @include('front.layouts.partials.footer')


@include('front.layouts.partials.end')
