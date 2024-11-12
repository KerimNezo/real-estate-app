<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite(['resources/js/app.js', 'resources/css/app.css'])

        <title>{{ $title ?? 'Laravel'}}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- ChartistJS -->
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>

        <!-- Leafletjs map -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    </head>
    <body class="font-sans antialiased dark:bg-gray-900 dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50">
            <div class="relative flex flex-col items-center justify-center min-h-screen ">
                <div class="relative w-full px-0">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>

<!-- Layout za obicnog korisnika page -->
