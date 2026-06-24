
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Mahasiswa</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session("success"))
                        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session("success") }}</div>
                    @endif
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                        <a href="{{ route('admin.mahasiswa.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 whitespace-nowrap">Tambah Mahasiswa</a>
                        <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="flex flex-wrap gap-2 w-full md:w-auto justify-end">
                            <select name="nidn" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Semua Dosen Wali</option>
                                @foreach($dosens as $d)
                                    <option value="{{ $d->nidn }}" {{ request('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                                @endforeach
                            </select>
                            <select name="kelas" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Semua Kelas</option>
                                @foreach($kelas_list as $k)
                                    <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                            <select name="angkatan" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Semua Angkatan</option>
                                @foreach($angkatan_list as $a)
                                    <option value="{{ $a }}" {{ request('angkatan') == $a ? 'selected' : '' }}>{{ $a }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm w-32 md:w-auto">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm">Filter</button>
                            @if(request()->anyFilled(['search', 'nidn', 'kelas', 'angkatan']))
                                <a href="{{ route('admin.mahasiswa.index') }}" class="bg-red-100 text-red-600 px-3 py-2 rounded-md hover:bg-red-200 text-sm flex items-center">Reset</a>
                            @endif
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">NPM</th>
                                    <th class="border p-2">Nama Mahasiswa</th>
                                    <th class="border p-2 text-center">Kelas</th>
                                    <th class="border p-2 text-center">Angkatan</th>
                                    <th class="border p-2">Dosen Wali</th>
                                    <th class="border p-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswas as $m)
                                    <tr>
                                        <td class="border p-2 text-center">{{ $m->npm }}</td>
                                        <td class="border p-2">{{ $m->nama }}</td>
                                        <td class="border p-2 text-center">{{ $m->kelas ?: '-' }}</td>
                                        <td class="border p-2 text-center">{{ $m->angkatan ?: '-' }}</td>
                                        <td class="border p-2">{{ $m->dosenWali ? $m->dosenWali->nama : '-' }}</td>
                                        <td class="border p-2 text-center space-x-2 flex justify-center">
                                            <a href="{{ route('admin.mahasiswa.edit', $m->npm) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.mahasiswa.destroy', $m->npm) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="border p-2 text-center">Data tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $mahasiswas->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
