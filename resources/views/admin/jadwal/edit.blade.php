<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">Edit Jadwal Kuliah</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-2xl border border-white">
                <div class="p-8 sm:p-10">
                    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="space-y-6">
                        @csrf @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Mata Kuliah</label>
                                <select name="kode_matakuliah" class="block w-full rounded-xl border-gray-200 bg-gray-50/50 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors duration-200" required>
                                    <option value="">Pilih Mata Kuliah</option>
                                    @foreach($matakuliahs as $mk)
                                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
                                    @endforeach
                                </select>
                                @error('kode_matakuliah') <span class="text-red-500 text-sm font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Dosen Pengajar</label>
                                <select name="nidn" class="block w-full rounded-xl border-gray-200 bg-gray-50/50 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors duration-200" required>
                                    <option value="">Pilih Dosen</option>
                                    @foreach($dosens as $d)
                                        <option value="{{ $d->nidn }}" {{ old('nidn', $jadwal->nidn) == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                                @error('nidn') <span class="text-red-500 text-sm font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="bg-emerald-50/30 p-6 rounded-2xl border border-emerald-50/50 mt-6">
                            <h3 class="text-sm font-semibold text-emerald-900 mb-4 uppercase tracking-wider">Detail Kelas & Waktu</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Kelas</label>
                                    <select name="kelas" class="block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors duration-200" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach(['A', 'B', 'C', 'D'] as $k)
                                            <option value="{{ $k }}" {{ old('kelas', $jadwal->kelas) == $k ? 'selected' : '' }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas') <span class="text-red-500 text-sm font-medium">{{ $message }}</span> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Angkatan</label>
                                    <select name="angkatan" class="block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors duration-200" required>
                                        <option value="">Pilih Angkatan</option>
                                        @for($year = 2022; $year <= 2026; $year++)
                                            <option value="{{ $year }}" {{ old('angkatan', $jadwal->angkatan) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('angkatan') <span class="text-red-500 text-sm font-medium">{{ $message }}</span> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Hari</label>
                                    <select name="hari" class="block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors duration-200" required>
                                        <option value="">Pilih Hari</option>
                                        @foreach(["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"] as $h)
                                            <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                                        @endforeach
                                    </select>
                                    @error('hari') <span class="text-red-500 text-sm font-medium">{{ $message }}</span> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Jam</label>
                                    <input type="time" name="jam" value="{{ old('jam', date('H:i', strtotime($jadwal->jam))) }}" class="block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors duration-200" required>
                                    @error('jam') <span class="text-red-500 text-sm font-medium">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 mt-6 border-t border-gray-100">
                            <a href="{{ route('admin.jadwal.index') }}" class="px-6 py-2.5 rounded-xl font-medium text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-4 focus:ring-gray-100 transition-all duration-200">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-xl font-medium text-white bg-emerald-600 hover:bg-emerald-700 hover:shadow-lg hover:-translate-y-0.5 focus:ring-4 focus:ring-emerald-200 transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
