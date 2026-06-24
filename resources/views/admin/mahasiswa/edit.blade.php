
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Mahasiswa</h2></x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->npm) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">NPM</label>
                <input type="text" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required maxlength="10">
                @error('npm') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required maxlength="50">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4 flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach(['A', 'B', 'C', 'D'] as $k)
                            <option value="{{ $k }}" {{ old('kelas', $mahasiswa->kelas) == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                    @error('kelas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                    <select name="angkatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- Pilih Angkatan --</option>
                        @for($year = 2022; $year <= 2026; $year++)
                            <option value="{{ $year }}" {{ old('angkatan', $mahasiswa->angkatan) == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('angkatan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Dosen Wali</label>
                <select name="nidn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">-- Pilih Dosen Wali (Opsional) --</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                    @endforeach
                </select>
                @error('nidn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <hr class="my-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kelola Akun (Opsional)</h3>
            <p class="text-sm text-gray-500 mb-4">Isi bagian ini jika Anda ingin mengubah email atau mengatur ulang (reset) kata sandi akun pengguna ini. Biarkan kosong jika tidak ada perubahan.</p>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email Akun</label>
                <input type="email" name="email" value="{{ old('email', $mahasiswa->user->email ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Biarkan kosong untuk email bawaan">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Isi untuk reset password">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route('admin.mahasiswa.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
