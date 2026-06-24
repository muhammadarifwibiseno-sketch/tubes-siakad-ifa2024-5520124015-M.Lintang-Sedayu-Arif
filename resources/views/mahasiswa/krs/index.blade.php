
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kartu Rencana Studi (KRS)</h2>
            <a href="{{ route('mahasiswa.krs.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Export PDF</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Form Ambil KRS -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-4">Ambil Mata Kuliah</h3>
                @if(session("error"))
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">{{ session("error") }}</div>
                @endif
                @if(session("success"))
                    <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session("success") }}</div>
                @endif
                <form method="POST" action="{{ route('mahasiswa.krs.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Mata Kuliah Tersedia</label>
                        <select name="kode_matakuliah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($matakuliahs as $mk)
                                @if(!in_array($mk->kode_matakuliah, $taken))
                                    <option value="{{ $mk->kode_matakuliah }}">{{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded">Tambah ke KRS</button>
                    </div>
                </form>
            </div>
            
            <!-- Daftar KRS Diambil -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-4">Mata Kuliah Diambil</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 mb-4">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Kode MK</th>
                                <th class="border p-2">Nama</th>
                                <th class="border p-2">SKS</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($krs as $k)
                                <tr>
                                    <td class="border p-2 text-center">{{ $k->matakuliah->kode_matakuliah }}</td>
                                    <td class="border p-2">{{ $k->matakuliah->nama_matakuliah }}</td>
                                    <td class="border p-2 text-center">{{ $k->matakuliah->sks }}</td>
                                    <td class="border p-2 text-center">
                                        <form action="{{ route('mahasiswa.krs.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Drop mata kuliah ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="border p-2 text-center">Belum ada mata kuliah yang diambil.</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-100 font-semibold">
                                <td colspan="2" class="border p-2 text-right">Total SKS:</td>
                                <td class="border p-2 text-center">{{ $totalSks }}</td>
                                <td class="border p-2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
