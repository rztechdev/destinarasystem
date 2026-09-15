@extends('layouts.public')

@section('title', 'Alur & Cara Kerja Kemitraan Edukasi Lapangan — Destinara')
@section('meta_description', 'Protokol kemitraan edukasi lapangan yang transparan, aman, dan sah secara hukum antara sekolah, universitas, dan pengelola tapak adat.')

@section('content')
<main class="w-full bg-surface pb-16 lg:pb-0">
  <div class="flex flex-col w-full">

    <!-- Top Curatorial Header (RGS Style) -->
    <section class="w-full bg-[#fff1ed] py-10 md:py-14 border-b border-[#8C5151]/15">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="font-serif italic text-sm sm:text-base text-[#51634b] block">
          Protokol Operasional & Tata Kelola Lapangan
        </span>
        <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#231917] font-bold tracking-tight max-w-4xl mx-auto leading-tight">
          Alur Kemitraan Edukasi Lapangan yang Transparan, Aman, dan Sah Secara Hukum
        </h1>
        <p class="text-sm sm:text-base text-[#524343] max-w-2xl mx-auto leading-relaxed font-sans">
          Menjembatani tuntutan akuntabilitas kurikulum sekolah formal dengan penghormatan tulus terhadap kearifan tetua adat di seluruh pelosok Nusantara.
        </p>
      </div>
    </section>

    <!-- 4 Langkah Prosedur Format Editorial Plinth -->
    <section class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-18">
      <div class="max-w-[800px] mb-10">
        <span class="text-xs font-bold uppercase tracking-widest text-[#8C5151] block mb-1 font-sans">
          Alur End-to-End
        </span>
        <h2 class="font-serif text-2xl sm:text-3xl text-[#231917] font-bold">
          Empat Tahapan Prosedur Kunjungan Rombongan
        </h2>
        <p class="text-sm text-[#524343] mt-2 font-sans">
          Didesain tanpa alur birokrasi manual yang berbelit — dari kurasi awal hingga pencairan dana ke BUMDes tapak.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Step 1 -->
        <div class="bg-surface p-6 border-t-4 border-t-[#8C5151] border-x border-b border-[#2B211E]/15 flex flex-col justify-between gap-4">
          <div class="space-y-3">
            <span class="font-serif text-3xl font-bold text-[#8C5151] block leading-none">01</span>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[#51634b] font-sans block">Tahap Eksplorasi</span>
            <h3 class="font-serif text-lg font-bold text-[#231917]">Reservasi Jadwal & Kuota</h3>
            <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
              Institusi memilih tapak terakreditasi, mencocokkan kalender slot akademik, dan menentukan estimasi jumlah peserta rombongan.
            </p>
          </div>
          <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-serif italic text-[#51634b]">
            Proses: Realtime Slot Kunjungan
          </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-surface p-6 border-t-4 border-t-[#51634b] border-x border-b border-[#2B211E]/15 flex flex-col justify-between gap-4">
          <div class="space-y-3">
            <span class="font-serif text-3xl font-bold text-[#51634b] block leading-none">02</span>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[#51634b] font-sans block">Tahap Verifikasi</span>
            <h3 class="font-serif text-lg font-bold text-[#231917]">Konfirmasi Mitra & Invoice</h3>
            <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
              Pengelola desa memvalidasi kesiapan homestay dan jadwal pendampingan tetua adat. Sistem otomatis menerbitkan invoice instansi.
            </p>
          </div>
          <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-serif italic text-[#51634b]">
            Proses: Maks. 1x24 Jam Kerja
          </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-surface p-6 border-t-4 border-t-[#86580d] border-x border-b border-[#2B211E]/15 flex flex-col justify-between gap-4">
          <div class="space-y-3">
            <span class="font-serif text-3xl font-bold text-[#86580d] block leading-none">03</span>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[#86580d] font-sans block">Tahap Pembayaran</span>
            <h3 class="font-serif text-lg font-bold text-[#231917]">Escrow Aman Terproteksi</h3>
            <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
              Pembayaran diproses melalui rekening penampung resmi (Virtual Account, Bank Transfer, QRIS) dengan bukti setor sah bendahara BOS.
            </p>
          </div>
          <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-serif italic text-[#86580d]">
            Proses: Rekening Penampung Resmi
          </div>
        </div>

        <!-- Step 4 -->
        <div class="bg-surface p-6 border-t-4 border-t-[#703A3A] border-x border-b border-[#2B211E]/15 flex flex-col justify-between gap-4">
          <div class="space-y-3">
            <span class="font-serif text-3xl font-bold text-[#703A3A] block leading-none">04</span>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[#703A3A] font-sans block">Tahap Pelaksanaan</span>
            <h3 class="font-serif text-lg font-bold text-[#231917]">Kegiatan & Penyaluran Desa</h3>
            <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
              Rombongan belajar di tapak. Setelah program terlaksana dan divalidasi, dana diteruskan secara transparan ke BUMDes adat setempat.
            </p>
          </div>
          <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-serif italic text-[#703A3A]">
            Proses: Rekonsiliasi Otomatis
          </div>
        </div>

      </div>
    </section>

    <!-- 3 Pilar Landasan Etika Lapangan (Editorial Showcase) -->
    <section class="w-full bg-[#fff1ed] py-14 md:py-18 border-y border-[#8C5151]/15">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-[800px] mb-10">
          <span class="text-xs font-bold uppercase tracking-widest text-[#51634b] block mb-1 font-sans">
            Landasan Komitmen
          </span>
          <h2 class="font-serif text-2xl sm:text-3xl text-[#231917] font-bold">
            Tiga Komitmen Fundamental Menjaga Kualitas & Etika
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="bg-white p-7 border border-[#2B211E]/15 flex flex-col justify-between gap-4">
            <div class="space-y-3">
              <span class="material-symbols-outlined text-3xl text-[#8C5151]">health_and_safety</span>
              <h3 class="font-serif text-xl font-bold text-[#231917]">Standar Keselamatan Lapangan</h3>
              <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
                Audit fasilitas mencakup sanitasi air bersih, jalur evakuasi bencana, koordinasi fasilitas kesehatan terdekat, serta perlindungan asuransi rombongan.
              </p>
            </div>
            <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-sans font-bold text-[#8C5151]">
              Audit berkala per semester
            </div>
          </div>

          <div class="bg-white p-7 border border-[#2B211E]/15 flex flex-col justify-between gap-4">
            <div class="space-y-3">
              <span class="material-symbols-outlined text-3xl text-[#51634b]">handshake</span>
              <h3 class="font-serif text-xl font-bold text-[#231917]">Protokol Etika Adat (FPIC)</h3>
              <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
                Prinsip <em>Free, Prior, and Informed Consent</em> memastikan tidak ada eksploitasi pengetahuan sakral. Tetua berhak membatasi zona tertentu demi kelestarian adat.
              </p>
            </div>
            <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-sans font-bold text-[#51634b]">
              Perlindungan kearifan tak benda
            </div>
          </div>

          <div class="bg-white p-7 border border-[#2B211E]/15 flex flex-col justify-between gap-4">
            <div class="space-y-3">
              <span class="material-symbols-outlined text-3xl text-[#86580d]">gavel</span>
              <h3 class="font-serif text-xl font-bold text-[#231917]">Keabsahan Dokumen BOS & Riset</h3>
              <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
                Dokumentasi resmi surat izin survei, nota kesepahaman (MoU) kemitraan, dan kuitansi bermeterai yang sah dipertanggungjawabkan pada audit instansi pemerintah.
              </p>
            </div>
            <div class="pt-3 border-t border-[#2B211E]/10 text-xs font-sans font-bold text-[#86580d]">
              Standar akuntabilitas notaris
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- Narasi Lapangan Dokumenter -->
    <section class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-18">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <div class="lg:col-span-6 space-y-4">
          <span class="text-xs font-bold uppercase tracking-widest text-[#8C5151] font-sans">
            Misi Kebangsaan
          </span>
          <h2 class="font-serif text-3xl sm:text-4xl text-[#231917] font-bold leading-tight">
            Menghubungkan Ruang Kelas dengan Realitas Tanah Air
          </h2>
          <p class="text-sm sm:text-base text-[#524343] leading-relaxed font-sans">
            "Pendidikan lapangan bukan sekadar tamasya di luar kelas. Ketika siswa duduk beralas tikar di balai desa, menyimak sesepuh memilah tanaman obat, mereka tidak hanya belajar biologi — mereka belajar mencintai dan merawat martabat tanah airnya."
          </p>
          <div class="pt-2 font-sans">
            <span class="text-sm font-bold text-[#231917] block">Tim Kurasi Lapang Destinara</span>
            <span class="text-xs text-[#735A5A]">Yogyakarta & Flores, Indonesia</span>
          </div>
        </div>

        <div class="lg:col-span-6 grid grid-cols-2 gap-4">
          <div class="aspect-[4/3] overflow-hidden border border-[#8C5151]/20">
            <img src="{{ asset('assets/img/hd/sekolah-diskusi.jpg') }}" alt="Diskusi Siswa" class="w-full h-full object-cover">
          </div>
          <div class="aspect-[4/3] overflow-hidden border border-[#8C5151]/20 mt-6">
            <img src="{{ asset('assets/img/hd/peneliti-wawancara.jpg') }}" alt="Wawancara Lapangan" class="w-full h-full object-cover">
          </div>
        </div>
      </div>
    </section>

    <!-- Bottom CTA -->
    <section class="w-full py-16 bg-[#2B211E] text-white">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 border-l-4 border-l-[#8C5151] pl-6 sm:pl-10">
          <div class="space-y-2 max-w-xl">
            <h3 class="font-serif text-3xl font-bold">Siap Mengawali Kemitraan Tapak?</h3>
            <p class="text-sm text-[#D7C2C1] leading-relaxed font-sans">
              Bergabunglah bersama puluhan sekolah dan kampus yang telah mengagendakan pembelajaran lapangan bersama Destinara.
            </p>
          </div>
          <a href="{{ route('register') }}" class="rgs-btn rgs-btn-primary">
            <span>Daftar Akun Lapangan</span>
          </a>
        </div>
      </div>
    </section>

  </div>
</main>
@endsection
