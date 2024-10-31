<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'PropertyApp' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen bg-gray-100 pt-[30%] sm:justify-center sm:pt-0 dark:bg-gray-900">
            <div>
                <a href="/" >
                    <img src={{ ('photos/icons/logo1.svg')}} alt="alt" class="rounded-[5px] sm:h-[80px] h-[60px] sm:pt-0 mt-8">
                </a>
            </div>

            <div class="w-[80%] sm:w-[35%] mt-10 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
