@extends('layouts.admin')

@section('title', 'Generator Dokumen Resmi & Surat Keputusan')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#2B211E]/12 pb-6">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-[#703A3A] mb-1">
                <span>Administrasi Resmi & Akuntabilitas LPJ</span>
                <span>•</span>
                <span>Standar BOS / BOPTN</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Pusat Generator Dokumen Resmi & e-Pass
            </h1>
            <p class="text-sm text-[#2B211E]/70 max-w-2xl">
                Terbitkan secara otomatis dokumen legalitas berkop resmi berstempel digital: Faktur Invoice BOS, Surat Konfirmasi Rombongan (LoA), Draf Izin Riset, dan Tiket e-Pass Gerbang Masuk.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="rgs-btn-primary px-4 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-xs">
                <span class="material-symbols-outlined text-[18px]">print</span>
                <span>Cetak / Simpan PDF (A4)</span>
            </button>
        </div>
    </div>

    <!-- Selector Bar: Pilih Reservasi & Jenis Dokumen -->
    <div class="rgs-card p-4 bg-white flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        
        <!-- Booking Selector Form -->
        <form method="GET" action="{{ route('admin.documents.index') }}" class="flex flex-wrap items-center gap-3">
            <input type="hidden" name="type" value="{{ $selectedType }}">
            
            <label class="text-xs font-bold uppercase tracking-wider text-[#2B211E]/70 shrink-0">
                Pilih Rombongan:
            </label>
            <select name="code" onchange="this.form.submit()" class="p-2 border border-[#2B211E]/20 text-xs font-mono font-semibold bg-[#faf6f0] focus:ring-1 focus:ring-[#703A3A] outline-none">
                @foreach($allBookings as $b)
                <option value="{{ $b->booking_code }}" {{ $selectedBooking && $selectedBooking->booking_code === $b->booking_code ? 'selected' : '' }}>
                    {{ $b->booking_code }} — {{ $b->user->institution->institution_name ?? $b->user->name }} ({{ $b->destination->name ?? '' }})
                </option>
                @endforeach
            </select>
        </form>

        <!-- Document Type Tabs -->
        <div class="flex items-center gap-1 overflow-x-auto text-xs font-semibold uppercase tracking-wider">
            <a href="{{ route('admin.documents.index', ['code' => $selectedBooking?->booking_code, 'type' => 'invoice']) }}" 
               class="px-3 py-1.5 transition-colors {{ $selectedType === 'invoice' ? 'bg-[#703A3A] text-white' : 'text-[#2B211E]/70 hover:bg-[#2B211E]/5' }}">
                Faktur BOS
            </a>
            <a href="{{ route('admin.documents.index', ['code' => $selectedBooking?->booking_code, 'type' => 'confirmation']) }}" 
               class="px-3 py-1.5 transition-colors {{ $selectedType === 'confirmation' ? 'bg-[#703A3A] text-white' : 'text-[#2B211E]/70 hover:bg-[#2B211E]/5' }}">
                Konfirmasi (LoA)
            </a>
            <a href="{{ route('admin.documents.index', ['code' => $selectedBooking?->booking_code, 'type' => 'permit']) }}" 
               class="px-3 py-1.5 transition-colors {{ $selectedType === 'permit' ? 'bg-[#703A3A] text-white' : 'text-[#2B211E]/70 hover:bg-[#2B211E]/5' }}">
                Draf Izin Riset
            </a>
            <a href="{{ route('admin.documents.index', ['code' => $selectedBooking?->booking_code, 'type' => 'epass']) }}" 
               class="px-3 py-1.5 transition-colors {{ $selectedType === 'epass' ? 'bg-[#703A3A] text-white' : 'text-[#2B211E]/70 hover:bg-[#2B211E]/5' }}">
                e-Pass Masuk
            </a>
        </div>

    </div>

    @if($selectedBooking)
    <!-- Main A4 Document Paper Preview -->
    <div class="max-w-4xl mx-auto bg-white p-8 sm:p-12 border border-[#2B211E]/15 shadow-md space-y-8 font-serif text-[#2B211E] print:shadow-none print:border-0 print:p-0">
        
        <!-- Header Dokumen Berkop Resmi -->
        <div class="flex items-center justify-between border-b-2 border-[#2B211E] pb-6">
            <div class="space-y-1">
                <span class="font-serif text-2xl font-bold tracking-tight text-[#2B211E] block">DESTINARA</span>
                <span class="text-xs uppercase font-sans tracking-widest text-[#703A3A] font-semibold block">Ruang Belajar Tapak Nusantara</span>
                <span class="text-[11px] font-sans text-[#2B211E]/60 block">Gedung Riset Lapangan Nusantara, Jl. Cendrawasih No. 18, Sleman, D.I. Yogyakarta</span>
            </div>
            <div class="text-right font-mono text-xs space-y-1">
                <span class="text-[10px] text-[#2B211E]/60 uppercase block">STATUS DOKUMEN RESMI</span>
                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold uppercase inline-block">
                    BERSTEMPEL DIGITAL SAH
                </span>
                <span class="text-[10px] text-[#2B211E]/60 block font-mono">Ref: DST/DOC/{{ strtoupper($selectedType) }}/{{ $selectedBooking->booking_code }}</span>
            </div>
        </div>

        @if($selectedType === 'invoice')
            <!-- DOKUMEN 1: FAKTUR INVOICE BOS / SP2D -->
            <div class="space-y-6">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-bold uppercase tracking-wider text-[#2B211E]">FAKTUR PEMBAYARAN & KWITANSI RESMI (BOS)</h2>
                    <p class="font-sans text-xs text-[#2B211E]/60">Nomor: INV-BOS/DST/{{ date('Y') }}/{{ $selectedBooking->booking_code }}</p>
                </div>

                <div class="grid grid-cols-2 gap-6 font-sans text-xs py-4 border-y border-[#2B211E]/10">
                    <div class="space-y-1">
                        <span class="text-[#2B211E]/60 uppercase font-bold text-[10px]">Tertuju Kepada Institusi:</span>
                        <p class="font-serif font-bold text-base text-[#2B211E]">{{ $selectedBooking->user->institution->institution_name ?? $selectedBooking->user->name }}</p>
                        <p class="text-[#2B211E]/80">NPSN: {{ $selectedBooking->user->institution->npsn ?? '20400012' }}</p>
                        <p class="text-[#2B211E]/80">Alamat: {{ $selectedBooking->user->institution->address ?? '-' }}</p>
                    </div>
                    <div class="space-y-1 text-right font-mono">
                        <span class="text-[#2B211E]/60 uppercase font-bold text-[10px]">Rincian Transaksi:</span>
                        <p>Tanggal Terbit: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                        <p>Jatuh Tempo: {{ \Carbon\Carbon::parse($selectedBooking->visit_date)->subDays(2)->format('d F Y') }}</p>
                        <p class="font-bold text-[#703A3A]">Metode: {{ strtoupper($selectedBooking->payment->payment_method ?? 'VIRTUAL ACCOUNT BANK') }}</p>
                    </div>
                </div>

                <table class="w-full text-left font-sans text-xs border border-[#2B211E]/15">
                    <thead class="bg-[#faf6f0] border-b border-[#2B211E]/15 uppercase font-mono text-[10px]">
                        <tr>
                            <th class="p-3">Uraian Komponen Pembelajaran Lapangan</th>
                            <th class="p-3 text-center">Jumlah Delegasi</th>
                            <th class="p-3 text-right">Tarif Satuan</th>
                            <th class="p-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2B211E]/10">
                        <tr>
                            <td class="p-3">
                                <span class="font-bold block">{{ $selectedBooking->destination->name }}</span>
                                <span class="text-[11px] text-[#2B211E]/70">Tiket masuk cagar budaya, pemandu adat tersertifikasi, workshop kurikulum P5, fasilitas P3K</span>
                            </td>
                            <td class="p-3 text-center font-mono">{{ $selectedBooking->total_pax }} Peserta</td>
                            <td class="p-3 text-right font-mono">Rp {{ number_format($selectedBooking->destination->price_per_pax, 0, ',', '.') }}</td>
                            <td class="p-3 text-right font-mono font-bold">Rp {{ number_format($selectedBooking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-[#faf6f0] font-mono text-xs">
                        <tr class="border-t border-[#2B211E]/15">
                            <td colspan="3" class="p-3 text-right font-bold uppercase">Total Tagihan Bersih (BOS):</td>
                            <td class="p-3 text-right font-bold text-sm text-[#703A3A]">Rp {{ number_format($selectedBooking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <p class="font-sans text-[11px] text-[#2B211E]/70 italic">
                    *Kwitansi ini sah dan diakui sebagai bukti pengeluaran resmi belanja perjalanan edukatif BOS / DIPA Perguruan Tinggi sesuai regulasi Kemendikbudristek No. 63 Tahun 2023.
                </p>
            </div>

        @elseif($selectedType === 'confirmation')
            <!-- DOKUMEN 2: SURAT KONFIRMASI (LoA) -->
            <div class="space-y-6">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-bold uppercase tracking-wider text-[#2B211E]">SURAT PENETAPAN PENERIMAAN ROMBONGAN (LoA)</h2>
                    <p class="font-sans text-xs text-[#2B211E]/60">Nomor: SPP/DST/{{ date('Y') }}/{{ $selectedBooking->booking_code }}</p>
                </div>

                <div class="font-sans text-xs leading-relaxed space-y-4">
                    <p>Kepada Yth.,<br>
                    <strong>Pimpinan / Kepala {{ $selectedBooking->user->institution->institution_name ?? $selectedBooking->user->name }}</strong><br>
                    di Tempat</p>

                    <p>
                        Dengan hormat, menindaklanjuti permohonan kunjungan studi lapangan dari institusi Saudara dengan nomor registrasi <strong>{{ $selectedBooking->booking_code }}</strong>, bersama ini Pengelola Tapak <strong>{{ $selectedBooking->destination->name }}</strong> melalui Manajemen Destinara menyatakan:
                    </p>

                    <div class="p-4 bg-[#faf6f0] border-l-4 border-l-[#51634b] space-y-2">
                        <p class="font-bold text-sm text-[#51634b]">PERMOHONAN RESMI TELAH DISETUJUI DAN DITERIMA</p>
                        <div class="grid grid-cols-2 gap-2 text-xs font-mono">
                            <div>Tanggal Pelaksanaan: {{ \Carbon\Carbon::parse($selectedBooking->visit_date)->translatedFormat('l, d F Y') }}</div>
                            <div>Kapasitas Rombongan: {{ $selectedBooking->total_pax }} Peserta Terdaftar</div>
                            <div>Fasilitator Lapangan: Tetua Adat / Pemandu Khusus P5</div>
                            <div>Poin Kumpul Gerbang: Pendopo Utama Desa</div>
                        </div>
                    </div>

                    <p>
                        Seluruh anggota rombongan diwajibkan mematuhi kode etik kelestarian adat dan SOP keamanan yang berlaku pada tapak tujuan.
                    </p>
                </div>
            </div>

        @elseif($selectedType === 'permit')
            <!-- DOKUMEN 3: DRAF IZIN RISET -->
            <div class="space-y-6">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-bold uppercase tracking-wider text-[#2B211E]">DRAF SURAT PERMOHONAN IZIN EKSPEDISI & RISET TAPAK</h2>
                    <p class="font-sans text-xs text-[#2B211E]/60">Lampiran Resmi Pengantar Dinas / Lembaga Adat</p>
                </div>

                <div class="font-sans text-xs leading-relaxed space-y-4">
                    <p>Kepada Yth.,<br>
                    <strong>Lembaga Adat & Pengelola Kawasan {{ $selectedBooking->destination->name }}</strong><br>
                    di Wilayah {{ $selectedBooking->destination->city }}, {{ $selectedBooking->destination->province }}</p>

                    <p>
                        Kami yang bertanda tangan di bawah ini menerangkan bahwa rombongan akademis dari <strong>{{ $selectedBooking->user->institution->institution_name ?? $selectedBooking->user->name }}</strong> telah menyelesaikan pendaftaran administratif melalui Destinara untuk melaksanakan kegiatan pembelajaran lapangan dengan rincian:
                    </p>

                    <ul class="list-disc list-inside space-y-1 bg-[#faf6f0] p-4 border border-[#2B211E]/10">
                        <li><strong>Fokus Kurikulum:</strong> {{ $selectedBooking->destination->educational_highlights ?? 'Kearifan Lokal' }}</li>
                        <li><strong>Jadwal Pelaksanaan:</strong> {{ \Carbon\Carbon::parse($selectedBooking->visit_date)->translatedFormat('d F Y') }}</li>
                        <li><strong>Jumlah Delegasi:</strong> {{ $selectedBooking->total_pax }} Mahasiswa / Siswa & Dosen Pendamping</li>
                    </ul>

                    <p>
                        Mohon perkenan Bapak/Ibu pemangku adat untuk memberikan pendampingan dan bimbingan kultural selama rombongan berada di lokasi.
                    </p>
                </div>
            </div>

        @else
            <!-- DOKUMEN 4: e-PASS TIKET MASUK GERBANG -->
            <div class="space-y-6">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-bold uppercase tracking-wider text-[#2B211E]">KARTU KENDALI e-PASS ROMBONGAN EDUKASI</h2>
                    <p class="font-sans text-xs text-[#2B211E]/60">Validasi Check-in Gerbang Kedatangan Resmi</p>
                </div>

                <div class="border-2 border-dashed border-[#2B211E]/30 p-6 bg-[#faf6f0] flex flex-col sm:flex-row items-center justify-between gap-6 font-sans">
                    <div class="space-y-2">
                        <span class="px-2.5 py-1 bg-[#703A3A] text-white text-[10px] font-mono font-bold uppercase">
                            TIKET RESMI GERBANG UTAMA
                        </span>
                        <h3 class="font-serif text-2xl font-bold text-[#2B211E]">{{ $selectedBooking->destination->name }}</h3>
                        <p class="text-xs text-[#2B211E]/80">Institusi: <strong>{{ $selectedBooking->user->institution->institution_name ?? $selectedBooking->user->name }}</strong></p>
                        <p class="text-xs text-[#2B211E]/80">Kapasitas: <strong class="font-mono">{{ $selectedBooking->total_pax }} Pax</strong> • Tanggal: <strong class="font-mono">{{ \Carbon\Carbon::parse($selectedBooking->visit_date)->format('d/m/Y') }}</strong></p>
                    </div>

                    <!-- Simulated QR Code -->
                    <div class="w-32 h-32 bg-white p-2 border border-[#2B211E]/20 flex flex-col items-center justify-center shrink-0 text-center">
                        <div class="w-24 h-24 bg-[#2B211E] p-1 flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-5xl">qr_code_2</span>
                        </div>
                        <span class="text-[8px] font-mono mt-1 text-[#2B211E]/70">{{ $selectedBooking->booking_code }}</span>
                    </div>
                </div>

                <p class="font-sans text-xs text-center text-[#2B211E]/60">
                    Tunjukkan e-Pass ini kepada pos penjagaan atau fasilitator adat saat bus rombongan tiba di lokasi.
                </p>
            </div>
        @endif

        <!-- Stempel Digital & Tanda Tangan Resmi -->
        <div class="pt-8 border-t border-[#2B211E]/15 flex items-center justify-between font-sans text-xs">
            <div class="space-y-1">
                <span class="text-[10px] text-[#2B211E]/50 font-mono">OTENTIKASI SISTEM DIGITAL:</span>
                <div class="flex items-center gap-2 text-emerald-800 font-mono text-[11px] font-bold">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>SHA-256: d8f1a0e882c91b7e4f3a...verified</span>
                </div>
            </div>

            <!-- Stempel Oval Destinara -->
            <div class="text-center relative">
                <div class="w-32 h-20 border-2 border-[#703A3A] rounded-full flex flex-col items-center justify-center p-1 text-[#703A3A] -rotate-6 shadow-xs opacity-90">
                    <span class="text-[8px] font-bold tracking-widest uppercase">PLATFORM RESMI</span>
                    <span class="font-serif font-bold text-xs">DESTINARA</span>
                    <span class="text-[7px] font-mono">TERVERIFIKASI SAH</span>
                </div>
                <span class="text-[10px] font-mono text-[#2B211E]/60 block mt-1">Lead Kurator Destinara</span>
            </div>
        </div>

    </div>
    @endif

    <!-- Arsip Dokumen Terbit Terbaru -->
    <div class="rgs-card bg-white p-6">
        <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3 mb-4">
            <h3 class="font-serif text-base font-bold text-[#2B211E]">Arsip Dokumen Terbit di Sistem</h3>
            <span class="text-xs text-[#2B211E]/60 font-mono">{{ count($documentsArchive) }} Dokumen Terarsip</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#2B211E]/10 text-[#2B211E]/60 font-mono uppercase">
                        <th class="pb-2 font-semibold">Nomor Surat</th>
                        <th class="pb-2 font-semibold">Jenis Dokumen</th>
                        <th class="pb-2 font-semibold">Kode Booking / Tapak</th>
                        <th class="pb-2 font-semibold">Tanggal Terbit</th>
                        <th class="pb-2 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2B211E]/08">
                    @forelse($documentsArchive as $doc)
                    <tr class="hover:bg-[#faf6f0]/50">
                        <td class="py-2.5 font-mono font-bold text-[#703A3A]">{{ $doc->document_number }}</td>
                        <td class="py-2.5 uppercase font-medium">{{ str_replace('_', ' ', $doc->type) }}</td>
                        <td class="py-2.5">{{ $doc->booking->booking_code ?? '-' }} ({{ $doc->booking->destination->name ?? '-' }})</td>
                        <td class="py-2.5 font-mono text-[#2B211E]/70">{{ $doc->created_at->format('d/m/Y') }}</td>
                        <td class="py-2.5 text-right">
                            <a href="{{ route('buyer.document.download', ['code' => $doc->booking->booking_code, 'type' => $doc->type]) }}" target="_blank" class="text-[#703A3A] font-semibold hover:underline">
                                Unduh Salinan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-[#2B211E]/50">Belum ada arsip dokumen tambahan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
