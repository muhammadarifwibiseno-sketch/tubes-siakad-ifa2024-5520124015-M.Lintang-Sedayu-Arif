<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Absensi Pertemuan {{ $absensi->pertemuan_ke }}</h2>
    </x-slot>

    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-start mb-6">
            <div class="p-4 bg-emerald-50 rounded-lg border border-emerald-100 flex-1 mr-4">
                <h3 class="font-bold text-emerald-800">{{ $jadwal->matakuliah->nama_matakuliah }} (Kelas {{ $jadwal->kelas }})</h3>
                <p class="text-sm text-emerald-600">Tanggal: {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</p>
                <p class="text-sm text-emerald-600">Waktu: {{ date('H:i', strtotime($absensi->waktu_mulai)) }} - {{ date('H:i', strtotime($absensi->waktu_selesai)) }}</p>
            </div>
            <a href="{{ route('dosen.absensi.index', $jadwal->id) }}" class="inline-flex items-center gap-1 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-50 shadow-sm transition-all h-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
        @endif

        <h4 class="text-lg font-semibold mb-4 text-gray-800">Daftar Kehadiran Mahasiswa</h4>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-3 border">NPM</th>
                        <th class="p-3 border">Nama Mahasiswa</th>
                        <th class="p-3 border text-center">Waktu Absen</th>
                        <th class="p-3 border text-center">Status Saat Ini</th>
                        <th class="p-3 border text-center">Ubah Status Manually</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kehadirans as $k)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $k->mahasiswa->npm ?? $k->npm }}</td>
                            <td class="p-3 border font-medium">{{ $k->mahasiswa->nama ?? 'Unknown' }}</td>
                            <td class="p-3 border text-center text-sm text-gray-500">
                                {{ $k->waktu_absen ? \Carbon\Carbon::parse($k->waktu_absen)->format('H:i:s') : '-' }}
                            </td>
                            <td class="p-3 border text-center">
                                @php
                                    $color = match($k->status) {
                                        'Hadir' => 'bg-green-100 text-green-800',
                                        'Izin' => 'bg-blue-100 text-blue-800',
                                        'Sakit' => 'bg-yellow-100 text-yellow-800',
                                        default => 'bg-red-100 text-red-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded text-xs font-bold {{ $color }}">{{ $k->status }}</span>
                            </td>
                            <td class="p-3 border">
                                <form action="{{ route('dosen.absensi.update_status', ['jadwal' => $jadwal->id, 'absensi' => $absensi->id, 'kehadiran' => $k->id]) }}" method="POST" class="flex items-center justify-center gap-2">
                                    @csrf
                                    <select name="status" class="text-sm border-gray-300 rounded focus:border-emerald-500 focus:ring-emerald-500 py-1">
                                        <option value="Hadir" {{ $k->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Izin" {{ $k->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="Sakit" {{ $k->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="Alpa" {{ $k->status == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                                    </select>
                                    <button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-emerald-700 shadow-sm transition-colors">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">Tidak ada mahasiswa yang terdaftar di kelas ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div></div></div>
</x-app-layout>
