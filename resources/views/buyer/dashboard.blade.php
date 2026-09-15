@extends('layouts.buyer')

@section('title', 'Dashboard Buyer Institusi')

@section('content')
<div class="space-y-8">

    <!-- Header Sambutan Kuratorial & Quick Action -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#2B211E]/12">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#703A3A] mb-1">
                <span class="material-symbols-outlined text-[16px]">account_balance</span>
                <span>{{ $institution->institution_name ?? 'SMA Negeri 1 Candirejo' }}</span>
                <span class="px-1.5 py-0.5 bg-[#51634b]/10 text-[#51634b] text-[10px] uppercase font-bold">Terverifikasi</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">Ruang Kerja Perjalanan Akademik</h1>
            <p class="text-xs sm:text-sm text-[#2B211E]/70 mt-1">
                Kelola jadwal ekskursi lapangan, perizinan dinas, verifikasi kemitraan tapak, dan administrasi rombongan belajar.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('buyer.booking.create') }}" class="rgs-btn-primary px-5 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                <span>Ajukan Booking Rombongan</span>
            </a>
        </div>
    </div>

    <!-- 4 Plinth Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Metric 1: Aktif -->
        <div class="rgs-card p-5 border-t-4 border-t-[#703A3A]">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Rombongan Aktif</span>
                <span class="material-symbols-outlined text-[#703A3A] text-[20px]">pending_actions</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#2B211E]">{{ $activeBookingsCount }}</div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">Dalam proses & terjadwal</div>
        </div>

        <!-- Metric 2: Menunggu Pembayaran -->
        <div class="rgs-card p-5 border-t-4 border-t-[#b87a38]">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Menunggu Pembayaran</span>
                <span class="material-symbols-outlined text-[#b87a38] text-[20px]">receipt_long</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#b87a38]">{{ $pendingPaymentCount }}</div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">Perlu penyelesaian transaksi</div>
        </div>

        <!-- Metric 3: Dikonfirmasi & Siap -->
        <div class="rgs-card p-5 border-t-4 border-t-[#51634b]">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Kunjungan Dikonfirmasi</span>
                <span class="material-symbols-outlined text-[#51634b] text-[20px]">verified_user</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#51634b]">{{ $confirmedCount }}</div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">e-Pass & izin resmi siap unduh</div>
        </div>

        <!-- Metric 4: Selesai -->
        <div class="rgs-card p-5 border-t-4 border-t-[#2B211E]/30">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Ekskursi Selesai</span>
                <span class="material-symbols-outlined text-[#2B211E]/60 text-[20px]">history_edu</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#2B211E]">{{ $completedCount }}</div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">Arsip LPJ & repeat order</div>
        </div>
    </div>

    <!-- Jadwal Ekskursi Terdekat (Hero Card) -->
    @if($nextBooking)
    <div class="rgs-card overflow-hidden border border-[#2B211E]/15">
        <div class="bg-[#faf6f0] px-6 py-3 border-b border-[#2B211E]/10 flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[#703A3A] text-[18px]">event_upcoming</span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#703A3A]">Ekskursi Rombongan Terdekat</span>
            </div>
            <div class="text-xs font-mono font-bold text-[#2B211E]/75">
                KODE: {{ $nextBooking->booking_code }}
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            <!-- Thumbnail Foto Tapak -->
            <div class="lg:col-span-4 relative aspect-video sm:aspect-4/3 bg-[#eee5df] overflow-hidden border border-[#2B211E]/15">
                <img src="{{ asset($nextBooking->destination->cover_image) }}" alt="{{ $nextBooking->destination->name }}" class="w-full h-full object-cover">
                <div class="absolute top-2 left-2 px-2 py-0.5 bg-[#2B211E]/80 text-white text-[10px] font-semibold uppercase tracking-wider">
                    {{ strtoupper(str_replace('_', ' ', $nextBooking->destination->category)) }}
                </div>
            </div>

            <!-- Detail Info Rombongan -->
            <div class="lg:col-span-8 space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    @if($nextBooking->status === 'dikonfirmasi')
                        <span class="px-2.5 py-1 bg-[#51634b]/15 text-[#51634b] text-xs font-bold uppercase tracking-wider flex items-center gap-1 border border-[#51634b]/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#51634b]"></span> Terkonfirmasi & Siap Berangkat
                        </span>
                    @elseif($nextBooking->status === 'menunggu_pembayaran')
                        <span class="px-2.5 py-1 bg-[#b87a38]/15 text-[#b87a38] text-xs font-bold uppercase tracking-wider flex items-center gap-1 border border-[#b87a38]/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#b87a38]"></span> Menunggu Pembayaran
                        </span>
                    @else
                        <span class="px-2.5 py-1 bg-[#703A3A]/15 text-[#703A3A] text-xs font-bold uppercase tracking-wider border border-[#703A3A]/30">
                            {{ ucfirst(str_replace('_', ' ', $nextBooking->status)) }}
                        </span>
                    @endif

                    <span class="text-xs text-[#2B211E]/60">•</span>
                    <span class="text-xs font-semibold text-[#703A3A] uppercase tracking-wide">
                        {{ $nextBooking->inquiry_type === 'study_tour' ? 'Study Tour Kurikulum P5' : 'Penelitian Lapangan' }}
                    </span>
                </div>

                <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#2B211E]">
                    {{ $nextBooking->destination->name }}
                </h2>

                <!-- Ringkasan Spesifikasi Kunjungan -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 py-3 border-y border-[#2B211E]/10 text-xs">
                    <div>
                        <span class="text-[#2B211E]/60 block text-[11px]">Tanggal Kunjungan</span>
                        <span class="font-bold text-[#2B211E]">{{ \Carbon\Carbon::parse($nextBooking->planned_date_start)->translatedFormat('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-[#2B211E]/60 block text-[11px]">Kapasitas Rombongan</span>
                        <span class="font-bold text-[#2B211E]">{{ $nextBooking->participant_count }} Siswa + {{ $nextBooking->guide_count }} Guru</span>
                    </div>
                    <div>
                        <span class="text-[#2B211E]/60 block text-[11px]">Total Transaksi</span>
                        <span class="font-bold text-[#703A3A]">Rp {{ number_format($nextBooking->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="text-[#2B211E]/60 block text-[11px]">Lokasi Tapak</span>
                        <span class="font-bold text-[#2B211E]">{{ $nextBooking->destination->city }}, {{ $nextBooking->destination->province }}</span>
                    </div>
                </div>

                <!-- Checklist Kesiapan & Action Button -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-1">
                    <div class="flex items-center gap-4 text-xs text-[#2B211E]/75">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[#51634b] text-[16px]">check_circle</span>
                            <span>SOP Keselamatan</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[#51634b] text-[16px]">check_circle</span>
                            <span>Asuransi Rombongan</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[#51634b] text-[16px]">check_circle</span>
                            <span>Pemandu Adat Siap</span>
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('buyer.booking.show', $nextBooking->booking_code) }}" class="rgs-btn-outline px-4 py-2 text-xs font-semibold uppercase tracking-wider">
                            Detail Dossier
                        </a>

                        @if($nextBooking->status === 'menunggu_pembayaran')
                            <a href="{{ route('buyer.booking.payment', $nextBooking->booking_code) }}" class="rgs-btn-primary px-4 py-2 text-xs font-semibold uppercase tracking-wider flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">credit_card</span>
                                <span>Bayar Tagihan</span>
                            </a>
                        @else
                            <a href="{{ route('buyer.booking.show', $nextBooking->booking_code) }}#dokumen" class="px-4 py-2 bg-[#51634b] text-white hover:bg-[#3f4f3a] text-xs font-semibold uppercase tracking-wider flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">download</span>
                                <span>Unduh e-Pass</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- 2 Kolom: Riwayat Booking Berjalan & Rekomendasi Tapak -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Kolom Kiri: Riwayat Berjalan (7 Kolom) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/12">
                <div class="flex items-center gap-2">
                    <span class="font-serif text-lg font-bold text-[#2B211E]">Pesanan Rombongan Terbaru</span>
                    <span class="px-2 py-0.5 bg-[#703A3A]/10 text-[#703A3A] text-xs font-bold">{{ $recentBookings->count() }}</span>
                </div>
                <a href="{{ route('buyer.history') }}" class="text-xs font-semibold text-[#703A3A] hover:underline flex items-center gap-0.5">
                    <span>Lihat Semua Arsip</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="space-y-3">
                @forelse($recentBookings as $b)
                <div class="rgs-card p-4 hover:border-[#703A3A]/40 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 text-[11px]">
                            <span class="font-mono font-bold text-[#703A3A]">{{ $b->booking_code }}</span>
                            <span class="text-[#2B211E]/40">•</span>
                            <span class="text-[#2B211E]/70">{{ \Carbon\Carbon::parse($b->planned_date_start)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="font-serif text-base font-bold text-[#2B211E] leading-snug">
                            {{ $b->destination->name }}
                        </h3>
                        <div class="text-xs text-[#2B211E]/70 flex items-center gap-2">
                            <span>{{ $b->participant_count }} Siswa</span>
                            <span>•</span>
                            <span class="font-bold text-[#2B211E]">Rp {{ number_format($b->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex items-center sm:flex-col sm:items-end justify-between gap-2">
                        @if($b->status === 'dikonfirmasi')
                            <span class="px-2 py-0.5 bg-[#51634b]/15 text-[#51634b] text-[11px] font-bold uppercase tracking-wider">
                                Siap Berangkat
                            </span>
                        @elseif($b->status === 'menunggu_pembayaran')
                            <span class="px-2 py-0.5 bg-[#b87a38]/15 text-[#b87a38] text-[11px] font-bold uppercase tracking-wider">
                                Belum Bayar
                            </span>
                        @elseif($b->status === 'selesai')
                            <span class="px-2 py-0.5 bg-[#2B211E]/10 text-[#2B211E]/70 text-[11px] font-bold uppercase tracking-wider">
                                Selesai
                            </span>
                        @else
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-700 text-[11px] font-bold uppercase tracking-wider">
                                {{ ucfirst($b->status) }}
                            </span>
                        @endif

                        <a href="{{ route('buyer.booking.show', $b->booking_code) }}" class="text-xs font-semibold text-[#703A3A] hover:underline flex items-center gap-0.5 mt-1">
                            <span>Periksa Detail</span>
                            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="rgs-card p-8 text-center text-[#2B211E]/60 text-xs">
                    Belum ada riwayat pesanan rombongan. Klik tombol "Ajukan Booking Rombongan" di atas untuk memulai.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Rekomendasi Tapak Unggulan (5 Kolom) -->
        <div class="lg:col-span-5 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/12">
                <span class="font-serif text-lg font-bold text-[#2B211E]">Tapak Laboratorium Pilihan</span>
                <a href="{{ route('destinasi.index') }}" target="_blank" class="text-xs font-semibold text-[#51634b] hover:underline flex items-center gap-0.5">
                    <span>Katalog Penuh</span>
                    <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                </a>
            </div>

            <div class="space-y-3">
                @foreach($recommendedDestinations as $dest)
                <div class="rgs-card p-3 flex gap-3 items-center">
                    <div class="w-20 h-20 bg-gray-200 shrink-0 border border-[#2B211E]/15 overflow-hidden">
                        <img src="{{ asset($dest->cover_image) }}" alt="{{ $dest->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#703A3A] block">
                            {{ $dest->city }}, {{ $dest->province }}
                        </span>
                        <h4 class="font-serif text-sm font-bold text-[#2B211E] truncate">
                            {{ $dest->name }}
                        </h4>
                        <div class="text-[11px] text-[#2B211E]/60 mt-0.5">
                            Mulai <strong class="text-[#2B211E]">Rp {{ number_format($dest->price_per_pax, 0, ',', '.') }}</strong> / pax
                        </div>
                        <div class="mt-2 flex items-center gap-2">
                            <a href="{{ route('buyer.booking.create', ['destinasi' => $dest->slug]) }}" class="text-[11px] font-bold text-[#703A3A] hover:underline flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">add_circle</span>
                                <span>Pesan Rombongan</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Callout Bantuan Layanan Sekolah -->
            <div class="p-4 bg-[#703A3A]/8 border border-[#703A3A]/20 text-xs text-[#2B211E]/80 space-y-2">
                <div class="flex items-center gap-1.5 font-bold text-[#703A3A]">
                    <span class="material-symbols-outlined text-[16px]">support_agent</span>
                    <span>Layanan Pembelian Rombongan Sekolah</span>
                </div>
                <p class="text-[11px] leading-relaxed">
                    Butuh penyesuaian SPK, dokumen verifikasi BOS daerah, atau proposal kurikulum untuk komite sekolah? Tim operasional Destinara siap mendampingi.
                </p>
                <div class="text-[11px] font-mono font-bold text-[#703A3A]">
                    WhatsApp Hotline: 0812-3456-7890
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
