<div class="hidden sm:flex w-64 bg-[#064e3b] text-white flex-col h-screen fixed inset-y-0 left-0 z-50">
    <div class="flex items-center justify-center h-20 border-b border-emerald-800/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center">
                @if (file_exists(public_path('images/logo-unsur.png')))
                    <img src="{{ asset('images/logo-unsur.png') }}" alt="Logo" class="h-full w-full object-contain drop-shadow-lg">
                @else
                    <span class="text-xs font-bold text-emerald-200">UNSUR</span>
                @endif
            </div>
            <span class="text-xl font-bold tracking-wider">SIAKAD</span>
        </a>
    </div>

    <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">
            Dashboard
        </x-sidebar-link>

        @if (Auth::user()->role === 'admin')
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Master Data</p>
            <x-sidebar-link :href="route('admin.dosen.index')" :active="request()->routeIs('admin.dosen.*')" icon="users">
                Dosen
            </x-sidebar-link>
            <x-sidebar-link :href="route('admin.mahasiswa.index')" :active="request()->routeIs('admin.mahasiswa.*')" icon="academic-cap">
                Mahasiswa
            </x-sidebar-link>

            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Akademik</p>
            <x-sidebar-link :href="route('admin.matakuliah.index')" :active="request()->routeIs('admin.matakuliah.*')" icon="book-open">
                Mata Kuliah
            </x-sidebar-link>
            <x-sidebar-link :href="route('admin.jadwal.index')" :active="request()->routeIs('admin.jadwal.*')" icon="calendar">
                Jadwal
            </x-sidebar-link>
            <x-sidebar-link :href="route('admin.krs.index')" :active="request()->routeIs('admin.krs.*')" icon="document-text">
                Data KRS
            </x-sidebar-link>
        @endif

        @if (Auth::user()->role === 'mahasiswa')
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Akademik</p>
            <x-sidebar-link :href="route('mahasiswa.krs.index')" :active="request()->routeIs('mahasiswa.krs.*')" icon="document-text">
                Data KRS
            </x-sidebar-link>
            <x-sidebar-link :href="route('mahasiswa.absensi.index')" :active="request()->routeIs('mahasiswa.absensi.*')" icon="calendar">
                Absensi Kelas
            </x-sidebar-link>
        @endif

        @if (Auth::user()->role === 'dosen')
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Akademik</p>
            <x-sidebar-link :href="route('dosen.jadwal.index')" :active="request()->routeIs('dosen.jadwal.*') || request()->routeIs('dosen.absensi.*')" icon="calendar">
                Jadwal Mengajar
            </x-sidebar-link>
        @endif
    </div>

    <div class="p-4 border-t border-emerald-800/50 bg-[#022c22]">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-emerald-300 truncate capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Backdrop -->
<div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-gray-900/80 backdrop-blur-sm sm:hidden" @click="sidebarOpen = false"></div>

<!-- Mobile Sidebar -->
<div x-show="sidebarOpen"
     class="fixed inset-y-0 left-0 z-50 w-64 bg-[#064e3b] text-white flex-col sm:hidden flex"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="-translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="-translate-x-full"
     style="display:none">

    <div class="flex items-center justify-between h-20 px-4 border-b border-emerald-800/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <span class="text-lg font-bold tracking-wider">SIAKAD</span>
        </a>
        <button @click="sidebarOpen = false" class="p-2 rounded-md text-emerald-300 hover:text-white hover:bg-emerald-800">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">
            Dashboard
        </x-sidebar-link>

        @if (Auth::user()->role === 'admin')
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Master Data</p>
            <x-sidebar-link :href="route('admin.dosen.index')" :active="request()->routeIs('admin.dosen.*')" icon="users">Dosen</x-sidebar-link>
            <x-sidebar-link :href="route('admin.mahasiswa.index')" :active="request()->routeIs('admin.mahasiswa.*')" icon="academic-cap">Mahasiswa</x-sidebar-link>
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Akademik</p>
            <x-sidebar-link :href="route('admin.matakuliah.index')" :active="request()->routeIs('admin.matakuliah.*')" icon="book-open">Mata Kuliah</x-sidebar-link>
            <x-sidebar-link :href="route('admin.jadwal.index')" :active="request()->routeIs('admin.jadwal.*')" icon="calendar">Jadwal</x-sidebar-link>
            <x-sidebar-link :href="route('admin.krs.index')" :active="request()->routeIs('admin.krs.*')" icon="document-text">Data KRS</x-sidebar-link>
        @endif

        @if (Auth::user()->role === 'mahasiswa')
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Akademik</p>
            <x-sidebar-link :href="route('mahasiswa.krs.index')" :active="request()->routeIs('mahasiswa.krs.*')" icon="document-text">Data KRS</x-sidebar-link>
            <x-sidebar-link :href="route('mahasiswa.absensi.index')" :active="request()->routeIs('mahasiswa.absensi.*')" icon="calendar">Absensi Kelas</x-sidebar-link>
        @endif

        @if (Auth::user()->role === 'dosen')
            <p class="px-3 pt-4 pb-2 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Akademik</p>
            <x-sidebar-link :href="route('dosen.jadwal.index')" :active="request()->routeIs('dosen.jadwal.*')" icon="calendar">Jadwal Mengajar</x-sidebar-link>
        @endif
    </div>

    <div class="p-4 border-t border-emerald-800/50 bg-[#022c22]">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-emerald-300 truncate capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</div>
