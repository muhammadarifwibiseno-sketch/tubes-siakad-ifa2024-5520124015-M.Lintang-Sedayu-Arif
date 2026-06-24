<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Sesi Absensi</h2>
    </x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        
        <div class="mb-6 p-4 bg-emerald-50 rounded-lg border border-emerald-100">
            <h3 class="font-bold text-emerald-800">{{ $jadwal->matakuliah->nama_matakuliah }}</h3>
            <p class="text-sm text-emerald-600">Kelas: {{ $jadwal->kelas }} | Angkatan: {{ $jadwal->angkatan ?? '-' }}</p>
            <p class="text-sm text-emerald-600">Jadwal: {{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam)) }}</p>
        </div>

        <form action="{{ route('dosen.absensi.update', ['jadwal' => $jadwal->id, 'absensi' => $absensi->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Pertemuan Ke</label>
                <input type="number" name="pertemuan_ke" value="{{ old('pertemuan_ke', $absensi->pertemuan_ke) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required min="1">
                @error('pertemuan_ke') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-6 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Waktu Mulai Absen</label>
                    <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai', \Carbon\Carbon::parse($absensi->waktu_mulai)->format('H:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                    @error('waktu_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Waktu Tutup Absen</label>
                    <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', \Carbon\Carbon::parse($absensi->waktu_selesai)->format('H:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                    @error('waktu_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="flex justify-end gap-3">
                <a href="{{ route('dosen.absensi.index', $jadwal->id) }}" class="inline-flex items-center gap-1 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-50 shadow-sm transition-all">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-1 bg-emerald-600 text-white px-6 py-2 rounded-lg font-bold text-sm shadow-md hover:bg-emerald-700 hover:shadow-lg transition-all focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
