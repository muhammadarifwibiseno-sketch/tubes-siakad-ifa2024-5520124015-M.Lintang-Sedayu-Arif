<x-app-layout>
    <x-slot name="header">Kelola KRS Mahasiswa</x-slot>

    <div class="space-y-6">
        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
        @endif

        {{-- Search --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <form method="GET" action="{{ route('admin.krs.index') }}" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama atau NPM mahasiswa..."
                    class="flex-1 rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.krs.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-200">Reset</a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-800">Daftar KRS Mahasiswa</h3>
                <span class="text-sm text-gray-500">{{ $mahasiswas->total() }} mahasiswa</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">NPM</th>
                            <th class="px-6 py-3 text-left">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-center">Jumlah MK Diambil</th>
                            <th class="px-6 py-3 text-center">Total SKS</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($mahasiswas as $i => $mhs)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500">{{ $mahasiswas->firstItem() + $i }}</td>
                            <td class="px-6 py-4 font-mono text-gray-700">{{ $mhs->npm }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $mhs->nama }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $mhs->krs->count() }} MK
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-medium text-gray-700">
                                {{ $mhs->krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }} SKS
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.krs.show', $mhs->npm) }}"
                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p>Tidak ada data mahasiswa</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($mahasiswas->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $mahasiswas->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
