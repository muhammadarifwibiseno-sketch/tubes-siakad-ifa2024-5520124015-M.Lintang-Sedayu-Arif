<x-app-layout>
    <x-slot name="header">Detail KRS — {{ $mahasiswa->nama }}</x-slot>

    <div class="space-y-6">
        {{-- Info Mahasiswa --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-emerald-600 flex items-center justify-center text-white text-xl font-bold">
                    {{ substr($mahasiswa->nama, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $mahasiswa->nama }}</h2>
                    <p class="text-sm text-gray-500">NPM: {{ $mahasiswa->npm }}
                        @if($mahasiswa->kelas) • Kelas: {{ $mahasiswa->kelas }} @endif
                        @if($mahasiswa->angkatan) • Angkatan: {{ $mahasiswa->angkatan }} @endif
                    </p>
                </div>
                <div class="ml-auto text-right">
                    <p class="text-3xl font-bold text-emerald-600">{{ $totalSks }}</p>
                    <p class="text-sm text-gray-500">Total SKS</p>
                </div>
            </div>
        </div>

        {{-- Tabel KRS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-800">Daftar Mata Kuliah yang Diambil</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                    {{ $krs->count() }} Mata Kuliah
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">Kode MK</th>
                            <th class="px-6 py-3 text-left">Nama Mata Kuliah</th>
                            <th class="px-6 py-3 text-center">SKS</th>
                            <th class="px-6 py-3 text-left">Tanggal Diambil</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($krs as $i => $k)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 font-mono text-gray-700">{{ $k->kode_matakuliah }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $k->matakuliah->sks ?? 0 }} SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $k->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                Mahasiswa ini belum mengambil mata kuliah apapun.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($krs->count() > 0)
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Total SKS</td>
                            <td class="px-6 py-3 text-center font-bold text-emerald-700">{{ $totalSks }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.krs.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                ← Kembali
            </a>
        </div>
    </div>
</x-app-layout>
