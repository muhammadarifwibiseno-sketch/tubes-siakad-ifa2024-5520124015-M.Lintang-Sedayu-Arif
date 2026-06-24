<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10">
                    <svg class="w-48 h-48 -mr-10 -mt-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-1">Selamat datang, {{ optional($dosen)->nama ?? Auth::user()->name }}</h3>
                    <p class="text-emerald-100 mb-4">NIDN: {{ Auth::user()->nidn }}</p>
                    <div class="flex gap-4">
                        <div class="bg-white/20 rounded-lg px-4 py-2 backdrop-blur-sm border border-white/10">
                            <span class="block text-xs text-emerald-100">Total Kelas Ajar</span>
                            <span class="text-xl font-bold">{{ $totalJadwal }}</span>
                        </div>
                        <div class="bg-white/20 rounded-lg px-4 py-2 backdrop-blur-sm border border-white/10">
                            <span class="block text-xs text-emerald-100">Mahasiswa Bimbingan Wali</span>
                            <span class="text-xl font-bold">{{ $totalBimbingan }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Hari Ini -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-green-100 rounded-lg text-green-700 shadow-sm border border-green-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Jadwal Hari Ini ({{ $hariIni }})</h4>
                            <p class="text-xs text-gray-500">Daftar kelas yang harus Anda ajar hari ini</p>
                        </div>
                    </div>
                    <a href="{{ route('dosen.jadwal.index') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800 transition-colors">Lihat Semua Jadwal &rarr;</a>
                </div>
                
                <div class="p-0">
                    @forelse($jadwalsHariIni as $j)
                        <div class="flex items-center justify-between p-6 border-b border-gray-100 hover:bg-gray-50 transition-colors last:border-0">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center text-emerald-600 font-bold shadow-sm border border-emerald-200">
                                    {{ substr(optional($j->matakuliah)->nama_matakuliah ?? 'M', 0, 1) }}
                                </div>
                                <div>
                                    <h5 class="text-md font-bold text-gray-900">{{ optional($j->matakuliah)->nama_matakuliah ?? 'Mata Kuliah Tidak Ditemukan' }}</h5>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Kelas <span class="font-bold text-emerald-600">{{ $j->kelas }}</span> 
                                        <span class="text-xs text-gray-400">({{ $j->angkatan ?? '-' }})</span> &bull; 
                                        {{ date('H:i', strtotime($j->jam)) }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('dosen.absensi.index', $j->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm font-bold rounded-lg shadow hover:bg-emerald-700 transition-all focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                Buka Kelas
                            </a>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-50 text-green-500 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-lg font-bold text-gray-700">Tidak Ada Jadwal Mengajar Hari Ini</p>
                            <p class="text-sm text-gray-500 mt-1">Anda bisa bersantai atau memeriksa tugas mahasiswa.</p>
                        </div>
                    @endforelse
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
