
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Mata Kuliah</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session("success"))
                        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session("success") }}</div>
                    @endif
                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('admin.matakuliah.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Tambah Mata Kuliah</a>
                        <form method="GET" action="{{ route('admin.matakuliah.index') }}" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mata kuliah..." class="border-gray-300 rounded-l-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <button type="submit" class="bg-gray-800 text-white px-4 rounded-r-md hover:bg-gray-700">Cari</button>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">Kode MK</th>
                                    <th class="border p-2">Nama Mata Kuliah</th>
                                    <th class="border p-2">SKS</th>
                                    <th class="border p-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($matakuliahs as $m)
                                    <tr>
                                        <td class="border p-2 text-center">{{ $m->kode_matakuliah }}</td>
                                        <td class="border p-2">{{ $m->nama_matakuliah }}</td>
                                        <td class="border p-2 text-center">{{ $m->sks }}</td>
                                        <td class="border p-2 text-center space-x-2 flex justify-center">
                                            <a href="{{ route('admin.matakuliah.edit', $m->kode_matakuliah) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.matakuliah.destroy', $m->kode_matakuliah) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="border p-2 text-center">Data tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $matakuliahs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
