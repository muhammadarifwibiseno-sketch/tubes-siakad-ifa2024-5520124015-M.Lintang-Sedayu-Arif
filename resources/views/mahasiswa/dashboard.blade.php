<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Mahasiswa') }}
    </x-slot>

    <div class="space-y-6">
        <!-- Welcome Banner -->
        <div class="bg-emerald-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-600/20 relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-2">Selamat datang kembali, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-emerald-100 max-w-xl">Semoga harimu menyenangkan. Berikut adalah ringkasan jadwal perkuliahanmu saat ini.</p>
            </div>
            <!-- Decorative circle -->
            <div class="absolute right-0 top-0 -mt-16 -mr-16 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
        </div>

        <!-- Schedule Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h4 class="text-lg font-semibold text-gray-800">Jadwal Perkuliahan Anda</h4>
                <div class="text-sm text-emerald-600 font-medium bg-emerald-50 px-3 py-1 rounded-full">
                    Semester Ganjil 2026
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 bg-slate-50 text-slate-500 font-semibold text-xs uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-4 bg-slate-50 text-slate-500 font-semibold text-xs uppercase tracking-wider">Dosen</th>
                            <th class="px-6 py-4 bg-slate-50 text-slate-500 font-semibold text-xs uppercase tracking-wider text-center">Kelas</th>
                            <th class="px-6 py-4 bg-slate-50 text-slate-500 font-semibold text-xs uppercase tracking-wider text-center">Hari</th>
                            <th class="px-6 py-4 bg-slate-50 text-slate-500 font-semibold text-xs uppercase tracking-wider text-center">Jam</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($jadwals as $j)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $j->matakuliah->nama_matakuliah }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">
                                            {{ substr($j->dosen->nama, 0, 1) }}
                                        </div>
                                        {{ $j->dosen->nama }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $j->kelas }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-gray-700">
                                    {{ $j->hari }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ date('H:i', strtotime($j->jam)) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                        <p class="text-base font-medium text-gray-900 mb-1">Belum ada jadwal</p>
                                        <p class="text-sm">Anda belum mengambil KRS atau jadwal belum diatur.</p>
                                        <a href="{{ route('mahasiswa.krs.index') }}" class="mt-4 px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 transition-colors">Isi KRS Sekarang</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
