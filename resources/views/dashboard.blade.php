<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Overview') }}
    </x-slot>

    <div class="space-y-6">
        <!-- Stat Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Students -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full opacity-50"></div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Mahasiswa</p>
                    <h3 class="text-3xl font-bold text-gray-800">1,245</h3>
                    <p class="text-xs text-emerald-500 mt-2 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        <span>+12% dari semester lalu</span>
                    </p>
                </div>
                <div class="w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center relative z-10 shadow-lg shadow-emerald-500/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                </div>
            </div>

            <!-- Card 2: Teachers -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-50 rounded-full opacity-50"></div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Dosen</p>
                    <h3 class="text-3xl font-bold text-gray-800">84</h3>
                    <p class="text-xs text-emerald-500 mt-2 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        <span>+2 dosen baru</span>
                    </p>
                </div>
                <div class="w-14 h-14 rounded-full bg-teal-500 text-white flex items-center justify-center relative z-10 shadow-lg shadow-teal-500/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <!-- Card 3: Subjects -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full opacity-50"></div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Mata Kuliah Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800">112</h3>
                    <p class="text-xs text-gray-400 mt-2 flex items-center">
                        <span>Semester Ganjil 2026</span>
                    </p>
                </div>
                <div class="w-14 h-14 rounded-full bg-green-500 text-white flex items-center justify-center relative z-10 shadow-lg shadow-green-500/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>

            <!-- Card 4: Classes -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-cyan-50 rounded-full opacity-50"></div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Sesi Kelas Hari Ini</p>
                    <h3 class="text-3xl font-bold text-gray-800">36</h3>
                    <p class="text-xs text-teal-500 mt-2 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>8 sesi sedang berlangsung</span>
                    </p>
                </div>
                <div class="w-14 h-14 rounded-full bg-cyan-600 text-white flex items-center justify-center relative z-10 shadow-lg shadow-cyan-600/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Aktivitas Akademik Mingguan</h4>
                    <button class="p-1 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Distribusi Nilai</h4>
                    <button class="p-1 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Hari Ini</h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100">
                        <div class="w-12 h-12 rounded-lg bg-emerald-50 flex flex-col items-center justify-center text-emerald-700 flex-shrink-0">
                            <span class="text-xs font-bold uppercase">08:00</span>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800">Pemrograman Web Lanjut</h5>
                            <p class="text-sm text-gray-500">Ruang Lab Komputer 1 • Dosen: Budi, M.Kom</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100">
                        <div class="w-12 h-12 rounded-lg bg-teal-50 flex flex-col items-center justify-center text-teal-700 flex-shrink-0">
                            <span class="text-xs font-bold uppercase">10:30</span>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800">Basis Data</h5>
                            <p class="text-sm text-gray-500">Ruang Teori 4 • Dosen: Andi, S.T., M.T.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100">
                        <div class="w-12 h-12 rounded-lg bg-green-50 flex flex-col items-center justify-center text-green-700 flex-shrink-0">
                            <span class="text-xs font-bold uppercase">13:00</span>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800">Kalkulus Lanjut</h5>
                            <p class="text-sm text-gray-500">Ruang Teori 2 • Dosen: Siti, M.Sc.</p>
                        </div>
                    </div>
                </div>
                <button class="mt-4 w-full py-2 text-sm text-emerald-600 font-medium hover:text-emerald-800 text-center transition-colors">
                    Lihat Semua Jadwal
                </button>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Pengumuman Terbaru</h4>
                <div class="space-y-4">
                    <div class="border-l-4 border-emerald-500 pl-4 py-1">
                        <p class="text-xs text-gray-400 mb-1">08 Jun 2026</p>
                        <h5 class="font-medium text-gray-800 text-sm">Batas Akhir Pengisian KRS Semester Ganjil</h5>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">Mohon kepada seluruh mahasiswa untuk segera menyelesaikan pengisian Kartu Rencana Studi (KRS) sebelum tanggal 15 Juni 2026.</p>
                    </div>
                    <div class="border-l-4 border-teal-500 pl-4 py-1">
                        <p class="text-xs text-gray-400 mb-1">05 Jun 2026</p>
                        <h5 class="font-medium text-gray-800 text-sm">Libur Nasional</h5>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">Pemberitahuan libur nasional untuk minggu depan. Seluruh kegiatan akademik ditiadakan.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 py-1">
                        <p class="text-xs text-gray-400 mb-1">01 Jun 2026</p>
                        <h5 class="font-medium text-gray-800 text-sm">Pendaftaran Beasiswa Berprestasi</h5>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">Telah dibuka pendaftaran beasiswa berprestasi untuk mahasiswa angkatan 2024 dan 2025.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxActivity = document.getElementById('activityChart').getContext('2d');
            new Chart(ctxActivity, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [
                        {
                            label: 'Kehadiran Mahasiswa',
                            data: [820, 930, 850, 960, 880, 420, 150],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Akses Sistem',
                            data: [1200, 1350, 1250, 1400, 1300, 800, 400],
                            borderColor: '#14b8a6',
                            backgroundColor: 'transparent',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', align: 'end', labels: { usePointStyle: true, boxWidth: 6 } }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [2, 2], color: '#f1f5f9' }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    }
                }
            });

            const ctxPerformance = document.getElementById('performanceChart').getContext('2d');
            new Chart(ctxPerformance, {
                type: 'bar',
                data: {
                    labels: ['A', 'B', 'C', 'D', 'E'],
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: [35, 45, 15, 3, 2],
                        backgroundColor: [
                            '#10b981',
                            '#14b8a6',
                            '#6ee7b7',
                            '#a7f3d0',
                            '#d1fae5'
                        ],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [2, 2], color: '#f1f5f9' }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    }
                }
            });
        });
    </script>
</x-app-layout>
