<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Destinara — Menghidupkan Ruang Belajar Nyata di Tapak Nusantara')</title>
    <meta name="description" content="@yield('meta_description', 'Inisiatif pendidikan lapangan dan riset berbasis komunitas yang menjembatani kurikulum institusi dengan kearifan tapak dan pengetahuan lokal di seluruh Nusantara.')">

    <!-- Favicon Configuration (dari comprodestinara) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}"/>
    <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>
    <meta name="theme-color" content="#703a3a"/>

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..24,400,0..1,0" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Work Sans', sans-serif;
            background-color: #FFF8F6;
            color: #2B2323;
        }
        .font-serif {
            font-family: 'Newsreader', Georgia, serif;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#8C5151] selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- Top Announcement Bar -->
    <div class="bg-[#703A3A] text-[#FDEAE5] text-xs py-2 px-4 text-center font-medium tracking-wide flex items-center justify-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-[#D4E9CA] animate-pulse"></span>
        <span>Inisiatif Pendidikan Lapangan & Riset Berbasis Komunitas di Seluruh Pelosok Nusantara</span>
        <span class="hidden sm:inline">•</span>
        <a href="{{ route('cara-kerja') }}" class="hidden sm:inline underline text-[#D4E9CA] hover:text-white transition-colors">Pelajari Protokol Kemitraan</a>
    </div>

    <!-- Main Navigation Bar -->
    <header class="border-b border-[#E8D6D1] bg-[#FFF8F6]/95 backdrop-blur sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('destinasi.index') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/img/logo-mark-tight.png') }}" alt="Destinara Logo" class="w-10 h-10 object-contain group-hover:scale-105 transition-transform">
                <div>
                    <span class="font-serif text-2xl font-bold tracking-tight text-[#4A2020] block leading-none">DESTINARA</span>
                    <span class="text-[10px] tracking-widest text-[#8C5151] uppercase font-semibold">Ruang Belajar Tapak Nusantara</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-[#5C4A4A]">
                <a href="{{ route('destinasi.index') }}" class="hover:text-[#8C5151] transition-colors {{ request()->routeIs('destinasi.*') || request()->routeIs('home') ? 'text-[#8C5151] font-semibold border-b-2 border-[#8C5151] pb-1' : '' }}">
                    Katalog Tapak & Riset
                </a>
                <a href="#legalitas-fpic" class="hover:text-[#8C5151] transition-colors">
                    Protokol FPIC Adat
                </a>
                <a href="#panduan-bos" class="hover:text-[#8C5151] transition-colors">
                    Standar Dana BOS
                </a>
                <span class="text-xs px-3 py-1 bg-[#F5E6E1] text-[#703A3A] font-semibold flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-[#51634b] inline-block"></span>
                    <span>100% Berdokumen Resmi</span>
                </span>
            </nav>

            <!-- Auth Buttons & Mobile Menu Toggle -->
            <div class="flex items-center gap-3">
                @auth
                    @php
                        $userRole = Auth::user()->role ?? 'buyer';
                        $roleRoute = match($userRole) {
                            'buyer' => 'buyer.dashboard',
                            'mitra' => 'mitra.dashboard',
                            'admin' => 'admin.dashboard',
                            'superadmin' => 'superadmin.dashboard',
                            default => 'buyer.dashboard',
                        };
                        $roleLabel = match($userRole) {
                            'buyer' => 'Buyer',
                            'mitra' => 'Mitra',
                            'admin' => 'Admin',
                            'superadmin' => 'Super Admin',
                            default => 'Dashboard',
                        };
                    @endphp
                    <a href="{{ route($roleRoute) }}" class="px-4 py-2 text-xs font-semibold uppercase tracking-wider bg-[#8C5151] text-white hover:bg-[#703A3A] transition-colors flex items-center gap-2 shadow-xs">
                        <span class="material-symbols-outlined text-[16px]">dashboard</span>
                        <span>Ruang Kerja ({{ $roleLabel }})</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex px-4 py-2 text-sm font-medium text-[#703A3A] hover:bg-[#F5E6E1] transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-[#8C5151] text-white hover:bg-[#703A3A] shadow-xs transition-all hover:shadow">
                        Daftar Akun
                    </a>
                @endauth
                <!-- Mobile Menu Button -->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-[#703A3A] hover:bg-[#F5E6E1]" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden border-b border-[#E8D6D1] bg-[#FFF8F6] px-4 pt-2 pb-6 space-y-3">
            <a href="{{ route('destinasi.index') }}" class="block px-3 py-2 text-base font-medium text-[#5C4A4A] hover:bg-[#F5E6E1] {{ request()->routeIs('destinasi.*') || request()->routeIs('home') ? 'bg-[#F5E6E1] text-[#8C5151]' : '' }}">
                Katalog Tapak & Riset
            </a>
            <a href="#legalitas-fpic" class="block px-3 py-2 text-base font-medium text-[#5C4A4A] hover:bg-[#F5E6E1]">
                Protokol FPIC Adat
            </a>
            <a href="#panduan-bos" class="block px-3 py-2 text-base font-medium text-[#5C4A4A] hover:bg-[#F5E6E1]">
                Standar Dana BOS
            </a>
            <div class="pt-2 border-t border-[#E8D6D1] flex gap-2">
                @auth
                    <a href="{{ route($roleRoute) }}" class="flex-1 text-center py-2 text-xs font-bold uppercase tracking-wider bg-[#8C5151] text-white">
                        Ruang Kerja ({{ $roleLabel }})
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm font-medium text-[#703A3A] bg-[#F5E6E1]">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm font-medium bg-[#8C5151] text-white">
                        Daftar Akun
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Terroir Editorial Footer -->
    <footer class="bg-[#4A2020] text-[#E8D6D1] pt-14 pb-10 border-t border-[#381818] mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-[#703A3A]/60">
                <!-- Column 1: Brand & Mission -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/img/logo-mark-tight.png') }}" alt="Logo" class="w-10 h-10 object-contain drop-shadow-sm">
                        <div>
                            <span class="font-serif text-2xl font-bold tracking-tight text-white block">DESTINARA</span>
                            <span class="text-[10px] tracking-widest text-[#D4E9CA] uppercase font-semibold">Ruang Belajar Tapak Nusantara</span>
                        </div>
                    </div>
                    <p class="text-sm text-[#D7C2C1] leading-relaxed max-w-md">
                        Inisiatif pendidikan lapangan dan riset berbasis komunitas yang menghubungkan ruang akademis (sekolah & kampus) dengan kearifan tapak adat Nusantara secara etis, transparan, dan terlindungi hukum.
                    </p>
                    <div class="flex items-center gap-3 text-xs text-[#D4E9CA]">
                        <span class="w-2 h-2 rounded-full bg-[#D4E9CA]"></span>
                        <span>Berkomitmen pada protokol FPIC (Free, Prior, and Informed Consent)</span>
                    </div>
                </div>

                <!-- Column 2: Navigasi Layanan -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#D4E9CA] mb-4">Navigasi Layanan</h4>
                    <ul class="space-y-2.5 text-sm text-[#D7C2C1]">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('destinasi.index') }}" class="hover:text-white transition-colors">Katalog Destinasi</a></li>
                        <li><a href="{{ route('cara-kerja') }}" class="hover:text-white transition-colors">Alur & Prosedur Kemitraan</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftarkan Akun Baru</a></li>
                    </ul>
                </div>

                <!-- Column 3: Dukungan & Kontak -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#D4E9CA] mb-4">Kanal Resmi</h4>
                    <ul class="space-y-2.5 text-sm text-[#D7C2C1]">
                        <li>Email: <a href="mailto:halo@destinara.id" class="text-white hover:underline">halo@destinara.id</a></li>
                        <li>WhatsApp: <a href="https://wa.me/6282116200363" target="_blank" class="text-white hover:underline">+62 821-1620-0363</a></li>
                        <li>Yogyakarta & Jakarta, Indonesia</li>
                        <li class="pt-2 text-xs text-[#D7C2C1]">Kemitraan Resmi Desa Adat & BUMDes</li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#A89088]">
                <p>&copy; {{ date('Y') }} Destinara. Inisiatif Pendidikan Lapangan & Riset Berbasis Komunitas.</p>
                <div class="flex items-center gap-6 text-[#D7C2C1]">
                    <span class="hover:text-white cursor-pointer">Kebijakan Privasi</span>
                    <span class="hover:text-white cursor-pointer">Syarat & Ketentuan</span>
                    <span class="hover:text-white cursor-pointer">Protokol FPIC</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
