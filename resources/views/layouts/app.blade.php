<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EkstraKita') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#F8F9FA]">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between hidden md:flex fixed h-full z-10">
                <div>
                    <!-- Logo -->
                    <div class="h-20 flex items-center px-6 border-b border-transparent mt-2">
                        <div class="w-10 h-10 bg-[#1e3a8a] text-white rounded-xl flex items-center justify-center font-bold text-xl mr-3">
                            E
                        </div>
                        <span class="text-xl font-bold text-gray-900">EkstraKita</span>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="mt-6 px-4 space-y-1">
                        @php
                            $dashboardRoute = strtolower(Auth::user()->role) . '.dashboard';
                            $exploreRoute = Auth::user()->role === 'Siswa' ? 'siswa.explore' : '#';
                            $pendaftaranRoute = Auth::user()->role === 'Siswa' ? 'siswa.pendaftaran' : '#';
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('*.dashboard') ? 'bg-[#203a7a] text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Home
                        </a>
                        <a href="{{ Auth::user()->role === 'Siswa' ? route('siswa.explore') : '#' }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('*.explore') ? 'bg-[#203a7a] text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Explore
                        </a>
                        @if(Auth::user()->role === 'Siswa')
                        <a href="{{ route('siswa.pendaftaran') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('siswa.pendaftaran') ? 'bg-[#203a7a] text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Pendaftaran
                        </a>
                        @endif
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Schedule
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            Notifications
                        </a>
                        <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('profile.*') ? 'bg-[#203a7a] text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>

                        @if(Auth::user()->role === 'Admin' || Auth::user()->role === 'Pembina')
                        <a href="{{ route('attendance.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('attendance.*') ? 'bg-[#203a7a] text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Attendance
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Kelola Kegiatan
                        </a>
                        @endif
                    </nav>
                </div>

                <!-- User Info Profile -->
                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <div class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg" onclick="document.getElementById('logout-form').submit();">
                            <div class="w-10 h-10 rounded-full bg-[#1e3a8a] text-white flex items-center justify-center font-bold mr-3">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->role }} - {{ Auth::user()->nip_nis ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 md:ml-64 p-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
