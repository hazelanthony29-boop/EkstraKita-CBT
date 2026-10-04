<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EkstraKita - Onboarding</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-[#1e3a8a] min-h-screen">

    <!-- SPLASH SCREEN -->
    <div class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#1e3a8a] transition-opacity duration-700">
        <div class="flex flex-col items-center animate-pulse">
            <!-- Logo Icon -->
            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-lg mb-6">
                <span class="text-4xl font-extrabold text-[#1e3a8a]">E<span class="text-[#f97316]">.</span></span>
            </div>
            
            <!-- Logo Text -->
            <h1 class="text-3xl font-bold text-white tracking-wide mb-2">EkstraKita</h1>
            
            <!-- Subtitle -->
            <p class="text-blue-200 text-sm font-medium tracking-wider uppercase">Kelola Ekstrakurikuler & Seni Budaya</p>
        </div>
    </div>

    <script>
        // Redirect to login page after 2 seconds
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 2000);
    </script>
</body>
</html>
