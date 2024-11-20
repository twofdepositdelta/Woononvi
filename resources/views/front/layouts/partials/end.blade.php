<a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const preloader = document.querySelector('.preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
            }, 1000); // Masque après 1 seconde
        });
    </script>

    <script data-cfasync="false" src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/counter-up.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/js/main.js') }}?v={{ uniqid() }}"></script>
    <script src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/assets/js/contact-form.js')}}"></script>
    @yield('customJS')
</body>

</html>
