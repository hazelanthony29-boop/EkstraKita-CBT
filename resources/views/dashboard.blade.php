<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">{{ $title ?? 'Pilih Kegiatanmu!' }}</h1>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari ekstrakurikuler" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#203a7a] focus:border-[#203a7a] w-64 text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <button class="p-2 border border-gray-300 rounded-lg bg-white hover:bg-gray-50">
                <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex space-x-4 mb-6">
        <button class="px-6 py-2 bg-[#203a7a] text-white text-sm font-medium rounded-full">Semua</button>
        <button class="px-6 py-2 bg-white text-gray-600 border border-gray-200 text-sm font-medium rounded-full hover:bg-gray-50">Ekstrakurikuler</button>
        <button class="px-6 py-2 bg-white text-gray-600 border border-gray-200 text-sm font-medium rounded-full hover:bg-gray-50">Seni & Budaya</button>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <p class="text-gray-500">Fitur Kelola Master Data & Jadwal akan diimplementasikan pada Phase berikutnya.</p>
    </div>
</x-app-layout>
