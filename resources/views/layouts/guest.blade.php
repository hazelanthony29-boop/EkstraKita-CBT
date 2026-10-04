<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F8F9FA]">
            <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.05)] overflow-hidden sm:rounded-2xl text-center">
                <div class="flex justify-center items-center mb-6">
                    <div class="w-10 h-10 bg-[#1e3a8a] text-white rounded-xl flex items-center justify-center font-bold text-xl mr-3">
                        E
                    </div>
                    <span class="text-2xl font-bold text-gray-900">EkstraKita</span>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
