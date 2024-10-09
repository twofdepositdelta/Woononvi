@include('back.layouts.partials.start')

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        @include('back.layouts.partials.header')
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            @include('back.layouts.partials.sidebar')
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">

                @yield('content')

                @include('back.layouts.partials.footer')
            </div>
            <!--end:::Main-->
        </div>
    </div>
</div>

@include('back.layouts.partials.others')

@include('back.layouts.partials.end')