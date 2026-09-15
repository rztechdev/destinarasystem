@extends('layouts.public')

@section('title', 'Direktori Destinasi Tapak Terkurasi — Destinara')
@section('meta_description', 'Inventaris dan direktori desa adat serta tapak pembelajaran terkurasi di seluruh Nusantara untuk ekskursi sekolah, penelitian botani, hingga kajian antropologi adat.')

@section('content')
<main class="w-full bg-surface pb-16 lg:pb-0">
  <div class="flex flex-col w-full">
    
    <!-- Top Marketplace Hero & Search Bar (Ala Traveloka / Airbnb Edukasi) -->
    <section class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 w-full pt-8 sm:pt-12 pb-6 sm:pb-8">
      <div class="grid grid-cols-12 gap-6 items-end">
        <div class="col-span-12 lg:col-span-8 flex flex-col gap-2">
          <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#51634b]/15 text-[#51634b] text-xs font-semibold uppercase tracking-wider font-sans">
              <span class="w-1.5 h-1.5 bg-[#51634b]"></span>
              <span>Etalase Resmi Terakreditasi {{ date('Y') }}</span>
            </span>
            <span class="hidden sm:inline-flex text-xs text-[#735A5A] font-sans">
              • Protokol FPIC Lembaga Adat 100% Sah
            </span>
          </div>
          <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#231917] font-bold tracking-tight leading-tight">
            Etalase Tapak & Laboratorium Alam Nusantara
          </h1>
        </div>
        <div class="col-span-12 lg:col-span-4 pb-1">
          <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
            Temukan dan pesan desa adat serta tapak konservasi terverifikasi untuk ekskursi sekolah (Proyek P5), riset etnobotani, hingga live-in dengan dokumen izin resmi dan pertanggungjawaban dana BOS.
          </p>
        </div>
      </div>

      <!-- Marketplace Filter & Search Console -->
      <div class="mt-8 bg-surface p-4 sm:p-5 border border-[#8C5151]/20 flex flex-col gap-4 shadow-xs">
        <!-- Search Input Bar with Filter Parameters -->
        <form action="{{ route('destinasi.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
          @if(request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          
          <!-- Keyword Input -->
          <div class="relative sm:col-span-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama tapak, pulau, atau topik riset..." class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm bg-white border border-[#2B211E]/20 text-[#2B2323] focus:outline-none focus:border-[#8C5151]">
            <span class="material-symbols-outlined absolute left-2.5 top-3 text-base text-[#8C5151]">search</span>
          </div>

          <!-- Province Selector -->
          <div class="sm:col-span-3">
            <select name="province" class="w-full p-2.5 border border-[#2B211E]/20 text-xs sm:text-sm bg-white text-[#2B2323] focus:outline-none cursor-pointer">
              <option value="">Semua Provinsi</option>
              @foreach($provinces as $prov)
              <option value="{{ $prov }}" {{ request('province') === $prov ? 'selected' : '' }}>{{ $prov }}</option>
              @endforeach
            </select>
          </div>

          <!-- Sort & Action Button -->
          <div class="sm:col-span-3 flex items-center gap-2">
            <select name="sort" class="w-full p-2.5 border border-[#2B211E]/20 text-xs sm:text-sm bg-white text-[#2B2323] focus:outline-none cursor-pointer">
              <option value="popular" {{ request('sort') == 'popular' || !request('sort') ? 'selected' : '' }}>Terpopuler</option>
              <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>Tarif Terendah</option>
              <option value="highest_capacity" {{ request('sort') == 'highest_capacity' ? 'selected' : '' }}>Kapasitas Terbesar</option>
            </select>
            <button type="submit" class="rgs-btn rgs-btn-primary !py-2.5 !px-5 !text-xs shrink-0 flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[16px]">filter_alt</span>
              <span>Cari</span>
            </button>
            @if(request('q') || request('category') || request('province') || request('sort'))
            <a href="{{ route('destinasi.index') }}" class="text-xs text-[#8C5151] hover:underline font-semibold font-sans px-1 shrink-0" title="Reset Filter">
              Reset
            </a>
            @endif
          </div>
        </form>

        <!-- Category Pills (Sharp Editorial RGS) -->
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-1 w-full flex-nowrap pt-2 border-t border-[#8C5151]/15">
          <a href="{{ route('destinasi.index', array_filter(['q' => request('q'), 'province' => request('province'), 'sort' => request('sort')])) }}" class="flex-shrink-0 whitespace-nowrap px-4 py-2 {{ !request('category') ? 'bg-[#8C5151] text-white font-bold' : 'text-[#231917] bg-white hover:bg-[#fdeae5] border border-[#2B211E]/15' }} text-xs uppercase tracking-wider font-sans transition-all min-h-[36px] flex items-center">
            Semua Kategori
          </a>
          @foreach($categories as $code => $label)
          <a href="{{ route('destinasi.index', array_filter(['category' => $code, 'q' => request('q'), 'province' => request('province'), 'sort' => request('sort')])) }}" class="flex-shrink-0 whitespace-nowrap px-4 py-2 {{ request('category') === $code ? 'bg-[#8C5151] text-white font-bold' : 'text-[#231917] bg-white hover:bg-[#fdeae5] border border-[#2B211E]/15' }} text-xs uppercase tracking-wider font-sans transition-all min-h-[36px] flex items-center">
            {{ $label }}
          </a>
          @endforeach
        </div>

        <!-- Verification Counter Strip -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 px-1 text-xs text-[#51634b] font-medium pt-2 border-t border-[#8C5151]/15 font-serif italic">
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 bg-[#51634b] inline-block"></span>
            <span>Menampilkan <strong>{{ count($destinations) }} tapak aktif</strong> terverifikasi dewan kurator & sesepuh adat</span>
          </div>
          <div class="flex items-center gap-3 font-sans not-italic text-[11px] text-[#735A5A]">
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px] text-[#51634b]">verified</span> FPIC Sah</span>
            <span>•</span>
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px] text-[#703A3A]">receipt_long</span> Sesuai Juknis BOS</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Destination Cards Grid / Alternating Editorial Sections -->
    <div class="flex flex-col w-full pb-16">
      @forelse($destinations as $index => $dest)
        <section class="w-full {{ $index % 2 === 0 ? 'bg-[#fff1ed]' : 'bg-surface' }} py-10 sm:py-14 border-y border-[#8C5151]/10">
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
                    <span class="material-symbols-outlined text-sm">star</span> {{ $dest['rating'] }} ({{ $dest['reviews_count'] }} ulasan)
                  </span>
                </div>

                <h2 class="font-serif text-2xl sm:text-3xl text-[#231917] font-bold leading-tight">
                  <a href="{{ route('destinasi.show', $dest['slug']) }}" class="hover:text-[#8C5151] transition-colors">
                    {{ $dest['name'] }}
                  </a>
                </h2>

                <p class="text-sm text-[#524343] leading-relaxed font-sans">
                  {{ $dest['highlights'] }}
                </p>

                <!-- Research & Module Focus Box -->
                <div class="p-3.5 bg-white border border-[#2B211E]/10 flex flex-col gap-1 text-xs">
                  <span class="font-bold uppercase tracking-wider text-[#51634b] font-sans">Fokus Pembelajaran & Riset</span>
                  <p class="text-[#231917] font-sans">
                    {{ implode(' • ', $dest['suitable_for']) }}
                  </p>
                </div>

                <!-- Facilities List Badges -->
                <div class="flex flex-wrap gap-1.5 pt-1">
                  @foreach($dest['facilities'] as $fac)
                  <span class="text-[11px] px-2.5 py-0.5 bg-white border border-[#2B211E]/15 text-[#524343] font-sans">
                    {{ $fac }}
                  </span>
                  @endforeach
                </div>

                <!-- Bottom Action Strip & Marketplace Details (Ala Traveloka) -->
                <div class="pt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-t border-[#8C5151]/15">
                  <div class="flex flex-col">
                    <span class="text-[11px] text-[#735A5A] uppercase tracking-wider font-sans">Retribusi Resmi Tapak</span>
                    <div class="flex items-baseline gap-1.5">
                      <span class="font-serif text-xl font-bold text-[#703A3A]">{{ $dest['price_formatted'] }}</span>
                      <span class="text-xs text-[#524343] font-sans">/ siswa/pax</span>
                    </div>
                  </div>
                  <div class="flex items-center gap-2">
                    <span class="text-[11px] font-semibold text-[#51634b] bg-[#51634b]/10 px-2.5 py-1">
                      Kuota s.d {{ $dest['capacity'] }} Org
                    </span>
                    <a href="{{ route('destinasi.show', $dest['slug']) }}" class="rgs-btn rgs-btn-primary !py-2 !px-4 !text-xs flex items-center gap-1.5">
                      <span>Buka Silabus & Slot</span>
                      <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Media Column -->
              <div class="col-span-12 lg:col-span-7 {{ $index % 2 === 0 ? 'order-1 lg:order-2' : 'order-1' }}">
                <div class="relative w-full aspect-[16/10] overflow-hidden border border-[#8C5151]/20 bg-[#fdeae5] group">
                  <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $dest['name'] }}" src="{{ $dest['image'] }}"/>
                  <div class="absolute inset-0 bg-gradient-to-t from-[#231917]/40 via-transparent to-transparent pointer-events-none"></div>
                  <span class="absolute bottom-3 left-3 px-3 py-1 bg-[#231917]/70 backdrop-blur-sm text-white text-xs font-serif italic">
                    {{ $dest['city'] }}, {{ $dest['province'] }}
                  </span>
                </div>
              </div>

            </div>
          </div>
        </section>
      @empty
        <div class="max-w-[1360px] mx-auto px-4 py-16 text-center text-[#524343] space-y-3">
          <span class="material-symbols-outlined text-4xl text-[#8C5151]">travel_explore</span>
          <h3 class="font-serif text-2xl font-bold text-[#231917]">Tidak Ada Destinasi yang Sesuai Filter</h3>
          <p class="text-sm">Silakan atur ulang kata kunci atau kategori pencarian Anda.</p>
          <a href="{{ route('destinasi.index') }}" class="rgs-btn rgs-btn-primary inline-flex mt-3">
            <span>Kembali ke Semua Destinasi</span>
          </a>
        </div>
      @endforelse
    </div>

    <!-- Standard & Compliance Section (FPIC Adat & Dana BOS) -->
    <section class="border-t border-[#8C5151]/20 bg-[#faf6f0] py-14 sm:py-16">
      <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10">
          
          <!-- FPIC Box -->
          <div id="legalitas-fpic" class="p-6 sm:p-8 bg-white border border-[#2B211E]/15 space-y-4">
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#51634b]">
              <span class="material-symbols-outlined text-lg">verified</span>
              <span>Protokol FPIC Lembaga Adat</span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-[#231917]">
              Eksplorasi yang Berakar pada Penghormatan Martabat Warga
            </h3>
            <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
              Seluruh tapak pembelajaran yang terdaftar di Destinara telah melalui musyawarah adat dan persetujuan bebas tanpa paksaan (Free, Prior, and Informed Consent). Sebanyak 90% dari nilai transaksi disalurkan langsung ke kas desa adat/komunitas pelestari untuk mendukung kemandirian lokal.
            </p>
            <div class="pt-2 flex items-center gap-4 text-xs font-semibold text-[#51634b] font-sans">
              <span>✓ Izin Resmi Tetua Adat</span>
              <span>•</span>
              <span>✓ Kode Etik Wisata & Riset</span>
            </div>
          </div>

          <!-- BOS Compliance Box -->
          <div id="panduan-bos" class="p-6 sm:p-8 bg-white border border-[#2B211E]/15 space-y-4">
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#703A3A]">
              <span class="material-symbols-outlined text-lg">account_balance</span>
              <span>Standar Akuntabilitas Dana BOS</span>
            </div>
            <h3 class="font-serif text-2xl font-bold text-[#231917]">
              Dokumen Lengkap Siap Audit untuk Sekolah & Kampus
            </h3>
            <p class="text-xs sm:text-sm text-[#524343] leading-relaxed font-sans">
              Setiap pemesanan melalui sistem Destinara otomatis menerbitkan dokumen legal administratif: Invoice resmi dengan meterai digital, Perjanjian Kerjasama (MoU), Surat Pengantar Izin Dinas Pendidikan, serta Laporan Pertanggungjawaban (LPJ) terstandarisasi Kemendikbudristek.
            </p>
            <div class="pt-2 flex items-center gap-4 text-xs font-semibold text-[#703A3A] font-sans">
              <span>✓ Invoice Bermeterai Sah</span>
              <span>•</span>
              <span>✓ Sesuai Juknis BOS Terbaru</span>
            </div>
          </div>

        </div>
      </div>
    </section>

  </div>
</main>
@endsection
