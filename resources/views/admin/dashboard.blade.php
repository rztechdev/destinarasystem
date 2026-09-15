@extends('layouts.admin')

@section('title', 'Dashboard Operasional Harian')

@section('content')
<div class="space-y-8">

    <!-- Top Banner & Waktu Operasional -->
    <div class="rgs-card p-6 sm:p-8 bg-[#ffffff] border-l-4 border-l-[#2B3A4A] flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-widest text-[#2B3A4A]">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Pusat Kendali Terpadu Destinara</span>
                <span>•</span>
                <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Dashboard Operasional & Kurasi Nusantara
            </h1>
            <p class="text-sm text-[#2B211E]/75 max-w-2xl">
                Pantau antrian kurasi tapak adat, validasi nomor NPSN/legalitas lembaga, kendalikan jadwal rombongan lintas provinsi, dan monitor dispatch notifikasi secara real-time.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.destinations.verify') }}" class="rgs-btn-primary px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-xs">
                <span class="material-symbols-outlined text-[18px]">verified</span>
                <span>Telaah Tapak ({{ $pendingDestinations }})</span>
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="rgs-btn-outline px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                <span>Pantau Reservasi</span>
            </a>
        </div>
    </div>

    <!-- 4 Plinth Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Pending Destinasi -->
        <div class="rgs-card p-5 border-t-2 border-t-amber-600 bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Dossier Menunggu Telaah</span>
                <span class="material-symbols-outlined text-amber-600">travel_explore</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-3xl font-bold text-[#2B211E]">{{ $pendingDestinations }}</span>
                <span class="text-xs text-amber-800 font-medium">Tapak Baru</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">Standar keselamatan & kurikulum P5</p>
            <a href="{{ route('admin.destinations.verify') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#703A3A] mt-3 hover:underline">
                <span>Buka antrian kurasi</span>
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>

        <!-- Card 2: Pending Verifikasi User -->
        <div class="rgs-card p-5 border-t-2 border-t-blue-600 bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Validasi Kredensial</span>
                <span class="material-symbols-outlined text-blue-600">badge</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-3xl font-bold text-[#2B211E]">{{ $pendingVerifications }}</span>
                <span class="text-xs text-blue-800 font-medium">Pengguna</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">NPSN Kemdikbud & SK Lembaga Adat</p>
            <a href="{{ route('admin.users.verify') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#703A3A] mt-3 hover:underline">
                <span>Periksa dokumen legalitas</span>
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>

        <!-- Card 3: Active Bookings -->
        <div class="rgs-card p-5 border-t-2 border-t-emerald-600 bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Booking Rombongan Aktif</span>
                <span class="material-symbols-outlined text-emerald-600">groups</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-3xl font-bold text-[#2B211E]">{{ $activeBookings }}</span>
                <span class="text-xs text-emerald-800 font-medium">Rombongan</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">{{ $urgentBookings }} reservasi menunggu mitra</p>
            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#703A3A] mt-3 hover:underline">
                <span>Kelola jadwal rombongan</span>
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>

        <!-- Card 4: Queue Logs -->
        <div class="rgs-card p-5 border-t-2 border-t-red-600 bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Queue & Pengiriman Pesan</span>
                <span class="material-symbols-outlined text-red-600">notifications_active</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-3xl font-bold text-[#2B211E]">{{ $failedNotifs }}</span>
                <span class="text-xs text-red-700 font-medium">Gagal Kirim</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">Gateway Fonnte WA & Mailgun SMTP</p>
            <a href="{{ route('admin.notifications.index', ['status' => 'failed']) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#703A3A] mt-3 hover:underline">
                <span>Tinjau queue error</span>
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>
    </div>

    <!-- Antrian Tugas Mendesak (Urgent Action Callouts) -->
    @if(count($urgentItems) > 0)
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-lg font-bold text-[#2B211E] flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-600">priority_high</span>
                <span>Tindakan Operasional Prioritas (SLA Alert)</span>
            </h2>
            <span class="text-xs text-[#2B211E]/60 font-mono">{{ count($urgentItems) }} antrian butuh respon</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($urgentItems as $item)
            <div class="rgs-card p-4 flex items-start justify-between gap-4 border-l-4 border-l-[#703A3A] bg-[#faf6f0]">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 border text-[10px] font-mono font-bold uppercase {{ $item['badge_color'] }}">
                            {{ $item['badge'] }}
                        </span>
                        <h3 class="text-sm font-bold text-[#2B211E]">{{ $item['title'] }}</h3>
                    </div>
                    <p class="text-xs text-[#2B211E]/75 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                <a href="{{ $item['link'] }}" class="rgs-btn-outline shrink-0 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider bg-white">
                    {{ $item['action_label'] }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Layout Grid: Tabel Reservasi Terkini & Panel Samping -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Master Tabel Booking Terkini -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rgs-card bg-white p-6">
                <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-4 mb-4">
                    <div>
                        <h2 class="font-serif text-lg font-bold text-[#2B211E]">Arus Reservasi Rombongan Terkini</h2>
                        <p class="text-xs text-[#2B211E]/60">Daftar booking sekolah dan perguruan tinggi yang baru masuk sistem</p>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-[#703A3A] hover:underline flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-[#2B211E]/12 text-[#2B211E]/60 uppercase tracking-wider font-mono">
                                <th class="pb-3 font-semibold">Kode / Sekolah</th>
                                <th class="pb-3 font-semibold">Tapak Tujuan</th>
                                <th class="pb-3 font-semibold">Tgl Kunjungan</th>
                                <th class="pb-3 font-semibold text-right">Rombongan</th>
                                <th class="pb-3 font-semibold text-center">Status</th>
                                <th class="pb-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#2B211E]/08">
                            @foreach($recentBookings as $b)
                            <tr class="hover:bg-[#faf6f0]/60 transition-colors">
                                <td class="py-3.5 pr-2">
                                    <span class="font-mono font-bold text-[#703A3A] block">{{ $b->booking_code }}</span>
                                    <span class="text-[#2B211E] font-medium">{{ $b->user->institution->institution_name ?? $b->user->name }}</span>
                                </td>
                                <td class="py-3.5 pr-2">
                                    <span class="font-semibold text-[#2B211E] block">{{ $b->destination->name ?? '-' }}</span>
                                    <span class="text-[11px] text-[#2B211E]/60">{{ $b->destination->city ?? '' }}</span>
                                </td>
                                <td class="py-3.5 pr-2 font-mono text-[#2B211E]/80">
                                    {{ \Carbon\Carbon::parse($b->visit_date)->format('d M Y') }}
                                </td>
                                <td class="py-3.5 pr-2 text-right font-mono">
                                    {{ $b->total_pax }} Pax
                                </td>
                                <td class="py-3.5 text-center">
                                    @if($b->status === 'confirmed')
                                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-900 border border-emerald-300 text-[10px] font-semibold uppercase">Lunas</span>
                                    @elseif($b->status === 'awaiting_payment')
                                        <span class="px-2 py-0.5 bg-amber-100 text-amber-900 border border-amber-300 text-[10px] font-semibold uppercase">Menunggu Bayar</span>
                                    @elseif($b->status === 'pending_confirmation')
                                        <span class="px-2 py-0.5 bg-blue-100 text-blue-900 border border-blue-300 text-[10px] font-semibold uppercase">Review Mitra</span>
                                    @elseif($b->status === 'completed')
                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-800 border border-gray-300 text-[10px] font-semibold uppercase">Selesai</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-red-100 text-red-800 border border-red-300 text-[10px] font-semibold uppercase">{{ $b->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3.5 text-right">
                                    <a href="{{ route('admin.bookings.index', ['search' => $b->booking_code]) }}" class="text-[#703A3A] font-semibold hover:underline">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Distribusi Tematik Pembelajaran P5 Nusantara -->
            <div class="rgs-card bg-white p-6">
                <h3 class="font-serif text-base font-bold text-[#2B211E] mb-1">Cakupan Kurikulum & Relevansi Pembelajaran</h3>
                <p class="text-xs text-[#2B211E]/60 mb-4">Pemetaan modul pembelajaran tapak nusantara yang terdaftar dalam platform</p>
                
                <div class="space-y-3 text-xs">
                    <div>
                        <div class="flex justify-between font-medium mb-1">
                            <span>Kearifan Lokal & Tata Ruang Adat</span>
                            <span class="font-mono">45% (9 Tapak)</span>
                        </div>
                        <div class="w-full bg-[#2B211E]/10 h-2">
                            <div class="bg-[#703A3A] h-2" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between font-medium mb-1">
                            <span>Biosfer Maritim & Konservasi Alam</span>
                            <span class="font-mono">30% (6 Tapak)</span>
                        </div>
                        <div class="w-full bg-[#2B211E]/10 h-2">
                            <div class="bg-[#51634b] h-2" style="width: 30%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between font-medium mb-1">
                            <span>Teknologi Pertanian Tradisional & Pangan</span>
                            <span class="font-mono">25% (5 Tapak)</span>
                        </div>
                        <div class="w-full bg-[#2B211E]/10 h-2">
                            <div class="bg-[#b87a38] h-2" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right 1 Col: Audit Trail & Indikator Sistem -->
        <div class="space-y-6">
            
            <!-- SLA & Kinerja Layanan -->
            <div class="rgs-card bg-[#faf6f0] p-5 border-l-4 border-l-[#51634b]">
                <h3 class="font-serif text-base font-bold text-[#2B211E] mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#51634b]">verified_user</span>
                    <span>Standar Layanan Operasional (SLA)</span>
                </h3>
                <div class="space-y-3 text-xs">
                    <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/10">
                        <span class="text-[#2B211E]/70">Waktu Respon Verifikasi Tapak</span>
                        <span class="font-mono font-bold text-emerald-800">18.4 Jam (Target: &lt;24h)</span>
                    </div>
                    <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/10">
                        <span class="text-[#2B211E]/70">Penerbitan Dokumen Resmi & BOS</span>
                        <span class="font-mono font-bold text-emerald-800">Instan (&lt;5 detik)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-[#2B211E]/70">Tingkat Berhasil Notifikasi WA</span>
                        <span class="font-mono font-bold text-emerald-800">98.2% Lolos Gateway</span>
                    </div>
                </div>
            </div>

            <!-- Rekam Jejak Aktivitas Operasional (Audit Trail) -->
            <div class="rgs-card bg-white p-5">
                <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3 mb-4">
                    <h3 class="font-serif text-base font-bold text-[#2B211E] flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px] text-[#2B3A4A]">history</span>
                        <span>Audit Trail Operasional</span>
                    </h3>
                    <span class="text-[10px] font-mono text-[#2B211E]/60 uppercase">Live Log</span>
                </div>

                <div class="space-y-4">
                    @foreach($auditTrail as $a)
                    <div class="text-xs space-y-1 pb-3 border-b border-[#2B211E]/08 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-[#2B211E]">{{ $a->user->name ?? 'Admin Operasional' }}</span>
                            <span class="text-[10px] font-mono text-[#2B211E]/50">{{ $a->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-[#2B211E]/75 leading-relaxed">{{ $a->description }}</p>
                        <div class="flex items-center gap-2 text-[10px] font-mono text-[#703A3A]">
                            <span>{{ strtoupper($a->action) }}</span>
                            <span>•</span>
                            <span class="text-[#2B211E]/40">{{ $a->ip_address }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4 pt-3 border-t border-[#2B211E]/10 text-center">
                    <a href="{{ route('admin.notifications.index') }}" class="text-xs font-semibold text-[#703A3A] hover:underline">
                        Lihat Log Sistem Lengkap &rarr;
                    </a>
                </div>
            </div>

            <!-- Panduan Cepat Petugas Admin -->
            <div class="rgs-card bg-white p-5 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#2B211E]/60">Panduan Ringkas Petugas</h4>
                <ul class="text-xs text-[#2B211E]/75 space-y-2 list-disc list-inside">
                    <li>Dossier baru wajib diverifikasi kriteria zonasi adat dan kapasitas daya tampung.</li>
                    <li>Verifikasi sekolah wajib memeriksa keabsahan NPSN pada pangkalan data Kemdikbud.</li>
                    <li>Intervensi booking hanya diizinkan untuk keadaan darurat / force majeure bencana.</li>
                </ul>
            </div>

        </div>

    </div>

</div>
@endsection
