
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Penugasan Dosen & Jadwal Kelas</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session("success"))
                        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session("success") }}</div>
                    @endif
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-4 gap-4">
                        <a href="{{ route('admin.jadwal.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 whitespace-nowrap">Tambah Penugasan & Jadwal</a>
                        <form method="GET" action="{{ route('admin.jadwal.index') }}" class="flex flex-wrap gap-2 w-full lg:w-auto justify-end">
                            <select name="hari" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Semua Hari</option>
                                @foreach($hari_list as $h)
                                    <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                                @endforeach
                            </select>
                            <select name="angkatan" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Semua Angkatan</option>
                                @for($year = 2022; $year <= 2026; $year++)
                                    <option value="{{ $year }}" {{ request('angkatan') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            <select name="kode_matakuliah" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm max-w-[150px] truncate">
                                <option value="">Semua Mata Kuliah</option>
                                @foreach($matakuliahs as $mk)
                                    <option value="{{ $mk->kode_matakuliah }}" {{ request('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
                                @endforeach
                            </select>
                            <select name="nidn" class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm max-w-[150px] truncate">
                                <option value="">Semua Dosen</option>
                                @foreach($dosens as $d)
                                    <option value="{{ $d->nidn }}" {{ request('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm w-32 md:w-auto">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm">Filter</button>
                            @if(request()->anyFilled(['search', 'hari', 'nidn', 'kode_matakuliah', 'angkatan']))
                                <a href="{{ route('admin.jadwal.index') }}" class="bg-red-100 text-red-600 px-3 py-2 rounded-md hover:bg-red-200 text-sm flex items-center">Reset</a>
                            @endif
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">Mata Kuliah</th>
                                    <th class="border p-2">Dosen</th>
                                    <th class="border p-2">Kelas</th>
                                    <th class="border p-2">Angkatan</th>
                                    <th class="border p-2">Hari</th>
                                    <th class="border p-2">Jam</th>
                                    <th class="border p-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwals as $j)
                                    <tr>
                                        <td class="border p-2">{{ $j->matakuliah->nama_matakuliah }}</td>
                                        <td class="border p-2">{{ $j->dosen->nama }}</td>
                                        <td class="border p-2 text-center">{{ $j->kelas }}</td>
                                        <td class="border p-2 text-center">{{ $j->angkatan ?? '-' }}</td>
                                        <td class="border p-2 text-center">{{ $j->hari }}</td>
                                        <td class="border p-2 text-center">{{ date('H:i', strtotime($j->jam)) }}</td>
                                        <td class="border p-2 text-center space-x-2 flex justify-center">
                                            <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="border p-2 text-center">Data tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $jadwals->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
