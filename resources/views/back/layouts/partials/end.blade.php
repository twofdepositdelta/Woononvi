    <!-- Quill JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>

    <!-- jQuery library js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Apex Chart js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/apexcharts.min.js') }}"></script>
    <!-- Data Table js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/dataTables.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- Vector Map js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Popup js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/magnifc-popup.min.js') }}"></script>
    <!-- Slick Slider js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/slick.min.js') }}"></script>
    <!-- prism js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/prism.js') }}"></script>
    <!-- file upload js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/file-upload.js') }}"></script>
    <!-- audioplayer -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/lib/audioplayer.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/app.js') }}"></script>
    <script src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/js/homeFourChart.js')}}"></script>

    <script>
        $('.remove-button').on('click', function() {
            $(this).closest('.alert').addClass('d-none')
        });
    </script>
    <script>
        let table = new DataTable('#dataTable');
    </script>
    @yield('customJS')

