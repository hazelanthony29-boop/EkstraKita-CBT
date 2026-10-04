<x-app-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Attendance (Pembina)</h1>
        <p class="text-sm text-gray-500 mt-1">Record student attendance for each extracurricular or arts activity meeting.</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <form method="GET" action="{{ route('attendance.index') }}" id="filter-form" class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
            <div class="flex gap-4 w-full md:w-auto">
                <div class="flex-1 md:w-64">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Extracurricular / Arts Activity</label>
                    <div class="relative">
                        <select name="ekskul_id" onchange="document.getElementById('filter-form').submit();" class="block w-full pl-10 pr-10 py-2.5 text-sm border-gray-300 rounded-lg focus:ring-[#203a7a] focus:border-[#203a7a] appearance-none bg-white">
                            @foreach($ekskuls as $ekskul)
                                <option value="{{ $ekskul->id }}" {{ $selectedEkskulId == $ekskul->id ? 'selected' : '' }}>
                                    {{ $ekskul->nama_ekskul }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-[#203a7a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex-1 md:w-64">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Current Meeting Date</label>
                    <div class="relative">
                        <input type="date" name="date" value="{{ $selectedDate }}" onchange="document.getElementById('filter-form').submit();" class="block w-full pl-10 pr-4 py-2.5 text-sm border-gray-300 rounded-lg focus:ring-[#203a7a] focus:border-[#203a7a]">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-[#203a7a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 text-[#203a7a] px-4 py-2.5 rounded-lg text-sm font-medium flex items-center border border-blue-100">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                {{ $students->count() }} enrolled • Meeting 12
            </div>
        </form>

        <form method="POST" action="{{ route('attendance.store') }}">
            @csrf
            <input type="hidden" name="ekskul_id" value="{{ $selectedEkskulId }}">
            <input type="hidden" name="date" value="{{ $selectedDate }}">

            <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
                <!-- Header -->
                <div class="bg-white px-6 py-4 flex justify-between items-center border-b border-gray-200">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Enrolled Students</h2>
                        <p class="text-xs text-gray-500 mt-1">Choose one attendance status for every student.</p>
                    </div>
                    <div class="flex items-center text-sm font-medium text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100">
                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @php
                            $completed = count($existingAbsensi);
                        @endphp
                        {{ $completed }} of {{ $students->count() }} completed
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-3 font-medium border-b border-gray-200 w-16">Student Photo</th>
                                <th class="px-6 py-3 font-medium border-b border-gray-200">Name</th>
                                <th class="px-6 py-3 font-medium border-b border-gray-200">NIS</th>
                                <th class="px-6 py-3 font-medium border-b border-gray-200">Attendance Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($students as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500 overflow-hidden">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $student->name }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $student->rombel ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 font-medium">
                                    {{ $student->nip_nis }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        @php
                                            $status = $existingAbsensi[$student->id] ?? null;
                                        @endphp
                                        
                                        <label class="relative flex items-center px-4 py-1.5 cursor-pointer">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="Hadir" class="peer sr-only" {{ $status == 'Hadir' ? 'checked' : '' }}>
                                            <div class="absolute inset-0 rounded-md border border-gray-300 peer-checked:bg-blue-100 peer-checked:border-[#203a7a] transition"></div>
                                            <div class="relative w-2.5 h-2.5 rounded-full border border-gray-400 peer-checked:bg-[#203a7a] peer-checked:border-[#203a7a] mr-2 transition z-10"></div>
                                            <div class="relative text-gray-600 peer-checked:text-[#203a7a] text-xs font-medium transition z-10">Hadir</div>
                                        </label>

                                        <label class="relative flex items-center px-4 py-1.5 cursor-pointer">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="Izin" class="peer sr-only" {{ $status == 'Izin' ? 'checked' : '' }}>
                                            <div class="absolute inset-0 rounded-md border border-gray-300 peer-checked:bg-blue-100 peer-checked:border-[#203a7a] transition"></div>
                                            <div class="relative w-2.5 h-2.5 rounded-full border border-gray-400 peer-checked:bg-[#203a7a] peer-checked:border-[#203a7a] mr-2 transition z-10"></div>
                                            <div class="relative text-gray-600 peer-checked:text-[#203a7a] text-xs font-medium transition z-10">Izin</div>
                                        </label>

                                        <label class="relative flex items-center px-4 py-1.5 cursor-pointer">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="Sakit" class="peer sr-only" {{ $status == 'Sakit' ? 'checked' : '' }}>
                                            <div class="absolute inset-0 rounded-md border border-gray-300 peer-checked:bg-blue-100 peer-checked:border-[#203a7a] transition"></div>
                                            <div class="relative w-2.5 h-2.5 rounded-full border border-gray-400 peer-checked:bg-[#203a7a] peer-checked:border-[#203a7a] mr-2 transition z-10"></div>
                                            <div class="relative text-gray-600 peer-checked:text-[#203a7a] text-xs font-medium transition z-10">Sakit</div>
                                        </label>

                                        <label class="relative flex items-center px-4 py-1.5 cursor-pointer">
                                            <input type="radio" name="attendance[{{ $student->id }}]" value="Alpa" class="peer sr-only" {{ $status == 'Alpa' ? 'checked' : '' }}>
                                            <div class="absolute inset-0 rounded-md border border-gray-300 peer-checked:bg-blue-100 peer-checked:border-[#203a7a] transition"></div>
                                            <div class="relative w-2.5 h-2.5 rounded-full border border-gray-400 peer-checked:bg-[#203a7a] peer-checked:border-[#203a7a] mr-2 transition z-10"></div>
                                            <div class="relative text-gray-600 peer-checked:text-[#203a7a] text-xs font-medium transition z-10">Alpa</div>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada siswa yang mendaftar ke ekstrakurikuler ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <p class="text-xs text-gray-500">Changes will be recorded for today's meeting.</p>
                <button type="submit" class="bg-[#203a7a] hover:bg-blue-900 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
