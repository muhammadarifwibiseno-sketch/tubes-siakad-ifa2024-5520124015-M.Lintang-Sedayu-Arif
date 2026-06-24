<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Absensi: {{ $jadwal->matakuliah->nama_matakuliah }} (Kelas {{ $jadwal->kelas }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-bold">Daftar Pertemuan</h3>
                            <p class="text-sm text-gray-500">Angkatan {{ $jadwal->angkatan ?? '-' }} - {{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam)) }}</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('dosen.dashboard') }}" class="inline-flex items-center gap-1 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-50 shadow-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Kembali
                            </a>
                            <a href="{{ route('dosen.absensi.create', $jadwal->id) }}" class="inline-flex items-center gap-1 bg-emerald-600 text-white px-4 py-2 rounded-lg font-bold text-sm shadow-md hover:bg-emerald-700 hover:shadow-lg transition-all focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Buat Sesi Absensi
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="p-3 border">Pertemuan Ke</th>
                                    <th class="p-3 border">Tanggal</th>
                                    <th class="p-3 border">Waktu</th>
                                    <th class="p-3 border text-center">Status Mahasiswa</th>
                                    <th class="p-3 border text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensis as $absensi)
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-3 border text-center font-bold">{{ $absensi->pertemuan_ke }}</td>
                                        <td class="p-3 border">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                                        <td class="p-3 border">{{ date('H:i', strtotime($absensi->waktu_mulai)) }} - {{ date('H:i', strtotime($absensi->waktu_selesai)) }}</td>
                                        <td class="p-3 border text-center">
                                            @php
                                                $hadir = $absensi->kehadirans->where('status', 'Hadir')->count();
                                                $total = $absensi->kehadirans->count();
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">
                                                {{ $hadir }} / {{ $total }} Hadir
                                            </span>
                                        </td>
                                        <td class="p-3 border text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('dosen.absensi.show', ['jadwal' => $jadwal->id, 'absensi' => $absensi->id]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-bold rounded shadow-sm hover:bg-blue-200 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    Lihat & Kelola
                                                </a>
                                                <a href="{{ route('dosen.absensi.edit', ['jadwal' => $jadwal->id, 'absensi' => $absensi->id]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-100 text-yellow-700 text-xs font-bold rounded shadow-sm hover:bg-yellow-200 transition-colors" title="Edit Jadwal">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('dosen.absensi.destroy', ['jadwal' => $jadwal->id, 'absensi' => $absensi->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi absensi ini beserta seluruh data kehadiran mahasiswanya? Tindakan ini tidak dapat dibatalkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 text-xs font-bold rounded shadow-sm hover:bg-red-200 transition-colors" title="Hapus Jadwal">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-gray-500">
                                            Belum ada sesi absensi yang dibuat untuk kelas ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
