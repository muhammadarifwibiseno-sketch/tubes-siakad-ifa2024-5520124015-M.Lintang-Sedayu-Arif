
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mata Kuliah</h2></x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('admin.matakuliah.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required maxlength="8">
                @error('kode_matakuliah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required maxlength="50">
                @error('nama_matakuliah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">SKS</label>
                <input type="number" name="sks" value="{{ old('sks') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required min="1" max="6">
                @error('sks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.matakuliah.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
