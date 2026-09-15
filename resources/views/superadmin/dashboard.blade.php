@extends('layouts.superadmin')

@section('title', 'Kontrol Ekosistem & Health Monitor')

@section('content')
<div class="space-y-8">

    <!-- Top Executive Banner -->
    <div class="rgs-card p-6 sm:p-8 bg-[#ffffff] border-l-4 border-l-[#4A1E1E] flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-widest text-[#703A3A]">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>Konsol Pengawas Tertinggi • Dewan Direksi</span>
                <span>•</span>
                <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Kontrol Ekosistem & Tata Kelola Strategis
            </h1>
            <p class="text-sm text-[#2B211E]/75 max-w-2xl">
                Pantau kesehatan infrastruktur lintas layanan, rekonsiliasi arus perputaran kas escrow, parameter komisi platform, dan rekam jejak audit keamanan level root.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('superadmin.reconciliation') }}" class="rgs-btn-dark px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-xs">
                <span class="material-symbols-outlined text-[18px]">account_balance</span>
                <span>Rekonsiliasi Kas Escrow</span>
            </a>
            <a href="{{ route('superadmin.settings') }}" class="rgs-btn-outline px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 bg-white">
                <span class="material-symbols-outlined text-[18px]">tune</span>
                <span>Parameter Master</span>
            </a>
        </div>
    </div>

    <!-- 4 Plinth Macro Financial Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: GMV -->
        <div class="rgs-card p-5 border-t-2 border-t-[#4A1E1E] bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Total GMV Transaksi</span>
                <span class="material-symbols-outlined text-[#4A1E1E]">payments</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-2xl font-bold text-[#2B211E]">Rp {{ number_format($totalGmv, 0, ',', '.') }}</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">Volume bruto seluruh rombongan</p>
            <div class="mt-3 pt-2 border-t border-[#2B211E]/08 flex items-center justify-between text-[11px] font-mono">
                <span class="text-emerald-800 font-bold">+28.4% YoY</span>
                <span class="text-[#2B211E]/60">{{ $totalBookings }} Reservasi</span>
            </div>
        </div>

        <!-- Card 2: Platform Revenue 10% -->
        <div class="rgs-card p-5 border-t-2 border-t-[#703A3A] bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Komisi Platform (10%)</span>
                <span class="material-symbols-outlined text-[#703A3A]">toll</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-2xl font-bold text-[#703A3A]">Rp {{ number_format($platformCommissionTotal, 0, ',', '.') }}</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">Pendapatan operasional bersih</p>
            <div class="mt-3 pt-2 border-t border-[#2B211E]/08 flex items-center justify-between text-[11px] font-mono">
                <span class="text-[#703A3A] font-bold">10.0% Flat Net</span>
                <span class="text-[#2B211E]/60">PRD Sec. 7.9</span>
            </div>
        </div>

        <!-- Card 3: Partner Payouts 90% -->
        <div class="rgs-card p-5 border-t-2 border-t-[#51634b] bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Hak Mitra Adat (90%)</span>
                <span class="material-symbols-outlined text-[#51634b]">nature_people</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-2xl font-bold text-[#51634b]">Rp {{ number_format($partnerPayoutsTotal, 0, ',', '.') }}</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">Dana tersalurkan ke desa adat</p>
            <div class="mt-3 pt-2 border-t border-[#2B211E]/08 flex items-center justify-between text-[11px] font-mono">
                <span class="text-emerald-800 font-bold">90.0% Terjamin</span>
                <span class="text-[#2B211E]/60">BPD Bali & BJB</span>
            </div>
        </div>

        <!-- Card 4: Escrow Holding -->
        <div class="rgs-card p-5 border-t-2 border-t-amber-600 bg-white">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium uppercase tracking-wider mb-2">
                <span>Saldo Escrow Mengendap</span>
                <span class="material-symbols-outlined text-amber-600">lock_clock</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-serif text-2xl font-bold text-amber-900">Rp {{ number_format($escrowHolding, 0, ',', '.') }}</span>
            </div>
            <p class="text-[11px] text-[#2B211E]/60 mt-2">Dana aman rombongan aktif</p>
            <div class="mt-3 pt-2 border-t border-[#2B211E]/08 flex items-center justify-between text-[11px] font-mono">
                <span class="text-amber-800 font-bold">BCA Escrow Safe</span>
                <span class="text-[#2B211E]/60">Rilis H+1 Excursion</span>
            </div>
        </div>
    </div>

    <!-- Health Monitor & Status Layanan Sistem -->
    <div class="rgs-card bg-white p-6">
        <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-4 mb-4">
            <div>
                <h2 class="font-serif text-lg font-bold text-[#2B211E]">Kesehatan Layanan Infrastruktur (Service Health Monitor)</h2>
                <p class="text-xs text-[#2B211E]/60">Status konektivitas gateway transaksi, sistem perpesanan, dan integritas basis data</p>
            </div>
            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-900 border border-emerald-300 text-xs font-mono font-bold uppercase flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                <span>Semua Layanan Normal (100% Uptime)</span>
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($services as $svc)
            <div class="p-4 bg-[#faf6f0] border border-[#2B211E]/12 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[#2B211E]">{{ $svc['name'] }}</span>
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                </div>
                <div class="flex items-center justify-between text-xs font-mono text-[#2B211E]/70 pt-1 border-t border-[#2B211E]/08">
                    <span>Latency: {{ $svc['latency'] }}</span>
                    <span class="text-[#703A3A] font-semibold">{{ $svc['detail'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Grid 2 Kolom: Aktivitas Kritis & Ringkasan Entitas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Master Security & Audit Trail -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rgs-card bg-white p-6">
                <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-4 mb-4">
                    <div>
                        <h2 class="font-serif text-lg font-bold text-[#2B211E]">Rekam Jejak Keamanan & Audit Master</h2>
                        <p class="text-xs text-[#2B211E]/60">Log kronologis perubahan konfigurasi, otorisasi dana, dan intervensi root</p>
                    </div>
                    <a href="{{ route('superadmin.reconciliation') }}" class="text-xs font-semibold text-[#703A3A] hover:underline flex items-center gap-1">
                        <span>Buka Audit Lengkap</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <div class="space-y-4 text-xs font-mono">
                    @foreach($latestAudits as $audit)
                    <div class="p-3 bg-[#faf6f0]/60 border border-[#2B211E]/10 space-y-1">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-[#4A1E1E]">{{ strtoupper($audit->action) }}</span>
                            <span class="text-[10px] text-[#2B211E]/50">{{ $audit->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                        <p class="font-sans text-xs text-[#2B211E]/80 leading-relaxed">{{ $audit->description }}</p>
                        <div class="flex items-center justify-between text-[10px] text-[#2B211E]/60 pt-1 border-t border-[#2B211E]/05">
                            <span>Petugas: {{ $audit->user->name ?? 'System Root' }}</span>
                            <span>IP: {{ $audit->ip_address }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right 1 Col: Tata Kelola Entitas & Otoritas -->
        <div class="space-y-6">
            
            <!-- Ringkasan Entitas Terdaftar -->
            <div class="rgs-card bg-[#faf6f0] p-5 border-l-4 border-l-[#4A1E1E] space-y-3">
                <h3 class="font-serif text-base font-bold text-[#2B211E]">Entitas Ekosistem Terdaftar</h3>
                <div class="space-y-2 text-xs">
                    <div class="flex items-center justify-between pb-1.5 border-b border-[#2B211E]/10">
                        <span class="text-[#2B211E]/70">Total Pengguna Terdaftar</span>
                        <span class="font-mono font-bold">{{ $totalUsers }} Akun</span>
                    </div>
                    <div class="flex items-center justify-between pb-1.5 border-b border-[#2B211E]/10">
                        <span class="text-[#2B211E]/70">Tapak Terverifikasi & Aktif</span>
                        <span class="font-mono font-bold text-emerald-800">{{ $totalDestinations }} Tapak</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-[#2B211E]/70">Reservasi Rombongan Tuntas</span>
                        <span class="font-mono font-bold text-[#703A3A]">{{ $totalBookings }} Transaksi</span>
                    </div>
                </div>
                <div class="pt-2">
                    <a href="{{ route('superadmin.users') }}" class="rgs-btn-dark w-full py-2 text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-1.5 shadow-xs">
                        <span class="material-symbols-outlined text-[16px]">manage_accounts</span>
                        <span>Kelola Akses Pengguna</span>
                    </a>
                </div>
            </div>

            <!-- Protokol Integritas Finansial -->
            <div class="rgs-card bg-white p-5 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#2B211E]/70 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[#703A3A] text-sm">security</span>
                    <span>Protokol Keuangan Adat FPIC</span>
                </h4>
                <p class="text-xs text-[#2B211E]/75 leading-relaxed">
                    Setiap transaksi dipayungi perjanjian kemitraan resmi. Dana hak mitra sebesar 90% ditampung pada rekening penampungan escrow dan hanya dicairkan ke rekening bank lembaga adat yang telah terverifikasi SK Bupati/Penetapan Desa Adat.
                </p>
            </div>

        </div>

    </div>

</div>
@endsection
