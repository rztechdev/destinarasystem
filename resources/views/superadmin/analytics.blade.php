@extends('layouts.superadmin')

@section('title', 'Analitik Bisnis & Reporting Ekosistem')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#2B211E]/12 pb-6">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-[#703A3A] mb-1">
                <span>Intelijen Bisnis & Evaluasi Dampak</span>
                <span>•</span>
                <span>Data Driven Nusantara</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Analitik Bisnis & Reporting Ekosistem
            </h1>
            <p class="text-sm text-[#2B211E]/70 max-w-2xl">
                Tinjau funnel konversi pemesanan rombongan, sebaran spasial ekskursi, pertumbuhan GMV bulanan, dan tingkat pemesanan berulang (*repeat order*) sekolah.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="rgs-btn-outline px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 bg-white">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Ekspor Laporan LPJ</span>
            </button>
        </div>
    </div>

    <!-- 4 Mini KPI Metrik -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rgs-card p-4 bg-white border-l-4 border-l-[#4A1E1E]">
            <span class="text-[10px] font-mono text-[#2B211E]/60 uppercase block">Rata-rata Nilai Rombongan (AOV)</span>
            <span class="font-serif text-2xl font-bold text-[#2B211E]">Rp 1.480.000</span>
            <span class="text-[10px] text-emerald-800 font-mono block mt-1">+12.5% vs Kuartal Lalu</span>
        </div>

        <div class="rgs-card p-4 bg-white border-l-4 border-l-[#703A3A]">
            <span class="text-[10px] font-mono text-[#2B211E]/60 uppercase block">Tingkat Pesan Ulang (Repeat Order)</span>
            <span class="font-serif text-2xl font-bold text-[#703A3A]">34.2%</span>
            <span class="text-[10px] text-[#2B211E]/60 font-mono block mt-1">Siklus tahunan angkatan</span>
        </div>

        <div class="rgs-card p-4 bg-white border-l-4 border-l-[#51634b]">
            <span class="text-[10px] font-mono text-[#2B211E]/60 uppercase block">Efisiensi Verifikasi Mitra</span>
            <span class="font-serif text-2xl font-bold text-[#51634b]">82.0%</span>
            <span class="text-[10px] text-emerald-800 font-mono block mt-1">Rombongan lolos kurasi</span>
        </div>

        <div class="rgs-card p-4 bg-white border-l-4 border-l-amber-600">
            <span class="text-[10px] font-mono text-[#2B211E]/60 uppercase block">Rerata Peserta per Bus</span>
            <span class="font-serif text-2xl font-bold text-amber-900">32 Siswa</span>
            <span class="text-[10px] text-[#2B211E]/60 font-mono block mt-1">Optimalisasi kapasitas tapak</span>
        </div>
    </div>

    <!-- Funnel Konversi Reservasi Rombongan -->
    <div class="rgs-card bg-white p-6 space-y-4">
        <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
            <div>
                <h3 class="font-serif text-lg font-bold text-[#2B211E]">Funnel Konversi Pemesanan Rombongan Nusantara</h3>
                <p class="text-xs text-[#2B211E]/60">Alur perjalanan pemesanan dari formulir awal hingga pelaksanaan di tapak adat</p>
            </div>
            <span class="text-xs font-mono font-bold text-[#703A3A]">68% Overall Conversion Rate</span>
        </div>

        <div class="space-y-4 pt-2">
            @foreach($funnel as $idx => $f)
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs font-medium">
                    <span class="flex items-center gap-2">
                        <span class="w-5 h-5 bg-[#faf6f0] border border-[#2B211E]/20 flex items-center justify-center font-mono text-[10px] font-bold text-[#703A3A]">{{ $idx + 1 }}</span>
                        <span>{{ $f['stage'] }}</span>
                    </span>
                    <div class="flex items-center gap-3 font-mono">
                        <span class="text-[#2B211E]/70">{{ $f['count'] }} Pesanan</span>
                        <span class="font-bold text-[#703A3A]">{{ $f['percent'] }}%</span>
                    </div>
                </div>
                <div class="w-full bg-[#2B211E]/10 h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#4A1E1E] to-[#703A3A] h-3 transition-all duration-500" style="width: {{ $f['percent'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Grid 2 Kolom: Grafik Pertumbuhan GMV & Sebaran Spasial -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Kolom Kiri: Tren GMV & Komisi Bulanan -->
        <div class="rgs-card bg-white p-6 space-y-4">
            <div class="border-b border-[#2B211E]/10 pb-3">
                <h3 class="font-serif text-base font-bold text-[#2B211E]">Tren Pertumbuhan Transaksi Bruto (GMV)</h3>
                <p class="text-xs text-[#2B211E]/60">Evolusi nilai reservasi ekskursi 6 bulan berjalan (April - September 2026)</p>
            </div>

            <!-- CSS Bar Chart -->
            <div class="pt-6 space-y-3">
                <div class="h-48 flex items-end justify-between gap-3 px-2 border-b border-[#2B211E]/20 pb-2">
                    @foreach($monthlyTrend as $m)
                    @php
                        $heightPercent = min(100, round(($m['gmv'] / 50000000) * 100));
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-2 group">
                        <div class="w-full bg-[#faf6f0] border border-[#2B211E]/15 h-40 flex items-end">
                            <div class="w-full bg-[#703A3A] group-hover:bg-[#4A1E1E] transition-all" style="height: {{ $heightPercent }}%"></div>
                        </div>
                        <span class="text-[9px] font-mono text-[#2B211E]/70 text-center leading-tight truncate w-full">{{ $m['month'] }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between text-xs pt-2">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-[#703A3A]"></div>
                        <span class="text-[11px] text-[#2B211E]/70">Gross Booking Value</span>
                    </div>
                    <span class="text-[11px] font-mono text-emerald-800 font-bold">Puncak Kunjungan: Agustus 2026</span>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Sebaran Geografis Destinasi -->
        <div class="rgs-card bg-white p-6 space-y-4">
            <div class="border-b border-[#2B211E]/10 pb-3">
                <h3 class="font-serif text-base font-bold text-[#2B211E]">Distribusi Spasial Tapak & Kontribusi Wilayah</h3>
                <p class="text-xs text-[#2B211E]/60">Pangsa pasar per wilayah geografis kepulauan nusantara</p>
            </div>

            <div class="space-y-4 pt-2">
                @foreach($geoDist as $g)
                <div class="space-y-1.5 pb-3 border-b border-[#2B211E]/08 last:border-0 last:pb-0">
                    <div class="flex items-center justify-between text-xs font-semibold">
                        <span class="text-[#2B211E]">{{ $g['region'] }}</span>
                        <span class="font-mono text-[#703A3A]">{{ $g['gmv'] }} ({{ $g['share'] }}%)</span>
                    </div>
                    <div class="w-full bg-[#2B211E]/10 h-2">
                        <div class="bg-[#51634b] h-2" style="width: {{ $g['share'] }}%"></div>
                    </div>
                    <span class="text-[10px] text-[#2B211E]/60 block font-mono">{{ $g['tapak'] }} Tapak Adat Aktif</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
