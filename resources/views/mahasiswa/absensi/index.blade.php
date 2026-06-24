<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Absensi Kelas</h2>
    </x-slot>

    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-3 border">Tanggal</th>
                        <th class="p-3 border">Mata Kuliah</th>
                        <th class="p-3 border">Dosen</th>
                        <th class="p-3 border text-center">Waktu Mulai - Selesai</th>
                        <th class="p-3 border text-center">Status</th>
                        <th class="p-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kehadirans as $k)
                        @php
                            $absensi = $k->absensi;
                            $now = \Carbon\Carbon::now();
                            $tanggalSekarang = $now->format('Y-m-d');
                            $waktuSekarang = $now->format('H:i:s');
                            
                            $absensiTanggal = \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d');
                            $absensiWaktuMulai = \Carbon\Carbon::parse($absensi->waktu_mulai)->format('H:i:s');
                            $absensiWaktuSelesai = \Carbon\Carbon::parse($absensi->waktu_selesai)->format('H:i:s');
                            
                            $isBuka = ($absensiTanggal == $tanggalSekarang && $waktuSekarang >= $absensiWaktuMulai && $waktuSekarang <= $absensiWaktuSelesai);
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                            <td class="p-3 border">
                                <span class="font-bold block">{{ $absensi->jadwal->matakuliah->nama_matakuliah }}</span>
                                <span class="text-xs text-gray-500">Pertemuan {{ $absensi->pertemuan_ke }} | Kelas {{ $absensi->jadwal->kelas }}</span>
                            </td>
                            <td class="p-3 border">{{ $absensi->jadwal->dosen->nama }}</td>
                            <td class="p-3 border text-center font-mono text-sm">
                                {{ date('H:i', strtotime($absensi->waktu_mulai)) }} - {{ date('H:i', strtotime($absensi->waktu_selesai)) }}
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
                            <td class="p-3 border text-center">
                                @if($k->status == 'Alpa' && $isBuka)
                                    <form action="{{ route('mahasiswa.absensi.store', $k->id) }}" method="POST" class="flex flex-col gap-2">
                                        @csrf
                                        <button type="submit" name="status" value="Hadir" class="inline-flex items-center justify-center gap-1 bg-green-600 text-white px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-green-700 w-full shadow-md hover:shadow-lg transition-all focus:ring-2 focus:ring-green-500 focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Hadir
                                        </button>
                                        <div class="flex gap-2">
                                            <button type="submit" name="status" value="Izin" class="inline-flex items-center justify-center gap-1 bg-blue-600 text-white px-2 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-700 w-full shadow-sm hover:shadow-md transition-all focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                                Izin
                                            </button>
                                            <button type="submit" name="status" value="Sakit" class="inline-flex items-center justify-center gap-1 bg-yellow-500 text-white px-2 py-1.5 rounded-lg text-xs font-bold hover:bg-yellow-600 w-full shadow-sm hover:shadow-md transition-all focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                                                Sakit
                                            </button>
                                        </div>
                                    </form>
                                @elseif($k->status != 'Alpa')
                                    <span class="text-xs text-gray-500 italic">Sudah absen pada {{ date('H:i:s', strtotime($k->waktu_absen)) }}</span>
                                @elseif($absensiTanggal > $tanggalSekarang || ($absensiTanggal == $tanggalSekarang && $waktuSekarang < $absensiWaktuMulai))
                                    <span class="text-xs text-gray-500">Belum Mulai</span>
                                @else
                                    <span class="text-xs text-red-500">Sudah Tutup</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                Tidak ada jadwal absensi yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div></div></div>
</x-app-layout>
