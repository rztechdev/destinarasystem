@extends('layouts.superadmin')

@section('title', 'Pengaturan Master & Parameter Platform')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#2B211E]/12 pb-6">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-[#703A3A] mb-1">
                <span>Konfigurasi Inti Platform</span>
                <span>•</span>
                <span>Tingkat Pengawas Root</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Pengaturan Master & Parameter Ekosistem
            </h1>
            <p class="text-sm text-[#2B211E]/70 max-w-2xl">
                Kelola kunci API pembayaran Midtrans, aturan persentase bagi hasil adat, batas waktu kadaluarsa transaksi, dan format pesan notifikasi otomatis.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-emerald-100 text-emerald-900 border border-emerald-300 text-xs font-mono font-bold uppercase">
                Sistem: Operasional Normal
            </span>
        </div>
    </div>

    <!-- Master Settings Form -->
    <form action="{{ route('superadmin.settings.update') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Group 1: Payment Gateway & Midtrans -->
        <div class="rgs-card p-6 bg-white space-y-4">
            <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#703A3A]">credit_card</span>
                    <h3 class="font-serif text-base font-bold text-[#2B211E]">1. Payment Gateway & Virtual Account Midtrans</h3>
                </div>
                <span class="text-xs font-mono text-[#2B211E]/60 uppercase">Snap Engine v2</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1 sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Midtrans Server Key</label>
                    <input type="password" name="midtrans_server_key" value="{{ \App\Models\SystemSetting::get('midtrans_server_key', 'SB-Mid-server-82xK9L2pQW09mNZ') }}" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono focus:ring-1 focus:ring-[#703A3A] outline-none">
                    <p class="text-[10px] text-[#2B211E]/60">Kunci rahasia untuk verifikasi webhook notifikasi pembayaran server-to-server.</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Midtrans Client Key</label>
                    <input type="text" name="midtrans_client_key" value="{{ \App\Models\SystemSetting::get('midtrans_client_key', 'SB-Mid-client-11jKlO098zA') }}" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono focus:ring-1 focus:ring-[#703A3A] outline-none">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Mode Transaksi Lingkungan</label>
                    <select name="midtrans_environment" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono font-bold bg-white focus:ring-1 focus:ring-[#703A3A] outline-none">
                        <option value="sandbox" {{ \App\Models\SystemSetting::get('midtrans_environment') === 'sandbox' ? 'selected' : '' }}>SANDBOX (Pengujian / Demo)</option>
                        <option value="production" {{ \App\Models\SystemSetting::get('midtrans_environment') === 'production' ? 'selected' : '' }}>PRODUCTION (Live Transaksi Nyata)</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Batas Waktu Pembayaran Virtual Account (Jam)</label>
                    <input type="number" name="payment_expiry_hours" value="{{ \App\Models\SystemSetting::get('payment_expiry_hours', '24') }}" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono font-bold focus:ring-1 focus:ring-[#703A3A] outline-none">
                    <p class="text-[10px] text-[#2B211E]/60">Sistem otomatis membatalkan reservasi jika SP2D/VA tidak dilunasi.</p>
                </div>
            </div>
        </div>

        <!-- Group 2: Aturan Komisi & Hak Mitra Adat -->
        <div class="rgs-card p-6 bg-white space-y-4">
            <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#51634b]">pie_chart</span>
                    <h3 class="font-serif text-base font-bold text-[#2B211E]">2. Struktur Komisi & Bagi Hasil Masyarakat Adat</h3>
                </div>
                <span class="text-xs font-mono text-[#51634b] font-bold uppercase">PRD Sec. 7.9</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#703A3A]">Komisi Platform Destinara (%)</label>
                    <div class="relative">
                        <input type="number" step="0.1" name="platform_commission_percent" value="{{ \App\Models\SystemSetting::get('platform_commission_percent', '10') }}" required class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono font-bold focus:ring-1 focus:ring-[#703A3A] outline-none">
                        <span class="absolute right-3 top-2.5 text-xs font-mono text-[#2B211E]/60">%</span>
                    </div>
                    <p class="text-[10px] text-[#2B211E]/60">Biaya pemeliharaan sistem & kurasi lapangan.</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#51634b]">Hak Bersih Pengelola Adat (%)</label>
                    <div class="relative">
                        <input type="number" step="0.1" name="partner_share_percent" value="{{ \App\Models\SystemSetting::get('partner_share_percent', '90') }}" required class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono font-bold focus:ring-1 focus:ring-[#703A3A] outline-none">
                        <span class="absolute right-3 top-2.5 text-xs font-mono text-[#2B211E]/60">%</span>
                    </div>
                    <p class="text-[10px] text-[#2B211E]/60">Hak dana tunai yang ditransfer ke BPD Bali / BJB.</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Hari Batch Pencairan Dana</label>
                    <select name="payout_schedule_day" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-semibold bg-white focus:ring-1 focus:ring-[#703A3A] outline-none">
                        <option value="Senin" {{ \App\Models\SystemSetting::get('payout_schedule_day') === 'Senin' ? 'selected' : '' }}>Setiap Hari Senin</option>
                        <option value="Rabu" {{ \App\Models\SystemSetting::get('payout_schedule_day') === 'Rabu' ? 'selected' : '' }}>Setiap Hari Rabu</option>
                        <option value="Jumat" {{ \App\Models\SystemSetting::get('payout_schedule_day') === 'Jumat' ? 'selected' : '' }}>Setiap Hari Jumat</option>
                    </select>
                    <p class="text-[10px] text-[#2B211E]/60">Jadwal kliring otomatis batch transfer.</p>
                </div>
            </div>
        </div>

        <!-- Group 3: Template Notifikasi WhatsApp & Email -->
        <div class="rgs-card p-6 bg-white space-y-4">
            <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#2B3A4A]">mark_chat_read</span>
                    <h3 class="font-serif text-base font-bold text-[#2B211E]">3. Redaksi Pesan Notifikasi Gateway</h3>
                </div>
                <span class="text-xs font-mono text-[#2B211E]/60">Placeholder Token Supported</span>
            </div>

            <div class="space-y-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">
                        Template Pesan WhatsApp (Reservasi Baru Masuk)
                    </label>
                    <textarea name="whatsapp_template_booking" rows="3" class="w-full p-3 border border-[#2B211E]/20 text-xs font-sans focus:ring-1 focus:ring-[#703A3A] outline-none leading-relaxed">{{ \App\Models\SystemSetting::get('whatsapp_template_booking') }}</textarea>
                    <p class="text-[10px] font-mono text-[#2B211E]/60">Token: {NAMA_INSTITUSI}, {KODE_BOOKING}, {NAMA_TAPAK}, {TOTAL_BAYAR}</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">
                        Template Email Pemberitahuan e-Pass Terbit
                    </label>
                    <textarea name="email_template_epass" rows="3" class="w-full p-3 border border-[#2B211E]/20 text-xs font-sans focus:ring-1 focus:ring-[#703A3A] outline-none leading-relaxed">{{ \App\Models\SystemSetting::get('email_template_epass') }}</textarea>
                    <p class="text-[10px] font-mono text-[#2B211E]/60">Token: {NAMA_PIC}, {KODE_BOOKING}, {JUMLAH_PAX}</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="rgs-btn-dark px-8 py-3 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Seluruh Pengaturan Master</span>
            </button>
        </div>
    </form>

</div>
@endsection
