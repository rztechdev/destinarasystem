@extends('layouts.buyer')

@section('title', 'Kasir & Pembayaran Pesanan #' . $booking->booking_code)

@section('content')
<div x-data="{
    method: 'bca_va',
    copied: false,
    vaNumbers: {
        'bca_va': '8271 0812 3456 7890',
        'mandiri_va': '8870 0812 3456 7890',
        'bni_va': '9881 0812 3456 7890',
        'bri_va': '1029 0812 3456 7890'
    },
    get currentVa() {
        return this.vaNumbers[this.method] || '8271 0812 3456 7890';
    },
    copyVa() {
        navigator.clipboard.writeText(this.currentVa.replace(/\s+/g, ''));
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    }
}" class="space-y-8 max-w-4xl mx-auto">

    <!-- Header Breadcrumb & Checkout -->
    <div class="pb-4 border-b border-[#2B211E]/12">
        <div class="flex items-center gap-2 text-xs text-[#2B211E]/60 mb-2">
            <a href="{{ route('buyer.dashboard') }}" class="hover:text-[#703A3A]">Dashboard</a>
            <span>/</span>
            <a href="{{ route('buyer.booking.show', $booking->booking_code) }}" class="hover:text-[#703A3A]">Dossier #{{ $booking->booking_code }}</a>
            <span>/</span>
            <span class="text-[#703A3A] font-semibold">Kasir & Pembayaran</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">Penyelesaian Pembayaran Resmi</h1>
                <p class="text-xs sm:text-sm text-[#2B211E]/70 mt-0.5">
                    Transaksi aman melalui gateway berizin Bank Indonesia dan mendukung rekonsiliasi SP2D/BOS.
                </p>
            </div>

            <!-- Countdown Timer Pembayaran -->
            <div class="px-3.5 py-2 bg-[#b87a38]/10 border border-[#b87a38]/30 text-[#b87a38] text-xs font-semibold flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">timer</span>
                <div>
                    <span class="text-[10px] uppercase block leading-none">Batas Waktu:</span>
                    <span class="font-mono font-bold text-sm text-[#2B211E]">23 : 59 : 45</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Nilai Tagihan (Plinth Card) -->
    <div class="rgs-card p-6 border-t-4 border-t-[#703A3A] bg-white">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#2B211E]/10">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#703A3A] block">Destinasi Rombongan:</span>
                <h2 class="font-serif text-xl font-bold text-[#2B211E]">{{ $booking->destination->name }}</h2>
                <div class="text-xs text-[#2B211E]/60 mt-0.5">
                    {{ $booking->participant_count }} Siswa • {{ \Carbon\Carbon::parse($booking->planned_date_start)->translatedFormat('d M Y') }}
                </div>
            </div>
            <div class="text-left sm:text-right">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#2B211E]/60 block">Total Tagihan Lunas</span>
                <span class="font-serif text-2xl sm:text-3xl font-bold text-[#703A3A]">
                    Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Breakdown Singkat -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3 text-xs text-[#2B211E]/75">
            <div>• Tiket & Modul Adat: <strong>Rp {{ number_format($booking->subtotal_amount, 0, ',', '.') }}</strong></div>
            <div>• Asuransi Lapangan: <strong>Rp {{ number_format($booking->insurance_amount, 0, ',', '.') }}</strong></div>
            <div>• Biaya Admin/SPK: <strong>Rp {{ number_format($booking->platform_fee, 0, ',', '.') }}</strong></div>
        </div>
    </div>

    <!-- Pilihan Metode Pembayaran -->
    <div class="space-y-4">
        <h3 class="font-serif text-lg font-bold text-[#2B211E]">Pilih Metode Pembayaran</h3>

        <!-- Tabs Navigasi Metode -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <button type="button" @click="method = 'bca_va'" class="p-3.5 rgs-card text-left border transition-all" :class="method.includes('_va') ? 'border-[#703A3A] bg-[#703A3A]/5 ring-1 ring-[#703A3A]' : 'border-[#2B211E]/15'">
                <div class="flex items-center gap-2 text-xs font-bold text-[#2B211E]">
                    <span class="material-symbols-outlined text-[#703A3A] text-[18px]">account_balance</span>
                    <span>Virtual Account Bank</span>
                </div>
                <div class="text-[11px] text-[#2B211E]/60 mt-1">BCA, Mandiri, BNI, BRI (Otomatis)</div>
            </button>

            <button type="button" @click="method = 'qris'" class="p-3.5 rgs-card text-left border transition-all" :class="method === 'qris' ? 'border-[#703A3A] bg-[#703A3A]/5 ring-1 ring-[#703A3A]' : 'border-[#2B211E]/15'">
                <div class="flex items-center gap-2 text-xs font-bold text-[#2B211E]">
                    <span class="material-symbols-outlined text-[#703A3A] text-[18px]">qr_code_scanner</span>
                    <span>QRIS Instan</span>
                </div>
                <div class="text-[11px] text-[#2B211E]/60 mt-1">Scan instan semua aplikasi m-Banking</div>
            </button>

            <button type="button" @click="method = 'dana_bos'" class="p-3.5 rgs-card text-left border transition-all" :class="method === 'dana_bos' ? 'border-[#703A3A] bg-[#703A3A]/5 ring-1 ring-[#703A3A]' : 'border-[#2B211E]/15'">
                <div class="flex items-center gap-2 text-xs font-bold text-[#2B211E]">
                    <span class="material-symbols-outlined text-[#51634b] text-[18px]">receipt</span>
                    <span>Jalur Khusus Dana BOS / SP2D</span>
                </div>
                <div class="text-[11px] text-[#2B211E]/60 mt-1">Invoice resmi bendahara sekolah</div>
            </button>
        </div>

        <!-- Detail Konten Tab 1: Virtual Account -->
        <div x-show="method.includes('_va')" class="rgs-card p-6 border-t-4 border-t-[#703A3A] space-y-4">
            <div class="flex flex-wrap items-center gap-2 pb-3 border-b border-[#2B211E]/10 text-xs">
                <span class="font-bold uppercase tracking-wider text-[#2B211E]">Pilih Bank Penerbit:</span>
                <button type="button" @click="method = 'bca_va'" class="px-3 py-1 font-bold border text-xs" :class="method === 'bca_va' ? 'bg-[#703A3A] text-white border-[#703A3A]' : 'bg-[#faf6f0] border-[#2B211E]/20 text-[#2B211E]'">BCA</button>
                <button type="button" @click="method = 'mandiri_va'" class="px-3 py-1 font-bold border text-xs" :class="method === 'mandiri_va' ? 'bg-[#703A3A] text-white border-[#703A3A]' : 'bg-[#faf6f0] border-[#2B211E]/20 text-[#2B211E]'">Mandiri</button>
                <button type="button" @click="method = 'bni_va'" class="px-3 py-1 font-bold border text-xs" :class="method === 'bni_va' ? 'bg-[#703A3A] text-white border-[#703A3A]' : 'bg-[#faf6f0] border-[#2B211E]/20 text-[#2B211E]'">BNI</button>
                <button type="button" @click="method = 'bri_va'" class="px-3 py-1 font-bold border text-xs" :class="method === 'bri_va' ? 'bg-[#703A3A] text-white border-[#703A3A]' : 'bg-[#faf6f0] border-[#2B211E]/20 text-[#2B211E]'">BRI</button>
            </div>

            <!-- Plinth Nomor VA & Tombol Salin -->
            <div class="p-5 bg-[#faf6f0] border border-[#2B211E]/15 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#2B211E]/60 block">Nomor Virtual Account Destinara:</span>
                    <div class="font-mono text-xl sm:text-2xl font-bold tracking-wider text-[#703A3A]" x-text="currentVa"></div>
                    <span class="text-[11px] text-[#2B211E]/60 block mt-0.5">Nama Akun: <strong>DESTINARA — {{ $booking->institution->institution_name }}</strong></span>
                </div>

                <button type="button" @click="copyVa()" class="px-4 py-2 text-xs font-bold uppercase tracking-wider border border-[#703A3A] text-[#703A3A] bg-white hover:bg-[#703A3A] hover:text-white transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]" x-text="copied ? 'check' : 'content_copy'"></span>
                    <span x-text="copied ? 'Tersalin!' : 'Salin Nomor'"></span>
                </button>
            </div>

            <!-- Petunjuk Singkat -->
            <div class="text-xs text-[#2B211E]/75 space-y-1.5 pt-2">
                <div class="font-bold text-[#2B211E]">Petunjuk Pembayaran ATM / Mobile Banking:</div>
                <ol class="list-decimal list-inside space-y-1 text-[11px]">
                    <li>Buka aplikasi m-Banking atau kunjungi mesin ATM terdekat.</li>
                    <li>Pilih menu <strong>Transfer &gt; Virtual Account / Bayar Tagihan</strong>.</li>
                    <li>Masukkan nomor Virtual Account di atas beserta nominal tepat <strong>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</strong>.</li>
                    <li>Verifikasi nama institusi dan selesaikan otorisasi transaksi.</li>
                </ol>
            </div>
        </div>

        <!-- Detail Konten Tab 2: QRIS -->
        <div x-show="method === 'qris'" class="rgs-card p-6 border-t-4 border-t-[#703A3A] space-y-4">
            <div class="text-center max-w-xs mx-auto space-y-3">
                <div class="text-xs font-bold uppercase tracking-wider text-[#703A3A]">Scan Kode QRIS Resmi</div>
                <div class="p-4 bg-white border border-[#2B211E]/20 inline-block shadow-sm">
                    <!-- Ilustrasi QR Code -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=DESTINARA-{{ $booking->booking_code }}-{{ $booking->total_amount }}" alt="QRIS Code" class="w-44 h-44 mx-auto">
                </div>
                <div class="text-[11px] text-[#2B211E]/70 leading-tight">
                    Dapat dipindai melalui aplikasi BCA Mobile, Livin by Mandiri, BRImo, BNI Mobile, GoPay, OVO, ShopeePay, atau DANA.
                </div>
            </div>
        </div>

        <!-- Detail Konten Tab 3: Khusus BOS / SP2D -->
        <div x-show="method === 'dana_bos'" class="rgs-card p-6 border-t-4 border-t-[#51634b] space-y-4">
            <div class="p-4 bg-[#51634b]/10 border border-[#51634b]/30 text-xs space-y-2">
                <div class="font-bold text-[#51634b] flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                    <span>Prosedur Pencairan SP2D / Giro Kas Sekolah</span>
                </div>
                <p class="text-[11px] leading-relaxed text-[#2B211E]/80">
                    Untuk pembayaran melalui mekanisme anggaran BOS Reguler/Kinerja, bendahara sekolah dapat mencetak invoice resmi berstempel basah digital sebagai lampiran SPJ pencairan ke Bank Pembangunan Daerah (BPD).
                </p>
                <div class="font-mono text-[11px] text-[#2B211E] pt-1">
                    Rekening Giro Escrow: <strong>Bank Jateng 1-002-998877-0</strong> a.n. <strong>PT DESTINARA EDUKASI NUSANTARA</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Aksi Simulasi Pembayaran Instan (Sandbox Midtrans) -->
    <div class="rgs-card p-6 bg-[#faf6f0] border border-[#703A3A]/30 space-y-4">
        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#703A3A]">
            <span class="material-symbols-outlined text-[20px]">smart_toy</span>
            <span>Simulasi Pelunasan Transaksi (Sandbox Gateway)</span>
        </div>
        <p class="text-xs text-[#2B211E]/75 leading-relaxed">
            Klik tombol di bawah untuk langsung mengonfirmasi pembayaran lunas pada sistem. Status pesanan akan otomatis berganti ke <strong>Terkonfirmasi & Lunas</strong> serta dokumen Surat Konfirmasi (e-Pass) dan Draf Izin Riset akan langsung diterbitkan.
        </p>

        <form action="{{ route('buyer.booking.pay', $booking->booking_code) }}" method="POST" class="pt-2">
            @csrf
            <input type="hidden" name="payment_method" :value="method">

            <button type="submit" class="w-full rgs-btn-primary py-3.5 px-6 text-xs font-bold uppercase tracking-widest shadow-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">task_alt</span>
                <span>Konfirmasi Pelunasan Pembayaran Sekarang (Simulasi Lunas)</span>
            </button>
        </form>
    </div>

</div>
@endsection
