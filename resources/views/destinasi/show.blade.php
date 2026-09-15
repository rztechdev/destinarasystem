@extends('layouts.public')

@section('title', $destination['name'] . ' — ' . $destination['city'] . ', ' . $destination['province'] . ' | Destinara')
@section('meta_description', $destination['highlights'])

@section('content')
<main class="w-full bg-surface pb-16 lg:pb-0" x-data="{
    peserta: 30,
    tipe: 'study_tour',
    basePrice: {{ $destination['price'] }},
    get guidePrice() { return this.tipe === 'study_tour' ? 250000 : 150000; },
    get subtotal() { return this.peserta * this.basePrice; },
    get total() { return this.subtotal + this.guidePrice; },
    formatRupiah(val) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(val);
    },
    activePhoto: '{{ $destination['gallery'][0] ?? $destination['image'] }}'
}">
  <div class="flex flex-col w-full">

    <!-- Header & Hero Dossier Top (RGS Style) -->
    <section class="w-full bg-[#fff1ed] py-10 md:py-14 border-b border-[#8C5151]/15">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-4">
        <a href="{{ route('destinasi.index') }}" class="inline-flex items-center gap-1.5 text-[#51634b] font-bold text-sm hover:underline font-sans">
          <span class="material-symbols-outlined text-[18px]">arrow_back</span>
          <span>Kembali ke Katalog Destinasi</span>
        </a>
        
        <div class="flex items-center gap-3 flex-wrap pt-1">
          <span class="rgs-category-tag bg-[#8C5151]">
            {{ $destination['category'] }}
          </span>
          <span class="rgs-category-tag bg-[#51634b]">
            {{ $destination['city'] }}, {{ $destination['province'] }}
          </span>
          <span class="text-xs uppercase tracking-wider font-bold text-[#51634b] font-sans">
            ✓ Terverifikasi Sesepuh Adat (FPIC)
          </span>
        </div>

        <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#231917] font-bold tracking-tight leading-tight">
          {{ $destination['name'] }}
        </h1>

        <p class="text-base md:text-lg text-[#524343] max-w-3xl leading-relaxed font-sans">
          {{ $destination['highlights'] }}
        </p>
      </div>
    </section>

    <!-- Main Content & Details (2 Kolom: Konten Kiri 8, Dossier Summary Kanan 4) -->
    <section class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-14 items-start">
        
        <!-- Content Column (Kiri 8) -->
        <div class="lg:col-span-8 flex flex-col gap-8">
          
          <!-- Interactive Photo Gallery -->
          <div class="space-y-3">
            <div class="relative w-full aspect-[16/9] overflow-hidden border border-[#8C5151]/20 bg-[#fdeae5]">
              <img :src="activePhoto" alt="{{ $destination['name'] }}" class="w-full h-full object-cover transition-all duration-300">
              <span class="absolute bottom-3 left-3 px-3 py-1 bg-[#231917]/70 backdrop-blur-sm text-white text-xs font-serif italic">
                Dokumentasi Lapangan Terverifikasi
              </span>
            </div>

            <!-- Sub Photo Thumbnails -->
            <div class="grid grid-cols-5 gap-2">
              @foreach($destination['gallery'] as $idx => $photo)
              <div @click="activePhoto = '{{ $photo }}'" 
                   class="aspect-[4/3] overflow-hidden border cursor-pointer transition-all"
                   :class="activePhoto === '{{ $photo }}' ? 'border-[#8C5151] ring-2 ring-[#8C5151]/40' : 'border-[#2B211E]/15 hover:border-[#8C5151]'">
                <img src="{{ $photo }}" alt="Foto {{ $idx + 1 }}" class="w-full h-full object-cover">
              </div>
              @endforeach
            </div>
          </div>

          <!-- Konteks Narasi Tapak -->
          <div class="flex flex-col gap-3 font-sans text-sm sm:text-base text-[#231917] leading-relaxed">
            <h3 class="font-serif text-2xl text-[#231917] font-bold">Konteks Narasi & Sejarah Tapak</h3>
            <p class="text-[#524343] leading-relaxed">
              {{ $destination['name'] }} merupakan ruang hidup komunal yang merawat keharmonisan antara kosmologi tradisi, tata kelola lingkungan lokal, dan kedaulatan warga. Destinara telah memfasilitasi integrasi pengetahuan tak benda ini agar dapat dipelajari langsung oleh peserta didik dan peneliti formal dengan menghormati martabat tetua adat.
            </p>
          </div>

          <!-- Focus Riset Box ala RGS -->
          <div class="p-6 bg-surface border-l-4 border-l-[#51634b] border-y border-r border-[#2B211E]/15 flex flex-col gap-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[#51634b] font-sans">Fokus Pembelajaran & Riset Lapangan</span>
            <p class="text-sm sm:text-base text-[#231917] leading-relaxed font-sans">
              {{ implode(' • ', $destination['suitable_for']) }}. Kajian empiris mencakup dokumentasi ekologi lokal, ketahanan pangan adat, dan arsitektur vernakular ramah gempa.
            </p>
          </div>

          <!-- 2 Modul Pembelajaran Lapangan -->
          <div class="space-y-4">
            <h3 class="font-serif text-2xl text-[#231917] font-bold">Kurikulum & Muatan Lapangan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="p-5 bg-white border border-[#2B211E]/15 space-y-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#8C5151] font-sans block">Modul Sekolah (P5)</span>
                <h4 class="font-serif font-bold text-lg text-[#231917]">Ekskursi & Refleksi Budaya</h4>
                <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
                  Siswa diajak mengamati siklus hidup desa, sistem gotong royong, dan mempraktikkan kearifan lokal bimbingan tetua adat.
                </p>
                <div class="pt-2 text-xs text-[#51634b] font-bold font-sans">
                  Output: Lembar refleksi & asesmen P5
                </div>
              </div>

              <div class="p-5 bg-white border border-[#2B211E]/15 space-y-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#51634b] font-sans block">Modul Akademisi & Riset</span>
                <h4 class="font-serif font-bold text-lg text-[#231917]">Penelitian Etnografi & Sains</h4>
                <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
                  Akses langsung informan kunci, pencatatan data biofisik lapangan, serta kliring etik protokol FPIC yang sah secara hukum.
                </p>
                <div class="pt-2 text-xs text-[#86580d] font-bold font-sans">
                  Output: Data primer & berita acara riset
                </div>
              </div>
            </div>
          </div>

          <!-- Fasilitas & Daya Dukung Lapangan -->
          <div class="space-y-3 pt-4 border-t border-[#8C5151]/15">
            <h3 class="font-serif text-2xl text-[#231917] font-bold">Fasilitas & Daya Dukung Kunjungan</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
              @foreach($destination['facilities'] as $fac)
              <div class="p-3 bg-white border border-[#2B211E]/15 flex items-center gap-2 text-xs sm:text-sm text-[#231917] font-sans font-medium">
                <span class="text-[#51634b] font-bold">✓</span>
                <span>{{ $fac }}</span>
              </div>
              @endforeach
            </div>
          </div>

          <!-- Pratinjau Kalender Akademik Slot Kunjungan -->
          <div class="space-y-3 pt-4 border-t border-[#8C5151]/15">
            <div class="flex items-center justify-between">
              <h3 class="font-serif text-2xl text-[#231917] font-bold">Pratinjau Ketersediaan Slot Tapak</h3>
              <span class="text-xs font-serif italic text-[#524343]">*Maks. 2 rombongan / hari</span>
            </div>

            <div class="bg-white p-5 border border-[#2B211E]/15 space-y-4">
              <div class="flex items-center justify-between text-xs font-bold text-[#231917] border-b border-[#2B211E]/10 pb-3 font-sans">
                <span>Bulan Berjalan (Kalender Akademik)</span>
                <div class="flex items-center gap-4 text-[11px]">
                  <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-[#d4e9ca] inline-block"></span> Slot Tersedia</span>
                  <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-[#fdeae5] inline-block"></span> Kuota Penuh</span>
                  <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-[#e8d6d1] inline-block"></span> Upacara Adat</span>
                </div>
              </div>

              <!-- Calendar Grid Mockup -->
              <div class="grid grid-cols-7 gap-2 text-center text-xs font-sans">
                <span class="font-bold text-[#735A5A] py-1">Sen</span>
                <span class="font-bold text-[#735A5A] py-1">Sel</span>
                <span class="font-bold text-[#735A5A] py-1">Rab</span>
                <span class="font-bold text-[#735A5A] py-1">Kam</span>
                <span class="font-bold text-[#735A5A] py-1">Jum</span>
                <span class="font-bold text-[#735A5A] py-1">Sab</span>
                <span class="font-bold text-[#735A5A] py-1">Min</span>

                @for($i = 1; $i <= 14; $i++)
                  @php
                    $isFull = in_array($i, [5, 6, 12]);
                    $isCeremony = in_array($i, [9]);
                  @endphp
                  <div class="py-2.5 border text-xs font-semibold
                    {{ $isFull ? 'bg-[#fdeae5] border-[#8C5151]/30 text-[#8C5151]' : ($isCeremony ? 'bg-[#f1dfd9] border-[#2B211E]/20 text-[#735A5A]' : 'bg-[#e8f0e4]/70 border-[#51634b]/30 text-[#51634b]') }}">
                    {{ $i }}
                    <span class="block text-[9px] font-normal {{ $isFull ? 'text-[#8C5151]' : ($isCeremony ? 'text-[#735A5A]' : 'text-[#51634b]') }}">
                      {{ $isFull ? 'Penuh' : ($isCeremony ? 'Adat' : 'Tersedia') }}
                    </span>
                  </div>
                @endfor
              </div>
            </div>
          </div>

          <!-- Protokol Etika FPIC Adat -->
          <div class="p-6 bg-white border border-[#2B211E]/15 space-y-2 text-xs sm:text-sm text-[#524343] font-sans leading-relaxed">
            <h4 class="font-serif text-lg text-[#231917] font-bold">Protokol Etika Tapak & Kepatuhan Adat (FPIC)</h4>
            <p>1. <strong>Pakaian Adat:</strong> Rombongan wajib mengenakan kain/selendang adat yang disediakan di pos gerbang masuk sebelum memasuki area sakral.</p>
            <p>2. <strong>Dokumentasi Tertib:</strong> Mengambil foto/video diperkenankan pada zona publik. Untuk upacara ritual internal keluarga adat, wajib memohon izin tetua.</p>
            <p>3. <strong>Bebas Sampah Plastik:</strong> Dilarang keras membawa kemasan plastik sekali pakai ke dalam kawasan hutan dan mata air.</p>
          </div>

        </div>

        <!-- Sidebar / Dossier Summary Plinth (Kanan 4 Sticky) -->
        <div class="lg:col-span-4 flex flex-col gap-6 sticky top-28">
          <div class="bg-surface p-6 sm:p-7 rounded-none border-t-4 border-t-[#8C5151] border-x border-b border-[#2B211E]/15 flex flex-col gap-5">
            
            <div>
              <span class="text-xs uppercase tracking-wider font-bold text-[#8C5151] font-sans block mb-1">
                Ringkasan Berkas Tapak (Dossier)
              </span>
              <div class="flex items-baseline gap-1">
                <span class="font-serif text-3xl font-bold text-[#231917]">{{ $destination['price_formatted'] }}</span>
                <span class="text-xs text-[#524343] font-sans">/ peserta didik</span>
              </div>
            </div>

            <!-- Metadata List -->
            <div class="flex flex-col gap-3 border-t border-[#2B211E]/10 pt-4 text-xs sm:text-sm font-sans">
              <div>
                <span class="text-[#735A5A] block text-[11px] uppercase tracking-wider">Wilayah Administratif</span>
                <span class="font-bold text-[#231917]">{{ $destination['city'] }}, {{ $destination['province'] }}</span>
              </div>
              <div>
                <span class="text-[#735A5A] block text-[11px] uppercase tracking-wider">Kategori Bentang Alam</span>
                <span class="font-bold text-[#231917] uppercase">{{ $destination['category'] }}</span>
              </div>
              <div>
                <span class="text-[#735A5A] block text-[11px] uppercase tracking-wider">Daya Tampung Maksimal</span>
                <span class="font-bold text-[#51634b]">{{ $destination['capacity'] }} Orang / Rombongan</span>
              </div>
              <div>
                <span class="text-[#735A5A] block text-[11px] uppercase tracking-wider">Kepatuhan Etika Adat</span>
                <span class="font-bold text-[#231917]">100% Sah Protokol FPIC</span>
              </div>
            </div>

            <!-- Booking Simulator Form Inputs -->
            <div class="space-y-4 pt-4 border-t border-[#2B211E]/10 font-sans">
              <div>
                <label class="block text-xs font-bold text-[#231917] uppercase tracking-wider mb-1.5">Tipe Kunjungan</label>
                <div class="grid grid-cols-2 gap-2">
                  <button type="button" @click="tipe = 'study_tour'" :class="tipe === 'study_tour' ? 'bg-[#8C5151] text-white font-bold' : 'bg-white text-[#524343] border border-[#2B211E]/15'" class="py-2 text-xs transition-all">
                    Study Tour
                  </button>
                  <button type="button" @click="tipe = 'riset'" :class="tipe === 'riset' ? 'bg-[#8C5151] text-white font-bold' : 'bg-white text-[#524343] border border-[#2B211E]/15'" class="py-2 text-xs transition-all">
                    Riset Lapang
                  </button>
                </div>
              </div>

              <div>
                <div class="flex items-center justify-between text-xs font-semibold text-[#231917] mb-1">
                  <span>Estimasi Peserta:</span>
                  <span class="font-bold text-[#8C5151]" x-text="peserta + ' Orang'"></span>
                </div>
                <input type="range" min="5" max="150" x-model="peserta" class="w-full accent-[#8C5151] cursor-pointer">
                <div class="flex justify-between text-[10px] text-[#735A5A]">
                  <span>Min. 5</span>
                  <span>Maks. 150</span>
                </div>
              </div>

              <!-- Realtime Cost Calculation -->
              <div class="p-3.5 bg-white border border-[#2B211E]/15 space-y-1.5 text-xs">
                <div class="flex justify-between text-[#524343]">
                  <span>Retribusi Tapak (<span x-text="peserta"></span> org):</span>
                  <span class="font-semibold" x-text="formatRupiah(subtotal)"></span>
                </div>
                <div class="flex justify-between text-[#524343]">
                  <span>Jasa Pemandu Adat:</span>
                  <span class="font-semibold" x-text="formatRupiah(guidePrice)"></span>
                </div>
                <div class="flex justify-between text-sm font-bold text-[#231917] pt-2 border-t border-[#2B211E]/10">
                  <span>Estimasi Total:</span>
                  <span class="text-[#703A3A]" x-text="formatRupiah(total)"></span>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-2 flex flex-col gap-3 font-sans">
              @auth
                @if(Auth::user()->role === 'buyer')
                  <a href="{{ route('buyer.booking.create', ['tapak' => $destination['slug']]) }}" class="rgs-btn rgs-btn-primary w-full text-center flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                    <span>Lanjut Buat Booking Rombongan</span>
                  </a>
                @else
                  <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="rgs-btn rgs-btn-primary w-full text-center flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    <span>Buka Konsol {{ ucfirst(Auth::user()->role) }}</span>
                  </a>
                @endif
              @else
                <a href="{{ route('login') }}" class="rgs-btn rgs-btn-primary w-full text-center flex items-center justify-center gap-2">
                  <span class="material-symbols-outlined text-[18px]">login</span>
                  <span>Masuk untuk Ajukan Reservasi Jadwal</span>
                </a>
              @endauth
              <button type="button" @click="alert('Berkas Dossier Kurikulum Lapangan {{ addslashes($destination['name']) }} sedang disiapkan untuk diunduh.')" class="rgs-btn rgs-btn-outline w-full text-center flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">download</span>
                <span>Unduh Dossier PDF</span>
              </button>
            </div>

            <div class="p-3 bg-[#e8f0e4] border border-[#51634b]/20 text-xs text-[#51634b] font-sans space-y-1">
              <span class="font-bold block">✓ Akuntabilitas Keuangan Desa</span>
              <p class="text-[11px] leading-relaxed">Dana disalurkan langsung ke rekening penampung resmi dan diteruskan ke BUMDes adat setelah kegiatan selesai.</p>
            </div>

          </div>
        </div>

      </div>
    </section>

  </div>
</main>
@endsection
