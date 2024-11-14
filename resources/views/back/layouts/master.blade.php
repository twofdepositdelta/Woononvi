@include('back.layouts.partials.start')

<body>

    @include('back.layouts.partials.sidebar')

    <main class="dashboard-main">

        @include('back.layouts.partials.header')

        <div class="dashboard-main-body">

            @include('back.layouts.partials.includes.breadcrumb')

            @include('back.layouts.partials.includes.alert')

            @yield('content')
        </div>
        @include('back.layouts.partials.footer')
    </main>
    @include('back.layouts.partials.end')
</body>

</html>
