<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Header Section -->
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Formulir Pendaftaran</h1>
            <p class="text-gray-500">Isi berkas pendaftaran kegiatan pilihanmu dengan benar</p>
        </div>

        <!-- Success or Error Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card Section -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] px-6 py-10 md:px-16 md:py-12">
            
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Pendaftaran Kegiatan</h2>
                <p class="text-sm text-gray-500">Aplikasi pendaftaran siswa EkstraKita</p>
            </div>

            <form action="{{ route('siswa.pendaftaran.store') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Nama Lengkap</label>
                    <input type="text" value="{{ $user->name }}" readonly class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:ring-0 cursor-not-allowed">
                </div>

                <!-- NIS Siswa -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">NIS Siswa</label>
                    <input type="text" value="{{ $user->nip_nis ?? 'Belum Diatur (Silakan update di Profil)' }}" readonly class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:ring-0 cursor-not-allowed">
                </div>

                <!-- Rombel -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Rombel</label>
                    <div class="relative">
                        <select name="rombel" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 focus:ring-[#203a7a] focus:border-[#203a7a] appearance-none cursor-pointer">
                            @if($user->rombel)
                                <option value="{{ $user->rombel }}">{{ $user->rombel }}</option>
                            @else
                                <option value="">Pilih Rombel</option>
                                <option value="PPLG XI-1">PPLG XI-1</option>
                                <option value="PPLG XI-2">PPLG XI-2</option>
                                <option value="PPLG XI-3">PPLG XI-3</option>
                                <option value="PPLG XI-4">PPLG XI-4</option>
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan yang Dipilih -->
                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Kegiatan yang Dipilih</label>
                    <div class="relative">
                        <select name="ekskul_id" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 focus:ring-[#203a7a] focus:border-[#203a7a] appearance-none cursor-pointer">
                            <option value="">Pilih Kegiatan...</option>
                            @foreach($ekskuls as $ekskul)
                                <option value="{{ $ekskul->id }}" {{ request('ekskul_id') == $ekskul->id ? 'selected' : '' }}>
                                    {{ $ekskul->kategori }} - {{ $ekskul->nama_ekskul }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Checkbox Persetujuan -->
                <div class="flex items-start mb-8">
                    <div class="flex items-center h-5">
                        <input id="persetujuan" name="persetujuan" type="checkbox" required class="w-5 h-5 bg-white border-gray-300 rounded text-[#203a7a] focus:ring-[#203a7a] cursor-pointer">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="persetujuan" class="font-medium text-gray-500 cursor-pointer">Saya menyetujui jadwal yang ditentukan & berkomitmen untuk aktif menghadiri sesi kegiatan berkala.</label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col space-y-3">
                    <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#203a7a] hover:bg-[#1a2f63] transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#203a7a]">
                        Konfirmasi Pendaftaran
                    </button>
                    <a href="{{ route('siswa.explore') }}" class="w-full flex justify-center items-center py-3.5 px-4 border border-gray-200 rounded-xl shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 transition focus:outline-none">
                        Batalkan
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
