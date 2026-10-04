<x-app-layout>
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-4 md:mb-0">Pilih Kegiatanmu!</h1>
        
        <div class="flex items-center w-full md:w-auto">
            <form action="{{ route('siswa.explore') }}" method="GET" class="relative w-full md:w-80 mr-3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ekstrakurikuler" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-[#203a7a] focus:border-[#203a7a] text-sm placeholder-gray-400">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
            </form>
            
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex-shrink-0 w-10 h-10 border border-gray-200 rounded-lg bg-white flex items-center justify-center text-gray-600 hover:bg-gray-50 transition {{ request('sort') ? 'ring-2 ring-[#203a7a] border-transparent' : '' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="{{ route('siswa.explore', array_merge(request()->query(), ['sort' => 'asc'])) }}" class="{{ request('sort') === 'asc' ? 'font-bold text-[#203a7a]' : '' }}">
                        Urutkan A-Z
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('siswa.explore', array_merge(request()->query(), ['sort' => 'desc'])) }}" class="{{ request('sort') === 'desc' ? 'font-bold text-[#203a7a]' : '' }}">
                        Urutkan Z-A
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <!-- Filter Chips -->
    <div class="flex space-x-3 mb-8 overflow-x-auto pb-2">
        <a href="{{ route('siswa.explore', array_merge(request()->query(), ['kategori' => null])) }}" class="px-5 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-colors {{ !request('kategori') ? 'bg-[#203a7a] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Semua
        </a>
        <a href="{{ route('siswa.explore', array_merge(request()->query(), ['kategori' => 'Ekstrakurikuler'])) }}" class="px-5 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-colors {{ request('kategori') == 'Ekstrakurikuler' ? 'bg-[#203a7a] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Ekstrakurikuler
        </a>
        <a href="{{ route('siswa.explore', array_merge(request()->query(), ['kategori' => 'Seni & Budaya'])) }}" class="px-5 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-colors {{ request('kategori') == 'Seni & Budaya' ? 'bg-[#203a7a] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Seni & Budaya
        </a>
    </div>

    <!-- Cards Grid -->
    @if($ekstrakurikulers->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($ekstrakurikulers as $ekskul)
            <a href="{{ route('siswa.pendaftaran', ['ekskul_id' => $ekskul->id]) }}" class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full cursor-pointer group relative">
                <!-- Image -->
                <div class="h-48 bg-gray-100 w-full relative overflow-hidden">
                    <img src="{{ $ekskul->logo ?: 'data:image/jpeg;base64,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' }}" alt="{{ $ekskul->nama_ekskul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                
                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <div>
                        @if($ekskul->kategori == 'Ekstrakurikuler')
                            <span class="inline-block px-3 py-1 bg-blue-50 text-[#203a7a] text-xs font-bold rounded-lg mb-4">Ekstrakurikuler</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-purple-50 text-purple-700 text-xs font-bold rounded-lg mb-4">Seni & Budaya</span>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $ekskul->nama_ekskul }}</h3>
                    <p class="text-sm text-gray-500 mb-6 font-medium">{{ $ekskul->jadwal_summary }}</p>
                    
                    <div class="mt-auto flex items-center text-sm text-gray-500 font-medium">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ $ekskul->pendaftarans_count }} Anggota
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada kegiatan ditemukan</h3>
            <p class="text-gray-500">Coba sesuaikan filter atau pencarianmu.</p>
        </div>
    @endif
</x-app-layout>
