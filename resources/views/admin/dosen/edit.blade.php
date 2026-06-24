
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Dosen</h2></x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('admin.dosen.update', $dosen->nidn) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">NIDN</label>
                <input type="text" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required maxlength="10">
                @error('nidn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Dosen</label>
                <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required maxlength="50">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <hr class="my-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kelola Akun (Opsional)</h3>
            <p class="text-sm text-gray-500 mb-4">Isi bagian ini jika Anda ingin mengubah email atau mengatur ulang (reset) kata sandi akun pengguna ini. Biarkan kosong jika tidak ada perubahan.</p>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email Akun</label>
                <input type="email" name="email" value="{{ old('email', $dosen->user->email ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Biarkan kosong untuk email bawaan">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Isi untuk reset password">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route('admin.dosen.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
