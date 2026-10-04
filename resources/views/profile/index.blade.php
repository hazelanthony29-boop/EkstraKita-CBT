<x-app-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-2">Kelola data diri, pengaturan akun, dan lihat ikhtisar prestasi ekstrakurikuler milikmu</p>
    </div>

    <!-- Big Card Profile Info -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
        <div class="flex items-center mb-8">
            <div class="w-16 h-16 rounded-full bg-[#1e3a8a] text-white flex items-center justify-center font-bold text-2xl mr-4">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $user->role }} 
                    @if($user->role === 'Siswa')
                    • Rombel PPLG XI-4 
                    @endif
                    • {{ $user->role === 'Siswa' ? 'NIS' : 'NIP' }} : {{ $user->nip_nis ?? '-' }}
                </p>
            </div>
        </div>

        @if($user->role === 'Siswa')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- 2 Kegiatan -->
            <div class="border border-gray-200 rounded-lg p-4 text-center">
                <p class="text-xl font-bold text-[#1e3a8a]">2 Kegiatan</p>
                <p class="text-xs text-gray-500 mt-1">Diikuti</p>
            </div>
            <!-- 12 Sesi -->
            <div class="border border-gray-200 rounded-lg p-4 text-center">
                <p class="text-xl font-bold text-[#1e3a8a]">12 Sesi</p>
                <p class="text-xs text-gray-500 mt-1">Kehadiran</p>
            </div>
            <!-- 2 Prestasi -->
            <div class="border border-gray-200 rounded-lg p-4 text-center">
                <p class="text-xl font-bold text-[#1e3a8a]">2 Prestasi</p>
                <p class="text-xs text-gray-500 mt-1">Diraih</p>
            </div>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @if($user->role === 'Siswa')
        <!-- Kegiatan yang Diikuti (Left Column) -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4">Kegiatan yang Diikuti</h3>
            
            <div class="space-y-4">
                <div class="bg-white rounded-lg border border-gray-200 p-4 flex items-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-lg mr-4 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1599839619722-39751411ea63?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80')"></div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Badminton</h4>
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-[10px] font-semibold rounded mt-1">Ekstrakurikuler</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-4 flex items-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-lg mr-4 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507676184212-d0330a15233c?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80')"></div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Seni Teater</h4>
                        <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 text-[10px] font-semibold rounded mt-1">Seni & Budaya</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Pengaturan Akun (Right Column or Full Width if not Siswa) -->
        <div class="{{ $user->role === 'Siswa' ? '' : 'col-span-1 md:col-span-2 max-w-2xl' }}">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Pengaturan Akun</h3>
            
            <div class="space-y-3">
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-between bg-white rounded-lg border border-gray-200 p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center text-sm font-medium text-gray-700">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Edit Profil
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="#" class="flex items-center justify-between bg-white rounded-lg border border-gray-200 p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center text-sm font-medium text-gray-700">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Pengaturan Notifikasi
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="#" class="flex items-center justify-between bg-white rounded-lg border border-gray-200 p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center text-sm font-medium text-gray-700">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Riwayat Kegiatan
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="#" class="flex items-center justify-between bg-white rounded-lg border border-gray-200 p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center text-sm font-medium text-gray-700">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Bantuan & Dukungan
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 focus:outline-none transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
