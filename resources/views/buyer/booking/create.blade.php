@extends('layouts.buyer')

@section('title', 'Form Pengajuan Booking Rombongan')

@section('content')
<div x-data="{
    destinations: {{ Js::from($destinations) }},
    selectedDestId: {{ $selectedDestination->id ?? 1 }},
    inquiryType: '{{ $reorderData->inquiry_type ?? 'study_tour' }}',
    participants: {{ $reorderData->participant_count ?? 30 }},
    guides: {{ $reorderData->guide_count ?? 2 }},
    dateStart: '{{ \Carbon\Carbon::now()->addDays(14)->toDateString() }}',
    dateEnd: '{{ \Carbon\Carbon::now()->addDays(16)->toDateString() }}',
    needsPermit: true,
    get currentDestination() {
        return this.destinations.find(d => d.id == this.selectedDestId) || this.destinations[0];
    },
    get subtotal() {
        return (this.currentDestination.price_per_pax || 0) * this.participants;
    },
    get insurance() {
        return this.participants * 2000;
    },
    get platformFee() {
        return 25000;
    },
    get total() {
        return this.subtotal + this.insurance + this.platformFee;
    },
    formatRupiah(num) {
        return 'Rp ' + (num || 0).toLocaleString('id-ID');
    }
}" class="space-y-8">

    <!-- Header Breadcrumb & Judul -->
    <div class="pb-4 border-b border-[#2B211E]/12">
        <div class="flex items-center gap-2 text-xs text-[#2B211E]/60 mb-2">
            <a href="{{ route('buyer.dashboard') }}" class="hover:text-[#703A3A]">Dashboard</a>
            <span>/</span>
            <span class="text-[#703A3A] font-semibold">Pengajuan Rombongan Baru</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">Formulir Pengajuan Rombongan Belajar</h1>
                <p class="text-xs sm:text-sm text-[#2B211E]/70 mt-0.5">
                    Lengkapi spesifikasi ekskursi agar mitra tapak dan tim kurasi Destinara dapat mempersiapkan izin adat, akomodasi, dan pemandu lokal.
                </p>
            </div>
            @if($reorderData)
            <div class="px-3 py-1.5 bg-[#51634b]/10 border border-[#51634b]/30 text-[#51634b] text-xs font-semibold flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">repeat</span>
                <span>Pesan Ulang dari Pesanan #{{ $reorderData->booking_code }}</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Multi-step Stepper Tracker Visual -->
    <div class="grid grid-cols-3 border border-[#2B211E]/15 bg-white text-xs">
        <div class="p-3 sm:p-4 border-r border-[#2B211E]/15 bg-[#703A3A]/8 flex items-center gap-2.5">
            <span class="w-6 h-6 rounded-none bg-[#703A3A] text-white flex items-center justify-center font-bold text-xs">1</span>
            <div>
                <div class="font-bold text-[#703A3A] uppercase tracking-wide">Tahap 1</div>
                <div class="text-[11px] text-[#2B211E]/70 hidden sm:block">Destinasi & Kategori</div>
            </div>
        </div>
        <div class="p-3 sm:p-4 border-r border-[#2B211E]/15 bg-[#703A3A]/8 flex items-center gap-2.5">
            <span class="w-6 h-6 rounded-none bg-[#703A3A] text-white flex items-center justify-center font-bold text-xs">2</span>
            <div>
                <div class="font-bold text-[#703A3A] uppercase tracking-wide">Tahap 2</div>
                <div class="text-[11px] text-[#2B211E]/70 hidden sm:block">Rombongan & Tanggal</div>
            </div>
        </div>
        <div class="p-3 sm:p-4 bg-[#703A3A]/8 flex items-center gap-2.5">
            <span class="w-6 h-6 rounded-none bg-[#703A3A] text-white flex items-center justify-center font-bold text-xs">3</span>
            <div>
                <div class="font-bold text-[#703A3A] uppercase tracking-wide">Tahap 3</div>
                <div class="text-[11px] text-[#2B211E]/70 hidden sm:block">Dokumen & Invoice</div>
            </div>
        </div>
    </div>

    <form action="{{ route('buyer.booking.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf

        <!-- Kolom Kiri: Form Isian Bertahap (7 Kolom) -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Card 1: Pemilihan Destinasi & Kebutuhan -->
            <div class="rgs-card p-6 border-t-4 border-t-[#703A3A] space-y-5">
                <div class="flex items-center gap-2 pb-3 border-b border-[#2B211E]/10">
                    <span class="material-symbols-outlined text-[#703A3A] text-[20px]">location_on</span>
                    <h2 class="font-serif text-lg font-bold text-[#2B211E]">1. Pemilihan Tapak & Kategori Kebutuhan</h2>
                </div>

                <!-- Pilihan Destinasi -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                        Pilih Destinasi Laboratorium Tapak <span class="text-red-500">*</span>
                    </label>
                    <select name="destination_id" x-model="selectedDestId" class="w-full bg-[#faf6f0] border border-[#2B211E]/20 px-3.5 py-2.5 text-xs text-[#2B211E] font-medium focus:outline-none focus:border-[#703A3A]">
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ ($selectedDestination && $selectedDestination->id == $dest->id) ? 'selected' : '' }}>
                                {{ $dest->name }} — {{ $dest->city }}, {{ $dest->province }} (Rp {{ number_format($dest->price_per_pax, 0, ',', '.') }}/pax)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipe Kebutuhan (Radio Cards) -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                        Tipe Kebutuhan Akademik <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="rgs-card p-3.5 cursor-pointer border hover:border-[#703A3A] transition-colors" :class="inquiryType === 'study_tour' ? 'border-[#703A3A] bg-[#703A3A]/5 ring-1 ring-[#703A3A]' : 'border-[#2B211E]/15'">
                            <div class="flex items-start gap-2.5">
                                <input type="radio" name="inquiry_type" value="study_tour" x-model="inquiryType" class="mt-0.5 accent-[#703A3A]">
                                <div>
                                    <div class="font-serif text-sm font-bold text-[#2B211E]">Study Tour & P5</div>
                                    <div class="text-[11px] text-[#2B211E]/70 leading-relaxed mt-0.5">
                                        Fokus kurikulum Projek Penguatan Profil Pelajar Pancasila, kebhinekaan global, kearifan lokal.
                                    </div>
                                </div>
                            </div>
                        </label>

                        <label class="rgs-card p-3.5 cursor-pointer border hover:border-[#703A3A] transition-colors" :class="inquiryType === 'penelitian' ? 'border-[#703A3A] bg-[#703A3A]/5 ring-1 ring-[#703A3A]' : 'border-[#2B211E]/15'">
                            <div class="flex items-start gap-2.5">
                                <input type="radio" name="inquiry_type" value="penelitian" x-model="inquiryType" class="mt-0.5 accent-[#703A3A]">
                                <div>
                                    <div class="font-serif text-sm font-bold text-[#2B211E]">Penelitian Lapangan</div>
                                    <div class="text-[11px] text-[#2B211E]/70 leading-relaxed mt-0.5">
                                        Riset ekologi/antropologi, pengambilan data primer, bimbingan tetua adat & narasumber kunci.
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 2: Rombongan & Tanggal -->
            <div class="rgs-card p-6 border-t-4 border-t-[#703A3A] space-y-5">
                <div class="flex items-center gap-2 pb-3 border-b border-[#2B211E]/10">
                    <span class="material-symbols-outlined text-[#703A3A] text-[20px]">group</span>
                    <h2 class="font-serif text-lg font-bold text-[#2B211E]">2. Data Rombongan & Jadwal Pelaksanaan</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Jumlah Siswa / Peserta -->
                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                            Jumlah Siswa / Peserta <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="participant_count" min="5" max="500" x-model.number="participants" class="w-full bg-[#faf6f0] border border-[#2B211E]/20 px-3.5 py-2 text-xs font-bold text-[#2B211E] focus:outline-none focus:border-[#703A3A]">
                            <span class="absolute right-3 top-2 text-[11px] text-[#2B211E]/60">Orang</span>
                        </div>
                        <span class="text-[10px] text-[#2B211E]/60">Minimal 5 peserta rombongan</span>
                    </div>

                    <!-- Jumlah Guru / Pendamping -->
                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                            Guru / Dosen Pendamping <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="guide_count" min="1" max="50" x-model.number="guides" class="w-full bg-[#faf6f0] border border-[#2B211E]/20 px-3.5 py-2 text-xs font-bold text-[#2B211E] focus:outline-none focus:border-[#703A3A]">
                            <span class="absolute right-3 top-2 text-[11px] text-[#2B211E]/60">Orang</span>
                        </div>
                        <span class="text-[10px] text-[#2B211E]/60">Rasio pendamping disarankan 1:15</span>
                    </div>
                </div>

                <!-- Rentang Tanggal -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                            Tanggal Mulai Kunjungan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="planned_date_start" x-model="dateStart" class="w-full bg-[#faf6f0] border border-[#2B211E]/20 px-3.5 py-2 text-xs font-medium text-[#2B211E] focus:outline-none focus:border-[#703A3A]">
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                            Tanggal Selesai Kunjungan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="planned_date_end" x-model="dateEnd" class="w-full bg-[#faf6f0] border border-[#2B211E]/20 px-3.5 py-2 text-xs font-medium text-[#2B211E] focus:outline-none focus:border-[#703A3A]">
                    </div>
                </div>
            </div>

            <!-- Card 3: Catatan Kurikulum & Legalitas Izin -->
            <div class="rgs-card p-6 border-t-4 border-t-[#703A3A] space-y-5">
                <div class="flex items-center gap-2 pb-3 border-b border-[#2B211E]/10">
                    <span class="material-symbols-outlined text-[#703A3A] text-[20px]">assignment</span>
                    <h2 class="font-serif text-lg font-bold text-[#2B211E]">3. Catatan Kebutuhan & Dokumen Perizinan</h2>
                </div>

                <!-- Catatan Khusus Rombongan -->
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]">
                        Tujuan Pembelajaran & Catatan Khusus
                    </label>
                    <textarea name="purpose_notes" rows="3" placeholder="Contoh: Fokus modul P5 Sub-elemen Mengenal Warisan Budaya, membutuhkan area parkir untuk 1 bus pariwisata besar, serta ada 2 siswa dengan alergi seafood..." class="w-full bg-[#faf6f0] border border-[#2B211E]/20 p-3 text-xs text-[#2B211E] focus:outline-none focus:border-[#703A3A]">{{ $reorderData->purpose_notes ?? '' }}</textarea>
                </div>

                <!-- Checkbox Kebutuhan Draf Surat Izin Riset Resmi -->
                <div class="p-3.5 bg-[#51634b]/8 border border-[#51634b]/20 flex items-start gap-3">
                    <input type="checkbox" name="needs_permit_letter" value="1" id="needsPermit" x-model="needsPermit" class="mt-1 accent-[#51634b]">
                    <label for="needsPermit" class="text-xs cursor-pointer">
                        <span class="font-bold text-[#2B211E] block">Terbitkan Draf Surat Izin Kunjungan / Riset Resmi Otomatis</span>
                        <span class="text-[#2B211E]/70 leading-relaxed block mt-0.5">
                            Sistem akan otomatis menghasilkan draf surat perizinan resmi berstempel dan berkop surat institusi untuk diserahkan ke Dinas Pendidikan / Kesbangpol setempat.
                        </span>
                    </label>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Sticky Plinth Summary Card (5 Kolom) -->
        <div class="lg:col-span-5">
            <div class="sticky top-24 rgs-card border border-[#2B211E]/20 shadow-md">
                <!-- Header Plinth -->
                <div class="bg-[#703A3A] text-white p-4">
                    <div class="text-[10px] font-bold uppercase tracking-widest text-[#ffffff]/80">Ringkasan Estimasi Pesanan</div>
                    <div class="font-serif text-lg font-bold" x-text="currentDestination.name"></div>
                    <div class="text-xs text-white/80" x-text="currentDestination.city + ', ' + currentDestination.province"></div>
                </div>

                <!-- Preview Gambar Mini -->
                <div class="aspect-16/9 overflow-hidden bg-gray-100 border-b border-[#2B211E]/10">
                    <img :src="'/' + (currentDestination.cover_image || 'assets/img/hd/dest-kintamani.jpg')" :alt="currentDestination.name" class="w-full h-full object-cover">
                </div>

                <!-- Rincian Biaya Transparan -->
                <div class="p-5 space-y-3.5 text-xs">
                    <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/10">
                        <span class="text-[#2B211E]/70">Tarif Masuk & Modul Tapak</span>
                        <span class="font-bold text-[#2B211E]" x-text="formatRupiah(currentDestination.price_per_pax) + ' / pax'"></span>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/10">
                        <span class="text-[#2B211E]/70">Subtotal Peserta (<span x-text="participants"></span> pax)</span>
                        <span class="font-bold text-[#2B211E]" x-text="formatRupiah(subtotal)"></span>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/10">
                        <div class="flex items-center gap-1">
                            <span class="text-[#2B211E]/70">Asuransi Lapangan Siswa</span>
                            <span class="material-symbols-outlined text-[14px] text-[#51634b]" title="Rp 2.000 / pax untuk jaminan proteksi kecelakaan lapangan">verified_user</span>
                        </div>
                        <span class="font-bold text-[#2B211E]" x-text="formatRupiah(insurance)"></span>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/10">
                        <div class="flex items-center gap-1">
                            <span class="text-[#2B211E]/70">Administrasi & Verifikasi Dokumen</span>
                            <span class="material-symbols-outlined text-[14px] text-[#2B211E]/60" title="Verifikasi dokumen LPJ BOS, e-Pass resmi, dan draf izin dinas">info</span>
                        </div>
                        <span class="font-bold text-[#2B211E]" x-text="formatRupiah(platformFee)"></span>
                    </div>

                    <!-- Grand Total Plinth Box -->
                    <div class="p-3.5 bg-[#faf6f0] border border-[#2B211E]/15 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] uppercase font-bold tracking-wider text-[#2B211E]/60 block">Total Nilai Pesanan</span>
                            <span class="font-serif text-xl font-bold text-[#703A3A]" x-text="formatRupiah(total)"></span>
                        </div>
                        <span class="px-2 py-0.5 bg-[#51634b]/15 text-[#51634b] text-[10px] font-bold uppercase tracking-wider">
                            Legal BOS/LPJ
                        </span>
                    </div>

                    <!-- Tombol Aksi Submit -->
                    <button type="submit" class="w-full rgs-btn-primary py-3 px-4 text-xs font-bold uppercase tracking-widest shadow-sm flex items-center justify-center gap-2">
                        <span>Kirim Pengajuan Booking</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>

                    <p class="text-[11px] text-center text-[#2B211E]/60 leading-tight pt-1">
                        Setelah pengajuan dikirim, Anda dapat langsung memeriksa dokumen draf dan menyelesaikan pembayaran tagihan.
                    </p>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection
