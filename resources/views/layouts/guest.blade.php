<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIAKAD') }} - Login</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden"
             style="background: linear-gradient(135deg, #022c22 0%, #064e3b 40%, #065f46 70%, #047857 100%);">

            <!-- Decorative blobs -->
            <div class="absolute inset-0 overflow-hidden z-0 pointer-events-none">
                <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full opacity-20" style="background:radial-gradient(circle,#34d399,transparent)"></div>
                <div class="absolute top-1/2 -right-40 w-[28rem] h-[28rem] rounded-full opacity-15" style="background:radial-gradient(circle,#6ee7b7,transparent)"></div>
                <div class="absolute -bottom-24 left-1/3 w-72 h-72 rounded-full opacity-20" style="background:radial-gradient(circle,#10b981,transparent)"></div>
                <!-- Grid pattern -->
                <svg class="absolute inset-0 w-full h-full opacity-5" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>

            <!-- Login Card -->
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-emerald-100">
                <div class="flex flex-col items-center mb-8">
                    <!-- Icon -->
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg mb-4"
                         style="background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 8px 24px rgba(16,185,129,0.35);">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">SIAKAD</h2>
                    <p class="text-sm text-gray-400 mt-1">Sistem Informasi Akademik Sederhana</p>
                    <!-- Garis dekoratif -->
                    <div class="mt-3 flex gap-1">
                        <span class="block w-8 h-1 rounded-full bg-emerald-500"></span>
                        <span class="block w-3 h-1 rounded-full bg-emerald-300"></span>
                        <span class="block w-1 h-1 rounded-full bg-emerald-200"></span>
                    </div>
                </div>

                {{ $slot }}
            </div>

            <!-- Footer Card -->
            <div class="relative z-10 mt-6 w-full max-w-md px-4 pb-8">
                <div class="flex items-center gap-4 rounded-2xl border border-emerald-700/40 bg-emerald-900/40 px-5 py-4 shadow-lg backdrop-blur-sm">
                    <!-- Logo -->
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center">
                        @if (file_exists(public_path('images/logo-unsur.png')))
                            <img src="{{ asset('images/logo-unsur.png') }}" alt="Logo UNSUR" class="h-full w-full object-contain drop-shadow-lg">
                        @else
                            <div class="w-14 h-14 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold text-lg">U</div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-white text-sm">M.Lintang Arif — 5520124015</p>
                        <p class="text-xs text-emerald-200/80 mt-0.5">Universitas Suryakencana | Fakultas Teknik | Prodi Informatika</p>
                        <p class="text-xs text-emerald-300/50 mt-2">&copy; {{ date('Y') }} SIAKAD. All rights reserved.</p>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
