@extends('layouts.superadmin')

@section('title', 'Rekonsiliasi Keuangan & Audit Master')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#2B211E]/12 pb-6">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-[#4A1E1E] mb-1">
                <span>Integritas Keuangan & Audit Trail</span>
                <span>•</span>
                <span>Protokol Escrow Terpadu</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Rekonsiliasi Keuangan & Audit Master
            </h1>
            <p class="text-sm text-[#2B211E]/70 max-w-2xl">
                Lakukan pencocokan mutasi kas masuk Virtual Account dengan transfer dana mitra adat, kelola saldo escrow mengendap, dan telaah audit trail seluruh transaksi.
            </p>
        </div>

        <!-- Tombol Tutup Buku -->
        <form action="{{ route('superadmin.reconciliation.trigger') }}" method="POST">
            @csrf
            <button type="submit" class="rgs-btn-dark px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-xs">
                <span class="material-symbols-outlined text-[18px]">verified</span>
                <span>Sahkan Tutup Buku Bulan Ini</span>
            </button>
        </form>
    </div>

    <!-- Tabel Rekonsiliasi Finansial Bulanan -->
    <div class="rgs-card bg-white p-6 space-y-4">
        <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
            <div>
                <h3 class="font-serif text-lg font-bold text-[#2B211E]">Buku Kas Rekonsiliasi Escrow Bulanan</h3>
                <p class="text-xs text-[#2B211E]/60">Pencocokan bruto pembayaran buyer, potongan komisi platform 10%, dan hak bersih mitra 90%</p>
            </div>
            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-900 border border-emerald-300 text-xs font-mono font-bold uppercase">
                Status Kas: Seimbang (Matched)
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#faf6f0] border-b border-[#2B211E]/12 text-[#2B211E]/60 uppercase tracking-wider font-mono">
                        <th class="py-3 px-4 font-semibold">Periode Pembukuan</th>
                        <th class="py-3 px-4 font-semibold text-right">Dana Masuk (Gross)</th>
                        <th class="py-3 px-4 font-semibold text-right">Komisi Platform (10%)</th>
                        <th class="py-3 px-4 font-semibold text-right">Payout Mitra Adat (90%)</th>
                        <th class="py-3 px-4 font-semibold text-right">Saldo Escrow Mengendap</th>
                        <th class="py-3 px-4 font-semibold text-center">Status Audit</th>
                        <th class="py-3 px-4 font-semibold">Catatan Otoritas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2B211E]/08 font-mono">
                    @foreach($reconciliations as $rec)
                    <tr class="hover:bg-[#faf6f0]/60 transition-colors">
                        <td class="py-3.5 px-4 font-bold text-[#4A1E1E]">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $rec->period_month)->translatedFormat('F Y') }}
                        </td>
                        <td class="py-3.5 px-4 text-right font-bold text-[#2B211E]">
                            Rp {{ number_format($rec->gross_inflow, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-right font-bold text-[#703A3A]">
                            Rp {{ number_format($rec->platform_commission, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-right font-bold text-[#51634b]">
                            Rp {{ number_format($rec->partner_payouts_total, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-right font-bold text-amber-800">
                            Rp {{ number_format($rec->escrow_holding, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-900 border border-emerald-300 text-[10px] font-bold uppercase inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">check</span>
                                <span>RECONCILED</span>
                            </span>
                        </td>
                        <td class="py-3.5 px-4 font-sans text-[11px] text-[#2B211E]/75">
                            {{ $rec->notes }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pencocokan Mutasi Rekening Bank Penampung -->
    <div class="rgs-card bg-white p-6 space-y-4">
        <div class="border-b border-[#2B211E]/10 pb-3">
            <h3 class="font-serif text-base font-bold text-[#2B211E]">Pencocokan Saldo Rekening Bank Operasional & Escrow</h3>
            <p class="text-xs text-[#2B211E]/60">Validasi mutasi bank penampung resmi dengan database core platform</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($bankLedgers as $b)
            <div class="p-4 bg-[#faf6f0] border border-[#2B211E]/15 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[#2B211E]">{{ $b['bank'] }}</span>
                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-900 border border-emerald-300 text-[9px] font-mono font-bold">{{ $b['status'] }}</span>
                </div>
                <div class="space-y-1 text-xs font-mono">
                    <div class="flex justify-between text-[#2B211E]/70"><span>No. Rekening:</span><span class="font-bold text-[#2B211E]">{{ $b['acc'] }}</span></div>
                    <div class="flex justify-between text-[#2B211E]/70"><span>Total Mutasi Masuk:</span><span>Rp {{ number_format($b['inflow'], 0, ',', '.') }}</span></div>
                    <div class="flex justify-between text-[#2B211E]/70"><span>Total Transfer Keluar:</span><span>Rp {{ number_format($b['outflow'], 0, ',', '.') }}</span></div>
                    <div class="flex justify-between pt-1 border-t border-[#2B211E]/10 text-emerald-800 font-bold">
                        <span>Saldo Terakhir:</span>
                        <span>Rp {{ number_format($b['balance'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Master Security & Transaction Audit Trail -->
    <div class="rgs-card bg-white p-6 space-y-4">
        <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
            <div>
                <h3 class="font-serif text-base font-bold text-[#2B211E]">Master Audit Trail (Log Keamanan Root)</h3>
                <p class="text-xs text-[#2B211E]/60">Catatan tak terhapuskan seluruh aksi operasional, finansial, dan pengubahan parameter</p>
            </div>
            <div class="flex items-center gap-2 text-xs font-mono text-emerald-800 font-bold">
                <span class="material-symbols-outlined text-[16px]">verified</span>
                <span>Integritas Log: Tersegel Kriptografis</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead>
                    <tr class="bg-[#faf6f0] border-b border-[#2B211E]/10 text-[#2B211E]/60 uppercase text-[10px]">
                        <th class="py-2.5 px-3">Timestamp</th>
                        <th class="py-2.5 px-3">Pelaku Aksi</th>
                        <th class="py-2.5 px-3">Jenis Operasi</th>
                        <th class="py-2.5 px-3">Deskripsi Audit Tindakan</th>
                        <th class="py-2.5 px-3 text-right">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2B211E]/08 text-[11px]">
                    @foreach($masterAudits as $ma)
                    <tr class="hover:bg-[#faf6f0]/50">
                        <td class="py-2.5 px-3 text-[#2B211E]/60 whitespace-nowrap">{{ $ma->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="py-2.5 px-3 font-sans font-semibold text-[#2B211E]">{{ $ma->user->name ?? 'System Root' }}</td>
                        <td class="py-2.5 px-3 font-bold text-[#4A1E1E] uppercase">{{ $ma->action }}</td>
                        <td class="py-2.5 px-3 font-sans text-[#2B211E]/80 leading-relaxed">{{ $ma->description }}</td>
                        <td class="py-2.5 px-3 text-right text-[#2B211E]/50">{{ $ma->ip_address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
