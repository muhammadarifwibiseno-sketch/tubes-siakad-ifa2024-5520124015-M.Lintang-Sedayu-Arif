<x-app-layout>
    <x-slot name="header">{{ __('Admin Dashboard') }}</x-slot>

    <div class="space-y-6">

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white shadow-lg shadow-blue-500/30 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-7m0 0l-4.5-2.5M12 14l4.5-2.5"/></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Mahasiswa</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalMahasiswa }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Dosen</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalDosen }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-500/30 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Mata Kuliah</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalMatakuliah }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center text-white shadow-lg shadow-teal-500/30 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Entri KRS</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalKrs }}</p>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Jadwal Per Hari --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h4 class="text-base font-semibold text-gray-800 mb-4">Jadwal Kelas per Hari</h4>
                <div class="h-64"><canvas id="jadwalChart"></canvas></div>
            </div>

            {{-- Matakuliah Terpopuler --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h4 class="text-base font-semibold text-gray-800 mb-4">Mata Kuliah Terpopuler (KRS)</h4>
                <div class="h-64"><canvas id="matkulChart"></canvas></div>
            </div>
        </div>

        {{-- Mahasiswa per Angkatan --}}
        @if(count($angkatanLabels) > 0)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h4 class="text-base font-semibold text-gray-800 mb-4">Jumlah Mahasiswa per Angkatan</h4>
            <div class="h-56"><canvas id="angkatanChart"></canvas></div>
        </div>
        @endif

        {{-- Bottom 2 columns --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Jadwal Hari Ini --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h4 class="text-base font-semibold text-gray-800 mb-4">
                    Jadwal Hari Ini
                    <span class="ml-2 text-xs font-normal text-gray-400">({{ now()->locale('id')->dayName }})</span>
                </h4>
                @forelse($jadwalHariIni as $jadwal)
                <div class="flex items-start gap-3 py-3 border-b border-gray-50 last:border-0">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-700 flex-shrink-0">
                        <span class="text-[10px] font-bold">{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $jadwal->matakuliah->nama_matakuliah ?? '-' }}</p>
                        <p class="text-xs text-gray-400">Kelas {{ $jadwal->kelas }} &bull; {{ $jadwal->dosen->nama ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-400 py-6 text-center">Tidak ada jadwal hari ini.</p>
                @endforelse
                <a href="{{ route('admin.jadwal.index') }}" class="mt-3 block text-center text-xs text-emerald-600 hover:text-emerald-800 font-medium">Lihat Semua Jadwal →</a>
            </div>

            {{-- Mahasiswa Terbaru --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h4 class="text-base font-semibold text-gray-800 mb-4">Mahasiswa Terdaftar Terbaru</h4>
                @forelse($mahasiswaBaru as $mhs)
                <div class="flex items-center gap-3 py-3 border-b border-gray-50 last:border-0">
                    <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                        {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $mhs->nama }}</p>
                        <p class="text-xs text-gray-400">{{ $mhs->npm }} &bull; {{ $mhs->kelas ?? '-' }} &bull; {{ $mhs->angkatan ?? '-' }}</p>
                    </div>
                    <span class="text-[10px] text-gray-300">{{ $mhs->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <p class="text-sm text-gray-400 py-6 text-center">Belum ada data mahasiswa.</p>
                @endforelse
                <a href="{{ route('admin.mahasiswa.index') }}" class="mt-3 block text-center text-xs text-blue-600 hover:text-blue-800 font-medium">Lihat Semua Mahasiswa →</a>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const hariLabels  = @json($hariLabels);
        const jadwalData  = @json($jadwalData);
        const matkulLabels = @json($matkulLabels);
        const matkulData  = @json($matkulData);
        const angkatanLabels = @json($angkatanLabels);
        const angkatanData   = @json($angkatanData);

        const defaultOpts = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' }, border: { display: false } },
                x: { grid: { display: false }, border: { display: false } }
            }
        };

        new Chart(document.getElementById('jadwalChart'), {
            type: 'bar',
            data: {
                labels: hariLabels,
                datasets: [{ label: 'Jumlah Kelas', data: jadwalData,
                    backgroundColor: '#10b981', borderRadius: 6 }]
            },
            options: defaultOpts
        });

        new Chart(document.getElementById('matkulChart'), {
            type: 'bar',
            data: {
                labels: matkulLabels.length ? matkulLabels : ['Belum ada data'],
                datasets: [{ label: 'Jumlah Peserta', data: matkulData.length ? matkulData : [0],
                    backgroundColor: ['#10b981','#34d399','#a78bfa','#c4b5fd','#ddd6fe'],
                    borderRadius: 6 }]
            },
            options: { ...defaultOpts, indexAxis: 'y' }
        });

        @if(count($angkatanLabels) > 0)
        new Chart(document.getElementById('angkatanChart'), {
            type: 'line',
            data: {
                labels: angkatanLabels,
                datasets: [{ label: 'Mahasiswa', data: angkatanData,
                    borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.1)',
                    fill: true, tension: 0.4, pointBackgroundColor: '#3b82f6' }]
            },
            options: defaultOpts
        });
        @endif
    </script>
</x-app-layout>
