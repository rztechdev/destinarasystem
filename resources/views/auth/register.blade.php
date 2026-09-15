<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-surface">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Akun Lapangan — Destinara</title>

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
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-10 antialiased selection:bg-[#8C5151] selection:text-white" x-data="{ role: 'buyer' }">

    <div class="max-w-6xl w-full bg-white border border-[#2B211E]/20 shadow-xl grid grid-cols-1 lg:grid-cols-12 min-h-[640px]">
        
        <!-- Left Panel: Dark Obsidian Maron Branding -->
        <div class="lg:col-span-5 bg-[#2B211E] text-white p-8 sm:p-12 flex flex-col justify-between relative overflow-hidden border-b lg:border-b-0 lg:border-r border-[#8C5151]/30">
            <!-- Top Brand -->
            <div class="space-y-6 relative z-10">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/img/logo-mark-tight.png') }}" alt="Destinara Logo" class="w-10 h-10 object-contain drop-shadow-md">
                    <div>
                        <span class="font-serif text-2xl font-bold tracking-tight text-white block leading-none">DESTINARA</span>
                        <span class="text-[10px] tracking-widest text-[#D4E9CA] uppercase font-semibold font-sans">Ruang Belajar Tapak Nusantara</span>
                    </div>
                </a>

                <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#8C5151] text-[#FDEAE5] text-xs font-semibold uppercase tracking-wider font-sans">
                    <span class="w-1.5 h-1.5 bg-[#D4E9CA]"></span>
                    <span>Pintu Masuk Resmi Ekosistem</span>
                </div>

                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight">
                    Menghubungkan Ruang Kelas dengan Laboratorium Alam Nusantara.
                </h2>

                <div class="p-5 bg-white/5 border-l-4 border-l-[#8C5151] text-xs sm:text-sm text-[#FDEAE5] space-y-2 font-sans">
                    <p class="italic font-serif leading-relaxed text-sm">
                        "Destinara merampingkan birokrasi perizinan riset, sehingga guru dan mahasiswa dapat fokus menggali kearifan lokal secara etis, aman, dan terlindungi hukum."
                    </p>
                    <div class="font-semibold text-white font-sans text-xs pt-1">
                        Tim Kurasi Lapang Destinara
                    </div>
                </div>
            </div>

            <!-- Bottom Stats -->
            <div class="pt-8 border-t border-white/10 grid grid-cols-3 gap-4 text-center relative z-10 mt-8 lg:mt-0 font-sans">
                <div>
                    <span class="text-xl font-serif font-bold text-white block">15+</span>
                    <span class="text-[10px] text-[#D7C2C1] uppercase tracking-wider">Desa Mitra</span>
                </div>
                <div>
                    <span class="text-xl font-serif font-bold text-[#D4E9CA] block">1.200+</span>
                    <span class="text-[10px] text-[#D7C2C1] uppercase tracking-wider">Pelajar & Riset</span>
                </div>
                <div>
                    <span class="text-xl font-serif font-bold text-[#FFD7A7] block">100%</span>
                    <span class="text-[10px] text-[#D7C2C1] uppercase tracking-wider">Legalitas FPIC</span>
                </div>
            </div>
        </div>

        <!-- Right Panel: Registration Form -->
        <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white space-y-6">
            
            <!-- Top Switch: Masuk vs Daftar -->
            <div class="flex items-center justify-between border-b border-[#2B211E]/15 pb-4 font-sans">
                <div class="flex items-center gap-6">
                    <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-wider text-[#735A5A] hover:text-[#703A3A] pb-1">
                        Masuk Akun
                    </a>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#8C5151] border-b-2 border-[#8C5151] pb-1">
                        Daftar Akun Baru
                    </span>
                </div>
                <a href="{{ route('home') }}" class="text-xs text-[#8C5151] hover:underline flex items-center gap-1 font-semibold">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            <div>
                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-[#231917]">Pendaftaran Akun Lapangan</h3>
                <p class="text-xs sm:text-sm text-[#524343] mt-1 font-sans">Pilih peran akun Anda untuk memulai proses kurasi dan ekspedisi tapak.</p>
            </div>

            <!-- Role Selector (Buyer vs Partner) -->
            <div class="space-y-2 font-sans">
                <label class="block text-xs font-bold text-[#231917] uppercase tracking-wider">Pilih Tipe Pengguna</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div @click="role = 'buyer'" :class="role === 'buyer' ? 'border-[#8C5151] bg-[#fff1ed] ring-1 ring-[#8C5151]' : 'border-[#2B211E]/20 bg-white hover:bg-[#fff8f6]'" class="p-3.5 border cursor-pointer transition-all flex items-start gap-3">
                        <input type="radio" name="role_select" value="buyer" :checked="role === 'buyer'" class="mt-1 text-[#8C5151] focus:ring-[#8C5151]">
                        <div>
                            <span class="font-bold text-xs text-[#231917] block">Instansi Pendidikan</span>
                            <span class="text-[11px] text-[#524343] block mt-0.5">Sekolah, Kampus, Guru, Dosen, & Peneliti (Buyer)</span>
                        </div>
                    </div>
                    <div @click="role = 'partner'" :class="role === 'partner' ? 'border-[#8C5151] bg-[#fff1ed] ring-1 ring-[#8C5151]' : 'border-[#2B211E]/20 bg-white hover:bg-[#fff8f6]'" class="p-3.5 border cursor-pointer transition-all flex items-start gap-3">
                        <input type="radio" name="role_select" value="partner" :checked="role === 'partner'" class="mt-1 text-[#8C5151] focus:ring-[#8C5151]">
                        <div>
                            <span class="font-bold text-xs text-[#231917] block">Pengelola Destinasi</span>
                            <span class="text-[11px] text-[#524343] block mt-0.5">Desa Wisata, Adat, & Sanggar Kriya (Mitra)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Form Inputs -->
            <form onsubmit="event.preventDefault(); alert('Pendaftaran berhasil disimulasikan! Menuju panel pengguna...'); window.location.href='{{ route('home') }}';" class="space-y-4 font-sans">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#231917] mb-1">Nama Lengkap PIC</label>
                        <input type="text" required placeholder="Contoh: Ryan Prasetya" class="w-full text-xs p-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#231917] mb-1" x-text="role === 'buyer' ? 'Nama Sekolah / Kampus' : 'Nama Desa / Sanggar'"></label>
                        <input type="text" required placeholder="Contoh: SMA Negeri 1 / Desa Penglipuran" class="w-full text-xs p-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[#231917] mb-1">Email Resmi</label>
                        <input type="email" required placeholder="nama@instansi.sch.id" class="w-full text-xs p-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#231917] mb-1">Nomor WhatsApp</label>
                        <input type="tel" required placeholder="0812-xxxx-xxxx" class="w-full text-xs p-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#231917] mb-1">Kata Sandi Akun</label>
                    <input type="password" required placeholder="Minimal 8 karakter" class="w-full text-xs p-2.5 bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
                </div>

                <div class="flex items-start gap-2 pt-1">
                    <input type="checkbox" required id="tos" class="mt-0.5 border-[#2B211E]/20 text-[#8C5151] focus:ring-[#8C5151]">
                    <label for="tos" class="text-[11px] text-[#524343] leading-tight">
                        Saya menyetujui <a href="#" class="text-[#8C5151] font-semibold underline">Syarat & Ketentuan</a> serta bersedia mematuhi <a href="#" class="text-[#8C5151] font-semibold underline">Protokol Etika Tapak Destinara</a>.
                    </label>
                </div>

                <button type="submit" class="rgs-btn rgs-btn-primary w-full text-center !py-3">
                    <span>Daftar Akun Sekarang &rarr;</span>
                </button>
            </form>

            <div class="pt-2 text-center text-xs text-[#524343] font-sans">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-[#8C5151] font-bold hover:underline">Masuk ke Sistem</a>
            </div>

        </div>

    </div>

</body>
</html>
