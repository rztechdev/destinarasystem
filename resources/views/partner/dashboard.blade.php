@extends('layouts.partner')

@section('title', 'Dashboard Mitra Pengelola')

@section('content')
<div class="space-y-8">

    <!-- Header Sambutan & Quick Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#2B211E]/12">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#703A3A] mb-1">
                <span class="material-symbols-outlined text-[16px]">holiday_village</span>
                <span>{{ $profile->organization_name ?? 'Desa Wisata Adat Penglipuran' }}</span>
                <span class="px-1.5 py-0.5 bg-[#51634b]/10 text-[#51634b] text-[10px] font-bold">Terverifikasi</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">Panel Pengelola Tapak Adat & Konservasi</h1>
            <p class="text-xs sm:text-sm text-[#2B211E]/70 mt-1">
                Pantau kedatangan rombongan delegasi belajar, kontrol kalender slot harian, dan pantau pencairan dana komunal adat.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('mitra.availability') }}" class="rgs-btn-outline px-4 py-2.5 text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                <span>Atur Kalender Slot</span>
            </a>
            <a href="{{ route('mitra.destinations.create') }}" class="rgs-btn-primary px-4 py-2.5 text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                <span>Ajukan Tapak Baru</span>
            </a>
        </div>
    </div>

    <!-- 4 Plinth Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Metric 1: Booking Baru -->
        <div class="rgs-card p-5 border-t-4 border-t-[#b87a38]">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Booking Perlu Respon</span>
                <span class="material-symbols-outlined text-[#b87a38] text-[20px]">notifications_active</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#b87a38]">{{ $pendingBookingsCount }}</div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">Menunggu persetujuan adat</div>
        </div>

        <!-- Metric 2: Rombongan Terkonfirmasi -->
        <div class="rgs-card p-5 border-t-4 border-t-[#51634b]">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Rombongan Terjadwal</span>
                <span class="material-symbols-outlined text-[#51634b] text-[20px]">groups</span>
            </div>
            <div class="font-serif text-3xl font-bold text-[#51634b]">{{ $confirmedBookingsCount }}</div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">Siap berkunjung ke tapak</div>
        </div>

        <!-- Metric 3: Saldo Siap Tarik -->
        <div class="rgs-card p-5 border-t-4 border-t-[#703A3A]">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Saldo Siap Tarik</span>
                <span class="material-symbols-outlined text-[#703A3A] text-[20px]">account_balance_wallet</span>
            </div>
            <div class="font-serif text-2xl sm:text-3xl font-bold text-[#703A3A]">
                Rp {{ number_format($readyBalance, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[#51634b] font-semibold mt-1">Dapat dicairkan ke BPD Bali</div>
        </div>

        <!-- Metric 4: Total Payout Diterima -->
        <div class="rgs-card p-5 border-t-4 border-t-[#2B211E]/30">
            <div class="flex items-center justify-between text-[#2B211E]/60 text-xs font-medium mb-2">
                <span>Total Dana Diterima</span>
                <span class="material-symbols-outlined text-[#2B211E]/60 text-[20px]">savings</span>
            </div>
            <div class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Rp {{ number_format($totalPaidOut, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-[#2B211E]/60 mt-1">Rekonsiliasi bersih komunal</div>
        </div>
    </div>

    <!-- Booking Perlu Respon Cepat (Urgent Bookings Callout) -->
    <div class="rgs-card p-6 border-t-4 border-t-[#b87a38] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[#2B211E]/10">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[#b87a38] text-[22px]">error</span>
                <h2 class="font-serif text-lg font-bold text-[#2B211E]">Permohonan Rombongan Masuk (Perlu Tindakan)</h2>
            </div>
            <span class="text-xs font-bold text-[#b87a38] uppercase tracking-wider">Maks. Konfirmasi 1x24 Jam</span>
        </div>

        <div class="space-y-3">
            @forelse($urgentBookings as $booking)
            <div class="p-4 bg-[#faf6f0] border border-[#2B211E]/15 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="space-y-1.5 flex-1">
                    <div class="flex flex-wrap items-center gap-2 text-xs">
                        <span class="font-mono font-bold text-[#703A3A]">{{ $booking->booking_code }}</span>
                        <span class="text-[#2B211E]/40">•</span>
                        <span class="font-bold text-[#2B211E]">{{ $booking->institution->institution_name }}</span>
                        <span class="px-2 py-0.5 bg-[#703A3A]/10 text-[#703A3A] text-[10px] font-bold uppercase">
                            {{ $booking->inquiry_type === 'study_tour' ? 'Study Tour P5' : 'Penelitian Lapangan' }}
                        </span>
                    </div>

                    <div class="text-xs text-[#2B211E]/75 flex flex-wrap items-center gap-3">
                        <span><strong>{{ $booking->participant_count }} Siswa / Peserta</strong> ({{ $booking->guide_count }} Pendamping)</span>
                        <span>•</span>
                        <span>Tanggal: <strong>{{ \Carbon\Carbon::parse($booking->planned_date_start)->translatedFormat('d M Y') }} s/d {{ \Carbon\Carbon::parse($booking->planned_date_end)->translatedFormat('d M Y') }}</strong></span>
                        <span>•</span>
                        <span>Estimasi Payout: <strong class="text-[#51634b]">Rp {{ number_format($booking->subtotal_amount * 0.9, 0, ',', '.') }}</strong></span>
                    </div>

                    @if($booking->purpose_notes)
                    <div class="text-[11px] text-[#2B211E]/70 italic pt-1">
                        "{{ $booking->purpose_notes }}"
                    </div>
                    @endif
                </div>

                <!-- Tombol Konfirmasi Langsung -->
                <div class="flex items-center gap-2 shrink-0">
                    <form action="{{ route('mitra.booking.confirm', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-[#51634b] text-white hover:bg-[#3f4f3a] text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors shadow-xs">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            <span>Konfirmasi Terima</span>
                        </button>
                    </form>

                    <button type="button" onclick="const r = prompt('Alasan penolakan / pengalihan jadwal:'); if(r){ document.getElementById('reject-form-{{ $booking->id }}').reason.value = r; document.getElementById('reject-form-{{ $booking->id }}').submit(); }" class="px-3.5 py-2 border border-red-300 text-red-700 bg-white hover:bg-red-50 text-xs font-bold uppercase tracking-wider transition-colors">
                        Tolak
                    </button>
                    <form id="reject-form-{{ $booking->id }}" action="{{ route('mitra.booking.reject', $booking->id) }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="reason" value="">
                    </form>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-xs text-[#2B211E]/60 bg-white border border-[#2B211E]/10">
                Tidak ada permohonan rombongan baru yang menunggu respon saat ini. Seluruh jadwal telah terkoordinasi.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 2 Kolom: Okupansi Kuota Pekan Ini & Tapak Kelolaan -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Kolom Kiri: Kalender Slot Okupansi Pekan Ini (7 Kolom) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/12">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#703A3A] text-[20px]">date_range</span>
                    <span class="font-serif text-lg font-bold text-[#2B211E]">Ketersediaan Slot 7 Hari Ke Depan</span>
                </div>
                <a href="{{ route('mitra.availability') }}" class="text-xs font-semibold text-[#703A3A] hover:underline flex items-center gap-0.5">
                    <span>Kelola Kalender Penuh</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach($upcomingSlots as $slot)
                <div class="rgs-card p-3.5 border-t-2 {{ $slot->status === 'open' ? 'border-t-[#51634b]' : ($slot->status === 'full' ? 'border-t-red-500' : 'border-t-gray-400') }} text-xs space-y-1.5">
                    <div class="font-bold text-[#2B211E]">
                        {{ \Carbon\Carbon::parse($slot->date)->translatedFormat('D, d M') }}
                    </div>
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-[#2B211E]/60">Terisi:</span>
                        <span class="font-bold font-mono">{{ $slot->booked_count }} / {{ $slot->capacity }}</span>
                    </div>
                    <div class="pt-1">
                        @if($slot->status === 'open')
                            <span class="px-2 py-0.5 bg-[#51634b]/15 text-[#51634b] text-[10px] font-bold uppercase tracking-wider block text-center">
                                Kuota Buka
                            </span>
                        @elseif($slot->status === 'full')
                            <span class="px-2 py-0.5 bg-red-100 text-red-700 text-[10px] font-bold uppercase tracking-wider block text-center">
                                Penuh
                            </span>
                        @else
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider block text-center">
                                Tutup Adat
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Kolom Kanan: Tapak Pembelajaran Aktif (5 Kolom) -->
        <div class="lg:col-span-5 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-[#2B211E]/12">
                <span class="font-serif text-lg font-bold text-[#2B211E]">Tapak Kelolaan</span>
                <a href="{{ route('mitra.destinations') }}" class="text-xs font-semibold text-[#51634b] hover:underline flex items-center gap-0.5">
                    <span>Lihat Semua</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            @if($primaryDest)
            <div class="rgs-card overflow-hidden border border-[#2B211E]/15">
                <div class="aspect-16/9 bg-gray-100 overflow-hidden relative">
                    <img src="{{ asset($primaryDest->cover_image) }}" alt="{{ $primaryDest->name }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 left-2 px-2 py-0.5 bg-[#2B211E]/80 text-white text-[10px] font-bold uppercase">
                        {{ strtoupper(str_replace('_', ' ', $primaryDest->category)) }}
                    </div>
                </div>
                <div class="p-4 space-y-2 text-xs">
                    <h3 class="font-serif text-base font-bold text-[#2B211E]">{{ $primaryDest->name }}</h3>
                    <p class="text-[11px] text-[#2B211E]/70 line-clamp-2">
                        {{ $primaryDest->description }}
                    </p>
                    <div class="flex items-center justify-between pt-2 border-t border-[#2B211E]/10">
                        <span class="text-[11px] text-[#2B211E]/60">Tarif: <strong>Rp {{ number_format($primaryDest->price_per_pax, 0, ',', '.') }} / pax</strong></span>
                        <span class="px-2 py-0.5 bg-[#51634b]/15 text-[#51634b] text-[10px] font-bold uppercase">
                            Tayang & Aktif
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>

</div>
@endsection
