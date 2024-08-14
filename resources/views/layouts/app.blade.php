<!DOCTYPE html>
<html x-data="data" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logokalsel.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }

    </script>

</head>
<body>
    <div class="flex h-screen bg-gray-200 dark:bg-gray-700" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('layouts.navigation')
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        @include('layouts.navigation-mobile')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.top-menu')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    @if (isset($header))
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-400">
                        {{ $header }}
                    </h2>
                    @endif

                    {{ $slot }}
                </div>
            </main>
            <footer class="bg-gray-300 rounded-2xl shadow-xl dark:bg-gray-800 m-1">
                <div class="w-full max-w-screen-xl mx-auto p-4 md:py-3">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <a href="{{ route('dashboard') }}" class="flex items-center  text-lg font-bold text-gray-700 hover:text-gray-500 dark:text-gray-400 hover:dark:text-gray-600">
                            <img src="{{ asset('images/logokalsel.png') }}" class="h-8" alt="Bawaslu Logo" />
                            <span class="ml-4">BAWASLU</span>
                        </a>
                        <span class="block text-sm text-gray-700 sm:text-center dark:text-gray-400">© 2024 <a href="https://github.com/AdeIndra2002" class="hover:underline">Muhammad Ade Indra Mustafa</a>. All Rights Reserved.</span>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>


</body>
</html>
