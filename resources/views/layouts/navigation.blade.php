<header class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left Side -->
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = true" class="sm:hidden p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Logo -->
                <div class="ml-2 flex h-10 w-10 shrink-0 items-center justify-center sm:ml-0 sm:h-11 sm:w-11">
                    @if (file_exists(public_path('images/logo-unsur.png')))
                        <img src="{{ asset('images/logo-unsur.png') }}" alt="Logo Universitas Suryakencana" class="h-full w-full object-contain">
                    @else
                        <span class="text-xs font-bold text-emerald-700">UNSUR</span>
                    @endif
                </div>
                
                @isset($header)
                    <div class="hidden sm:block ml-4 text-xl font-semibold text-gray-800">
                        {{ $header }}
                    </div>
                @else
                    <div class="hidden sm:block ml-4 text-xl font-semibold text-gray-800 capitalize">
                        {{ str_replace('.', ' / ', Route::currentRouteName() ?? 'SIAKAD') }}
                    </div>
                @endisset
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">
                
                <!-- Search -->
                <form method="GET" action="{{ url()->current() }}" role="search" class="hidden md:flex items-center overflow-hidden rounded-full border border-emerald-200 bg-white shadow-sm ring-1 ring-emerald-50 transition focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100">
                    <label for="navbar-search" class="sr-only">Cari data</label>
                    <div class="pl-4 text-emerald-500">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input id="navbar-search" name="search" type="search" value="{{ request('search') }}" class="w-64 border-0 bg-white px-3 py-2.5 text-sm font-medium text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-0" placeholder="Cari data...">
                    <button type="submit" class="mr-1 inline-flex items-center rounded-full bg-emerald-600 px-4 py-1.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                        Cari
                    </button>
                </form>

                <!-- Notifications -->
                <div x-data="{ open: false }" class="relative">
                    <button type="button" @click="open = ! open" class="relative rounded-full p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2" aria-haspopup="true" :aria-expanded="open.toString()">
                        <span class="sr-only">Buka notifikasi</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         @click.outside="open = false"
                         class="absolute right-0 z-50 mt-3 w-80 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl"
                         style="display: none;">
                        <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3">
                            <h3 class="text-sm font-bold text-gray-900">Notifikasi</h3>
                            <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-semibold text-emerald-700">Baru</span>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="px-4 py-3 hover:bg-gray-50">
                                <p class="text-sm font-semibold text-gray-800">Selamat datang, {{ Auth::user()->name }}</p>
                                <p class="mt-1 text-xs text-gray-500">Anda login sebagai {{ ucfirst(Auth::user()->role) }}.</p>
                            </div>
                            <div class="px-4 py-3 hover:bg-gray-50">
                                <p class="text-sm font-semibold text-gray-800">Sistem Akademik aktif</p>
                                <p class="mt-1 text-xs text-gray-500">Gunakan menu sidebar untuk mengelola data akademik.</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 bg-gray-50 px-4 py-2 text-center">
                            <span class="text-xs font-medium text-gray-500">Belum ada notifikasi lain.</span>
                        </div>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative ml-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center max-w-xs text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all">
                                <span class="sr-only">Open user menu</span>
                                <div class="flex items-center gap-2 pr-2 pl-1 py-1 bg-emerald-50 border border-emerald-200 rounded-full hover:bg-emerald-100 transition-colors shadow-sm">
                                    <div class="h-8 w-8 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold shadow-inner">
                                         {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden md:block text-sm font-bold text-emerald-900">{{ Auth::user()->name }}</span>
                                    <svg class="hidden md:block w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <x-dropdown-link :href="route('profile.edit')" class="mt-1">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100 mt-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-red-600 hover:text-red-800 hover:bg-red-50 font-bold flex items-center gap-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</header>
