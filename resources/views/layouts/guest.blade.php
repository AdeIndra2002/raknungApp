<!DOCTYPE html>
<html x-data="data" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>

    <style>
        /* Fullscreen background image */
        .background-image {
            position: fixed;
            /* Use fixed to cover the entire viewport */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensure image covers the area */
            z-index: -1;
            /* Place image behind everything */
        }

        .content-container {
            position: relative;
            z-index: 1;
            /* Ensure content is above the background image */
        }

    </style>

</head>
<body>
    <!-- Background Image -->


    <div class="content-container flex items-center min-h-screen p-6 bg-gray-50">
        <img class="background-image blur-sm" src="{{ asset('images/GedungBawaslu.jpg') }}" alt="image description">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
