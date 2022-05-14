<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/4d8e7503ba.js" crossorigin="anonymous"></script>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>

        <!-- PWA  -->
        <meta name="theme-color" content="#dc3545"/>
        <link rel="apple-touch-icon" href="{{ asset('images/gas-station.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

    </body>
</html>

        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
            // if ('serviceWorker' in navigator) {
            // // Do a one-off check to see if a service worker's in control.
            // if (navigator.serviceWorker.controller) {
            //     console.log(`This page is currently controlled by: ${navigator.serviceWorker.controller}`);
            // } else {
            //     navigator.serviceWorker.register("/sw.js").then(function (reg) {
            //         console.log("Service worker has been registered for scope: " + reg.scope);
            //     });
            // }
            // } else {
            // console.log('Service workers are not supported.');
            // }
        </script>