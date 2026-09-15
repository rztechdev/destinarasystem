@extends('layouts.public')

@section('title', 'Destinara — Menghidupkan Ruang Belajar Nyata di Balik Kehangatan Desa Nusantara')
@section('meta_description', 'Inisiatif pendidikan lapangan dan riset berbasis komunitas yang menjembatani kurikulum institusi pendidikan dengan kearifan tapak dan narasi hidup masyarakat adat di seluruh Nusantara.')

@section('content')
<div class="w-full bg-surface pb-16 lg:pb-0">
  <div class="flex flex-col w-full">

    <!-- ==================== SECTION 1: HERO DOKUMENTER DENGAN RGS OVERLAPPING PANEL ==================== -->
    <section class="relative w-full bg-surface pb-0 mb-0">
      <!-- Container Media Hero (Full-width dengan tinggi sinematik ala RGS) -->
      <div class="relative w-full h-[440px] sm:h-[520px] md:h-[580px] lg:h-[640px] xl:h-[700px] overflow-hidden bg-[#231917]">
        <img src="{{ asset('assets/img/hd/hero-home.jpg') }}" 
             alt="Dokumentasi Lapangan Destinara" 
             class="w-full h-full object-cover object-[center_20%] brightness-95"/>
        <!-- Gradasi pencahayaan halus ala RGS di bagian bawah -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#231917]/80 via-[#231917]/25 to-transparent pointer-events-none"></div>

        <!-- Garis Horizontal Melintang Penuh dari Kiri ke Kanan Layar ala RGS Cartographic -->
        <div class="rgs-hero-grid-h pointer-events-none"></div>

        <!-- RGS Image Citation Badge (Pojok Kanan Bawah Foto) -->
        <div class="absolute bottom-24 sm:bottom-32 lg:bottom-4 right-4 z-20 pointer-events-auto">
          <div class="inline-flex items-center gap-1.5 bg-[#231917]/80 backdrop-blur-sm text-white/90 px-3 py-1 text-[11px] font-sans transition-colors">
            <span class="w-4 h-4 rounded-full bg-white/20 inline-flex items-center justify-center text-[10px] font-bold italic font-serif">i</span>
            <span class="font-caption-fieldnote italic">Dokumentasi Tapak Aktif, Subak Abian & Hutan Karst Nusantara</span>
          </div>
        </div>
      </div>

      <!-- Content Area: Overlapping Card Panel Sejajar Kanan dengan Negative Margin -->
      <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 relative -mt-24 sm:-mt-32 lg:-mt-40 xl:-mt-44 z-20">
        <div class="rgs-hero-panel ml-auto lg:mr-12 xl:mr-16 w-full lg:max-w-[480px] xl:max-w-[520px] pt-6 sm:pt-8 px-6 sm:px-9 pb-12 sm:pb-16 block text-decoration-none">
          
          <span class="text-[11px] font-bold uppercase tracking-widest text-[#8C5151] block mb-2 font-sans">
            Inisiatif Pendidikan Lapangan & Riset
          </span>

          <!-- Judul Utama (Newsreader Serif Tebal / Bold) -->
          <h1 class="font-serif text-2xl sm:text-3xl lg:text-[28px] lg:leading-[36px] font-bold text-[#231917] tracking-tight mb-3">
            Menghidupkan Ruang Belajar Nyata di Balik Kehangatan Desa Nusantara
          </h1>

          <!-- Narasi Pengantar (Work Sans Kompak) -->
          <p class="text-xs sm:text-[14px] text-[#2B211E]/85 leading-relaxed mb-6 font-sans">
            Menjembatani kurikulum institusi pendidikan dengan kearifan tapak, ekologi lokal, dan narasi hidup masyarakat adat secara etis, transparan, dan terakreditasi.
          </p>

          <!-- Quick Search Bar Widget inside Panel -->
          <form action="{{ route('destinasi.index') }}" method="GET" class="space-y-3 pt-2 border-t border-[#2B211E]/15">
            <div class="relative">
              <input type="text" name="q" placeholder="Cari nama tapak, pulau, atau topik riset..." class="w-full text-xs pl-8 pr-3 py-2 bg-white/90 border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
              <span class="material-symbols-outlined absolute left-2 top-2 text-sm text-[#8C5151]">search</span>
            </div>
            <div class="flex items-center justify-between gap-2">
              <span class="text-[10px] text-[#735A5A] italic font-serif">Kintamani • Wonosadi • Sade</span>
              <button type="submit" class="rgs-btn rgs-btn-primary !py-1.5 !px-4 !text-xs">
                Cari Tapak
              </button>
            </div>
          </form>

          <!-- RGS Signature Circular Action Button (Pojok Kanan Bawah) -->
          <a href="{{ route('destinasi.index') }}" title="Jelajahi Seluruh Katalog" class="absolute bottom-3.5 right-3.5 sm:bottom-5 sm:right-6 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-[#8C5151] hover:bg-[#703A3A] text-white flex items-center justify-center transition-all duration-200 hover:scale-105 shadow-md">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
          </a>

        </div>
      </div>
    </section>

    <!-- ==================== SECTION 2: THE THREE GATEWAYS (RGS ROLE CARDS) ==================== -->
    <section class="w-full pt-10 sm:pt-14 pb-14 sm:pb-20 bg-surface">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="max-w-[820px] mb-10 sm:mb-12">
          <span class="text-xs font-bold uppercase tracking-widest text-[#8C5151] block mb-2 font-sans">
            Tiga Pintu Kemitraan Ekosistem
          </span>
          <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-[#231917] font-bold leading-snug">
            Dirancang Khusus untuk Kebutuhan Pembelajaran & Riset Anda
          </h2>
          <p class="mt-3 text-sm sm:text-base text-[#524343] leading-relaxed font-sans">
            Bukan sekadar wisata rekreasi biasa — Destinara menata kurikulum, kepastian logistik sanitasi, serta legalitas izin secara formal dan bermartabat.
          </p>
        </div>

        <!-- 3 Gateway Columns Grid (Format Editorial RGS) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 items-stretch border-b-2 border-[#8C5151]/35 overflow-hidden">
          
          <!-- Gateway 1: Sekolah & Madrasah -->
          <div class="rgs-card flex flex-col justify-between">
            <div>
              <!-- Header Gambar dengan Category Tag Pinned di Kiri Atas -->
              <div class="relative w-full h-[220px] overflow-hidden bg-[#fdeae5]">
                <span class="rgs-category-tag bg-[#8C5151] absolute top-3 left-0 z-10">
                  Study Tour & P5
                </span>
                <img src="{{ asset('assets/img/hd/story-ulin.jpg') }}" 
                     alt="Program Study Tour Sekolah" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
                <div class="absolute inset-0 bg-[#231917]/20 pointer-events-none"></div>
              </div>

              <!-- Content (Editorial & Flush) -->
              <div class="pt-5 pb-3 flex flex-col gap-3">
                <h3 class="font-serif text-xl sm:text-[22px] text-[#231917] font-bold">
                  Sekolah & Madrasah
                </h3>
                <p class="text-sm text-[#524343] leading-relaxed font-sans">
                  Solusi ekskursi berkeselamatan tinggi yang terintegrasi dengan modul Projek Penguatan Profil Pelajar Pancasila (P5) dan asesmen kontekstual.
                </p>

                <!-- Checklist Detail -->
                <div class="mt-2 pt-3 border-t border-[#2B211E]/10 space-y-2 text-xs sm:text-sm text-[#231917] font-sans">
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Struktur pembayaran terstandarisasi per rombongan</span>
                  </div>
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Penerbitan surat konfirmasi resmi & kwitansi instansi</span>
                  </div>
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Lembar kerja siswa & panduan asesmen lapangan</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Action Link Sitting on Border -->
            <div class="pt-4">
              <a href="{{ route('destinasi.index') }}" class="rgs-btn rgs-btn-primary w-full text-center">
                <span>Eksplorasi Paket Sekolah</span>
              </a>
            </div>
          </div>

          <!-- Gateway 2: Peneliti & Perguruan Tinggi -->
          <div class="rgs-card flex flex-col justify-between">
            <div>
              <div class="relative w-full h-[220px] overflow-hidden bg-[#fdeae5]">
                <span class="rgs-category-tag bg-[#51634b] absolute top-3 left-0 z-10">
                  Riset Lapangan
                </span>
                <img src="{{ asset('assets/img/hd/peneliti-sade.jpg') }}" 
                     alt="Program Penelitian Lapangan" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
                <div class="absolute inset-0 bg-[#231917]/20 pointer-events-none"></div>
              </div>

              <div class="pt-5 pb-3 flex flex-col gap-3">
                <h3 class="font-serif text-xl sm:text-[22px] text-[#231917] font-bold">
                  Akademisi & Peneliti
                </h3>
                <p class="text-sm text-[#524343] leading-relaxed font-sans">
                  Infrastruktur riset berbasis kearifan lokal. Akses data primer tapak, wawancara sesepuh adat, dan kliring etik protokol FPIC tanpa birokrasi berbelit.
                </p>

                <div class="mt-2 pt-3 border-t border-[#2B211E]/10 space-y-2 text-xs sm:text-sm text-[#231917] font-sans">
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Generator draf surat izin penelitian otomatis</span>
                  </div>
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Kliring etik protokol adat (FPIC) tervalidasi</span>
                  </div>
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Akses informan kunci & stasiun pengamatan</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-4">
              <a href="{{ route('cara-kerja') }}" class="rgs-btn rgs-btn-outline w-full text-center">
                <span>Pelajari Prosedur Riset</span>
              </a>
            </div>
          </div>

          <!-- Gateway 3: Mitra Desa & Balai Adat -->
          <div class="rgs-card flex flex-col justify-between">
            <div>
              <div class="relative w-full h-[220px] overflow-hidden bg-[#fdeae5]">
                <span class="rgs-category-tag bg-[#86580d] absolute top-3 left-0 z-10">
                  Kemitraan Tapak
                </span>
                <img src="{{ asset('assets/img/hd/hero-about.jpg') }}" 
                     alt="Kemitraan Pengelola Desa" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
                <div class="absolute inset-0 bg-[#231917]/20 pointer-events-none"></div>
              </div>

              <div class="pt-5 pb-3 flex flex-col gap-3">
                <h3 class="font-serif text-xl sm:text-[22px] text-[#231917] font-bold">
                  Mitra Pengelola Desa
                </h3>
                <p class="text-sm text-[#524343] leading-relaxed font-sans">
                  Membuka pintu kunjungan edukatif langsung bagi kelompok sadar wisata (Pokdarwis), sanggar kriya, dan BUMDes dengan sistem payout transparan.
                </p>

                <div class="mt-2 pt-3 border-t border-[#2B211E]/10 space-y-2 text-xs sm:text-sm text-[#231917] font-sans">
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Pelindungan hak kekayaan komunal & etika adat</span>
                  </div>
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Manajemen kalender slot kunjungan mandiri</span>
                  </div>
                  <div class="flex items-start gap-2">
                    <span class="text-[#51634b] font-bold">✓</span>
                    <span>Penyaluran dana langsung ke rekening desa</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-4">
              <a href="{{ route('register') }}" class="rgs-btn rgs-btn-outline w-full text-center">
                <span>Daftar Sebagai Mitra</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==================== SECTION 3: ALTERNATING EDITORIAL SHOWCASE ==================== -->
    <section class="w-full py-12 sm:py-16 bg-surface">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 mb-8 sm:mb-12">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-[#8C5151]/20 pb-4">
          <div>
            <span class="text-xs font-bold uppercase tracking-widest text-[#8C5151] block mb-1 font-sans">
              Katalog Terkurasi
            </span>
            <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-[#231917] font-bold">
              Destinasi Pembelajaran Pilihan Kurator
            </h2>
          </div>
          <a href="{{ route('destinasi.index') }}" class="text-xs font-bold uppercase tracking-wider text-[#8C5151] hover:underline flex items-center gap-1 font-sans">
            <span>Lihat Seluruh Direktori ({{ count($allDestinations) }})</span>
            <span class="material-symbols-outlined text-sm">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Alternating Showcase Rows -->
      <div class="flex flex-col w-full">
        @foreach($curatedDestinations as $index => $dest)
        <article class="w-full {{ $index % 2 === 0 ? 'bg-[#fff1ed]' : 'bg-surface' }} py-10 sm:py-14 border-y border-[#8C5151]/15">
          <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-8 sm:gap-12 items-center">
              
              <!-- Text Column -->
              <div class="col-span-12 lg:col-span-5 flex flex-col gap-4 {{ $index % 2 === 0 ? 'order-2 lg:order-1' : 'order-2' }}">
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="rgs-category-tag bg-[#51634b]">
                    {{ $dest['province'] }}
                  </span>
                  <span class="rgs-category-tag bg-[#8C5151]">
                    {{ $dest['category'] }}
                  </span>
                  <span class="flex items-center gap-0.5 text-xs font-bold text-[#86580d] ml-auto">
                    <span class="material-symbols-outlined text-sm">star</span> {{ $dest['rating'] }} ({{ $dest['reviews_count'] }})
                  </span>
                </div>

                <h3 class="font-serif text-2xl sm:text-3xl text-[#231917] font-bold leading-tight">
                  <a href="{{ route('destinasi.show', $dest['slug']) }}" class="hover:text-[#8C5151] transition-colors">
                    {{ $dest['name'] }}
                  </a>
                </h3>

                <p class="text-sm text-[#524343] leading-relaxed font-sans">
                  {{ $dest['highlights'] }}
                </p>

                <!-- Research & Module Focus Box -->
                <div class="p-3.5 bg-white/80 border-l-4 border-l-[#51634b] border-y border-r border-[#2B211E]/10 flex flex-col gap-1 text-xs">
                  <span class="font-bold uppercase tracking-wider text-[#51634b] font-sans">Muatan Unggulan Tapak</span>
                  <p class="text-[#231917] font-sans">
                    {{ implode(' • ', $dest['suitable_for']) }}
                  </p>
                </div>

                <!-- Footer of Card -->
                <div class="pt-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-t border-[#8C5151]/15">
                  <a href="{{ route('destinasi.show', $dest['slug']) }}" class="rgs-btn rgs-btn-outline !py-2 !px-5 self-start">
                    <span>Buka Silabus Tapak</span>
                  </a>
                  <div class="flex items-center gap-3 text-xs font-serif italic text-[#524343]">
                    <span class="font-sans font-bold not-italic text-[#703A3A]">{{ $dest['price_formatted'] }}</span>
                    <span>• Kapasitas {{ $dest['capacity'] }} org</span>
                  </div>
                </div>
              </div>

              <!-- Media Column -->
              <div class="col-span-12 lg:col-span-7 {{ $index % 2 === 0 ? 'order-1 lg:order-2' : 'order-1' }}">
                <div class="relative w-full aspect-[16/10] overflow-hidden border border-[#8C5151]/20 bg-[#fdeae5] group">
                  <img src="{{ $dest['image'] }}" alt="{{ $dest['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                  <div class="absolute inset-0 bg-gradient-to-t from-[#231917]/40 via-transparent to-transparent pointer-events-none"></div>
                  <span class="absolute bottom-3 left-3 px-3 py-1 bg-[#231917]/70 backdrop-blur-sm text-white text-xs font-serif italic">
                    {{ $dest['city'] }}, {{ $dest['province'] }}
                  </span>
                </div>
              </div>

            </div>
          </div>
        </article>
        @endforeach
      </div>
    </section>

    <!-- ==================== SECTION 4: CALL TO ACTION EDITORIAL ==================== -->
    <section class="w-full py-16 bg-[#2B211E] text-white">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center border-l-4 border-l-[#8C5151] pl-6 sm:pl-10">
          <div class="lg:col-span-8 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-[#D4E9CA] font-sans">
              Kemitraan Lapangan Resmi
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold leading-tight">
              Siap Merancang Silabus Studi Lapangan untuk Institusi Anda?
            </h2>
            <p class="text-sm sm:text-base text-[#D7C2C1] leading-relaxed max-w-2xl font-sans">
              Daftarkan akun institusi Anda untuk mengakses kalender slot ketersediaan tapak, mengajukan reservasi jadwal, dan mengunduh berkas dossier kurikulum resmi.
            </p>
          </div>
          <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3">
            <a href="{{ route('register') }}" class="rgs-btn rgs-btn-primary w-full text-center">
              <span>Daftar Akun Lapangan</span>
            </a>
            <a href="{{ route('cara-kerja') }}" class="rgs-btn rgs-btn-outline !border-white/30 !text-white hover:!bg-white hover:!text-[#2B211E] w-full text-center">
              <span>Pelajari Prosedur Kemitraan</span>
            </a>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
