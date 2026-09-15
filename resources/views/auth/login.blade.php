<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-surface">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Akun — Destinara</title>

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
        body { font-family: 'Work Sans', sans-serif; }
        .font-serif { font-family: 'Newsreader', serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 antialiased selection:bg-[#8C5151] selection:text-white relative bg-surface">

    <!-- Centered Login Card (Editorial Plinth) -->
    <div class="max-w-md w-full bg-white p-8 sm:p-10 border-t-4 border-t-[#8C5151] border-x border-b border-[#2B211E]/20 shadow-xl relative z-10 space-y-6">
        
        <!-- Header & Logo -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 group mb-2">
                <img src="{{ asset('assets/img/logo-mark-tight.png') }}" alt="Logo Destinara" class="w-12 h-12 object-contain group-hover:scale-105 transition-transform">
            </a>
            <div>
                <span class="font-serif text-2xl font-bold tracking-tight text-[#4A2020] block">DESTINARA</span>
                <span class="text-[10px] tracking-widest text-[#8C5151] uppercase font-bold font-sans">Ruang Belajar Tapak Nusantara</span>
            </div>
            <h2 class="font-serif text-2xl font-bold text-[#231917] pt-2">Masuk Akun Lapangan</h2>
            <p class="text-xs sm:text-sm text-[#524343] font-sans">
                Akses reservasi jadwal institusi, kalender slot mitra tapak, atau panel kurasi.
            </p>
        </div>

        <!-- Form Login -->
        <form onsubmit="event.preventDefault(); alert('Login berhasil disimulasikan! Menuju dashboard...'); window.location.href='{{ route('home') }}';" class="space-y-4 font-sans">
            
            <div>
                <label class="block text-xs font-bold text-[#231917] mb-1">Email Resmi Terdaftar</label>
                <div class="relative">
                    <input type="email" required placeholder="nama@instansi.sch.id" class="w-full text-xs pl-9 pr-3 py-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                    <span class="material-symbols-outlined absolute left-2.5 top-2.5 text-base text-[#8C5151]">mail</span>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#231917] mb-1">Kata Sandi</label>
                <div class="relative">
                    <input type="password" required placeholder="Masukkan kata sandi" class="w-full text-xs pl-9 pr-3 py-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                    <span class="material-symbols-outlined absolute left-2.5 top-2.5 text-base text-[#8C5151]">lock</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-1.5 text-[#524343] cursor-pointer">
                    <input type="checkbox" class="border-[#2B211E]/20 text-[#8C5151] focus:ring-[#8C5151]">
                    <span>Ingat saya</span>
                </label>
                <a href="#" onclick="alert('Alur pemulihan sandi: Masukkan email instansi untuk menerima tautan.')" class="text-[#8C5151] font-semibold hover:underline">
                    Lupa sandi?
                </a>
            </div>

            <button type="submit" class="rgs-btn rgs-btn-primary w-full text-center !py-3">
                <span>Masuk ke Sistem &rarr;</span>
            </button>
        </form>

        <!-- Quick Demo Access for Evaluator -->
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-[10px] text-[#2B211E]/40 uppercase tracking-wider font-bold">
                <div class="h-px bg-[#2B211E]/15 flex-1"></div>
                <span>Akses Pengujian Cepat</span>
                <div class="h-px bg-[#2B211E]/15 flex-1"></div>
            </div>
            <a href="{{ route('buyer.quick-login') }}" class="w-full py-2.5 px-4 bg-[#faf6f0] hover:bg-[#703A3A] hover:text-white border border-[#703A3A]/40 text-[#703A3A] text-xs font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-base">school</span>
                <span>Masuk Cepat Demo: Buyer Institusi</span>
            </a>
            <a href="{{ route('mitra.quick-login') }}" class="w-full py-2.5 px-4 bg-[#faf6f0] hover:bg-[#51634b] hover:text-white border border-[#51634b]/40 text-[#51634b] text-xs font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-base">nature_people</span>
                <span>Masuk Cepat Demo: Mitra Pengelola Tapak</span>
            </a>
            <a href="{{ route('admin.quick-login') }}" class="w-full py-2.5 px-4 bg-[#faf6f0] hover:bg-[#2B3A4A] hover:text-white border border-[#2B3A4A]/40 text-[#2B3A4A] text-xs font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                <span>Masuk Cepat Demo: Admin Operasional</span>
            </a>
            <a href="{{ route('superadmin.quick-login') }}" class="w-full py-2.5 px-4 bg-[#faf6f0] hover:bg-[#4A1E1E] hover:text-white border border-[#4A1E1E]/40 text-[#4A1E1E] text-xs font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-base">shield</span>
                <span>Masuk Cepat Demo: Super Admin</span>
            </a>
        </div>

        <!-- Institutional Security Notice -->
        <div class="p-3 bg-[#fff1ed] border border-[#8C5151]/20 text-[11px] text-[#524343] flex items-center gap-2 font-sans">
            <span class="material-symbols-outlined text-sm text-[#51634b]">security</span>
            <span>Autentikasi terenkripsi & data institusi terproteksi</span>
        </div>

        <!-- Footer link -->
        <div class="pt-2 border-t border-[#2B211E]/15 text-center text-xs space-y-2 font-sans">
            <p class="text-[#524343]">
                Belum memiliki akun? <a href="{{ route('register') }}" class="text-[#8C5151] font-bold hover:underline">Daftar Akun Baru</a>
            </p>
            <a href="{{ route('home') }}" class="inline-block text-[11px] text-[#735A5A] hover:text-[#703A3A]">
                &larr; Kembali ke Beranda
            </a>
        </div>

    </div>

</body>
</html>
