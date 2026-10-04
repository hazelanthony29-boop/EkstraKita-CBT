<x-app-layout>
    <!-- Header -->
    <div class="flex justify-between items-start mb-10">
        <div>
            <h1 class="text-[32px] font-extrabold text-gray-900 flex items-center tracking-tight">
                Halo, {{ explode(' ', $user->name)[0] }}! <span class="ml-2 text-3xl">👋</span>
            </h1>
            <p class="text-sm text-gray-500 mt-2 font-medium">
                {{ $user->rombel ? 'Rombel ' . $user->rombel : 'Rombel belum diatur' }} • NIS {{ $user->nip_nis ?? 'Belum diatur' }}
            </p>
        </div>
        
        <!-- Notification Bell -->
        <button class="w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>
    </div>

    @if($pendaftarans->count() > 0)
        <!-- Populated State (Based on Figma) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column (Kegiatan Berikutnya & Diikuti) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Kegiatan Berikutnya -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Kegiatan Berikutnya</h2>
                    <!-- Placeholder Card based on Figma -->
                    <div class="bg-[#203a7a] rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                        <!-- Decorative bg -->
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
                        <div class="absolute bottom-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full -mr-10 -mb-10"></div>
                        
                        <div class="relative z-10 flex justify-between items-start mb-6">
                            <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm">
                                Ekstrakurikuler
                            </span>
                            <span class="bg-white/10 px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm">
                                Mulai 1 Jam Lagi
                            </span>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-3">Latihan Rutin</h3>
                            <div class="flex items-center text-sm text-blue-100 space-x-6">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Senin, 16:00
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Balai Krida
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan yang Diikuti -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Kegiatan yang Diikuti</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($pendaftarans as $pendaftaran)
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition cursor-pointer">
                            <div class="h-32 bg-gray-200 relative">
                                <!-- Placeholder Image -->
                                <div class="absolute inset-0 bg-gradient-to-tr from-[#203a7a]/80 to-blue-400 mix-blend-multiply"></div>
                                <img src="https://images.unsplash.com/photo-1542382103-60563faedec0?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Activity">
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900">{{ $pendaftaran->ekstrakurikuler->nama_ekskul }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column (Jadwal & Pengumuman) -->
            <div class="space-y-8">
                <!-- Jadwal Hari Ini -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Jadwal Hari Ini</h2>
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center">
                        <div class="bg-blue-50 text-[#203a7a] font-bold px-4 py-2 rounded-xl text-sm mr-4">
                            16:00
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Ekstrakurikuler Badminton</h4>
                            <p class="text-xs text-gray-500 mt-1">Balai Krida • Pak Ferry</p>
                        </div>
                    </div>
                </div>

                <!-- Pengumuman Penting -->
                <div>
                    <div class="bg-[#f5f3ff] border border-[#ddd6fe] rounded-2xl p-5 relative overflow-hidden">
                        <div class="flex items-start">
                            <div class="bg-white p-2 rounded-full shadow-sm text-purple-600 mr-4 shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-purple-900 text-sm mb-1">Pengumuman Penting</h4>
                                <p class="text-xs text-purple-700">Minggu depan akan ada penilaian mingguan!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty State (User Request) -->
        <div class="bg-white border border-gray-100 rounded-3xl shadow-sm p-10 md:p-16 flex flex-col items-center justify-center text-center mt-6">
            <!-- Illustration Placeholder -->
            <div class="w-48 h-48 bg-blue-50 rounded-full flex items-center justify-center mb-8 relative">
                <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-20"></div>
                <svg class="w-24 h-24 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>

            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">Kamu Belum Mengikuti Kegiatan</h2>
            <p class="text-gray-500 text-base md:text-lg max-w-xl mx-auto mb-10 leading-relaxed">
                Halo! Kamu saat ini belum mendaftar Ekstrakurikuler atau Seni Budaya apapun. Ayo eksplorasi berbagai kegiatan seru dan kembangkan bakatmu di EkstraKita!
            </p>

            <a href="#" class="inline-flex items-center justify-center px-8 py-3.5 bg-[#203a7a] hover:bg-[#1a2f63] text-white font-semibold rounded-xl transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 focus:ring-2 focus:ring-offset-2 focus:ring-[#203a7a]">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Jelajahi Kegiatan
            </a>
        </div>
    @endif

</x-app-layout>
