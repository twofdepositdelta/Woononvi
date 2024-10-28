<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wowdash - Bootstrap 5 Admin Dashboard HTML Template</title>
    <link rel="icon" type="image/png" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/favicon.png') }}" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/remixicon.css') }}">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/bootstrap.min.css') }}">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/apexcharts.css') }}">
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/dataTables.min.css') }}">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/editor-katex.min.css') }}">
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/editor.atom-one-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/editor.quill.snow.css') }}">
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/flatpickr.min.css') }}">
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/full-calendar.css') }}">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/jquery-jvectormap-2.0.5.css') }}">
    <!-- Popup css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/magnific-popup.css') }}">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/slick.css') }}">
    <!-- prism css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/prism.css') }}">
    <!-- file upload css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/file-upload.css') }}">

    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/lib/audioplayer.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.2.2/css/flag-icons.min.css">
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl0wex-ScEv-bJH9Tt9JLsKK4B0nbHQP8&libraries=places"></script>
    <!-- Quill CSS (Snow Theme) -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('customCSS')
</head>

