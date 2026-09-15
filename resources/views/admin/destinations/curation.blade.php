@extends('layouts.admin')

@section('title', 'Editor Kurasi & Tata Kelola Dossier Tapak')

@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#2B211E]/12 pb-6">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-[#703A3A] mb-1">
                <span>Standarisasi Konten Editorial</span>
                <span>•</span>
                <span>Pendidikan Berbasis Tapak</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#2B211E]">
                Editor Kurasi & Manajemen Dossier Tapak
            </h1>
            <p class="text-sm text-[#2B211E]/70 max-w-2xl">
                Lakukan penyelarasan redaksional modul pembelajaran P5, penetapan batas carrying capacity, dan parameter tarif sebelum tapak dipasarkan ke institusi pendidikan.
            </p>
        </div>

        <!-- Selector Tapak Lainnya -->
        <div class="flex items-center gap-2">
            <form method="GET" action="{{ route('admin.destinations.curation') }}" class="flex items-center gap-2">
                <label class="text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Pilih Tapak:</label>
                <select name="id" onchange="window.location.href='/admin/kurasi/' + this.value" class="p-2 border border-[#2B211E]/20 text-xs font-semibold bg-white focus:ring-1 focus:ring-[#703A3A] outline-none">
                    @foreach($allDestinations as $item)
                    <option value="{{ $item->id }}" {{ $destination && $destination->id === $item->id ? 'selected' : '' }}>
                        {{ $item->name }} ({{ strtoupper($item->status) }})
                    </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    @if($destination)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Form Kurasi Lengkap -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.destinations.updateCuration', $destination->id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Section 1: Identitas & Status Publikasi -->
                <div class="rgs-card p-6 bg-white space-y-4">
                    <div class="flex items-center justify-between border-b border-[#2B211E]/10 pb-3">
                        <h3 class="font-serif text-base font-bold text-[#2B211E]">1. Identitas & Status Publikasi</h3>
                        <span class="text-xs font-mono text-[#2B211E]/60 uppercase">Slug: {{ $destination->slug }}</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1 sm:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Nama Resmi Tapak Edukasi</label>
                            <input type="text" name="name" value="{{ old('name', $destination->name) }}" required class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-medium focus:ring-1 focus:ring-[#703A3A] outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Kategori Tapak</label>
                            <select name="category" class="w-full p-2.5 border border-[#2B211E]/20 text-xs bg-white focus:ring-1 focus:ring-[#703A3A] outline-none">
                                <option value="desa_wisata" {{ $destination->category === 'desa_wisata' ? 'selected' : '' }}>Desa Wisata & Adat</option>
                                <option value="situs_budaya" {{ $destination->category === 'situs_budaya' ? 'selected' : '' }}>Situs Budaya & Cagar Sejarah</option>
                                <option value="konservasi_alam" {{ $destination->category === 'konservasi_alam' ? 'selected' : '' }}>Konservasi Alam & Hayati</option>
                                <option value="taman_nasional" {{ $destination->category === 'taman_nasional' ? 'selected' : '' }}>Taman Nasional & Geopark</option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Status Kurasi</label>
                            <select name="status" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-bold font-mono focus:ring-1 focus:ring-[#703A3A] outline-none {{ $destination->status === 'published' ? 'bg-emerald-50 text-emerald-900' : 'bg-amber-50 text-amber-900' }}">
                                <option value="published" {{ $destination->status === 'published' ? 'selected' : '' }}>PUBLISHED (Aktif Katalog)</option>
                                <option value="pending_review" {{ $destination->status === 'pending_review' ? 'selected' : '' }}>PENDING REVIEW (Menunggu Telaah)</option>
                                <option value="draft" {{ $destination->status === 'draft' ? 'selected' : '' }}>DRAFT (Perlu Revisi)</option>
                                <option value="archived" {{ $destination->status === 'archived' ? 'selected' : '' }}>ARCHIVED (Diarsipkan)</option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Provinsi</label>
                            <input type="text" name="province" value="{{ old('province', $destination->province) }}" required class="w-full p-2.5 border border-[#2B211E]/20 text-xs focus:ring-1 focus:ring-[#703A3A] outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Kabupaten / Kota</label>
                            <input type="text" name="city" value="{{ old('city', $destination->city) }}" required class="w-full p-2.5 border border-[#2B211E]/20 text-xs focus:ring-1 focus:ring-[#703A3A] outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Relevansi Kurikulum & Narasi Editorial -->
                <div class="rgs-card p-6 bg-white space-y-4">
                    <div class="border-b border-[#2B211E]/10 pb-3">
                        <h3 class="font-serif text-base font-bold text-[#2B211E]">2. Relevansi Kurikulum & Narasi Editorial</h3>
                        <p class="text-xs text-[#2B211E]/60">Penyelarasan tema profil pelajar pancasila dan materi edukatif</p>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#703A3A]">
                                Educational Highlights (Fokus Pembelajaran P5 / Kurikulum Merdeka)
                            </label>
                            <textarea name="educational_highlights" rows="3" class="w-full p-3 border border-[#2B211E]/20 text-xs focus:ring-1 focus:ring-[#703A3A] outline-none leading-relaxed">{{ old('educational_highlights', $destination->educational_highlights) }}</textarea>
                            <p class="text-[10px] text-[#2B211E]/60">Jelaskan relevansi spesifik dengan dimensi profil pelajar atau capaian mata kuliah.</p>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Deskripsi Dossier Lengkap</label>
                            <textarea name="description" rows="5" required class="w-full p-3 border border-[#2B211E]/20 text-xs focus:ring-1 focus:ring-[#703A3A] outline-none leading-relaxed">{{ old('description', $destination->description) }}</textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Tingkat Pendidikan yang Sesuai</label>
                            <div class="flex flex-wrap gap-4 text-xs">
                                @php
                                    $suitable = is_array($destination->suitable_for) ? $destination->suitable_for : [];
                                @endphp
                                <label class="flex items-center gap-1.5">
                                    <input type="checkbox" name="suitable_for[]" value="sd" {{ in_array('sd', $suitable) ? 'checked' : '' }} class="rounded-none text-[#703A3A]">
                                    <span>SD / Madrasah Ibtidaiyah</span>
                                </label>
                                <label class="flex items-center gap-1.5">
                                    <input type="checkbox" name="suitable_for[]" value="smp" {{ in_array('smp', $suitable) ? 'checked' : '' }} class="rounded-none text-[#703A3A]">
                                    <span>SMP / MTs</span>
                                </label>
                                <label class="flex items-center gap-1.5">
                                    <input type="checkbox" name="suitable_for[]" value="sma" {{ in_array('sma', $suitable) ? 'checked' : '' }} class="rounded-none text-[#703A3A]">
                                    <span>SMA / SMK / MA</span>
                                </label>
                                <label class="flex items-center gap-1.5">
                                    <input type="checkbox" name="suitable_for[]" value="universitas" {{ in_array('universitas', $suitable) ? 'checked' : '' }} class="rounded-none text-[#703A3A]">
                                    <span>Perguruan Tinggi / Peneliti</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Parameter Finansial & Daya Dukung -->
                <div class="rgs-card p-6 bg-white space-y-4">
                    <div class="border-b border-[#2B211E]/10 pb-3">
                        <h3 class="font-serif text-base font-bold text-[#2B211E]">3. Parameter Finansial & Daya Dukung Lingkungan</h3>
                        <p class="text-xs text-[#2B211E]/60">Struktur harga paket dan batas maksimum kunjungan harian rombongan</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Tarif Resmi Edukasi (Per Pax / Siswa)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-xs text-[#2B211E]/60 font-mono">Rp</span>
                                <input type="number" name="price_per_pax" value="{{ old('price_per_pax', $destination->price_per_pax) }}" required class="w-full pl-9 pr-3 py-2.5 border border-[#2B211E]/20 text-xs font-mono font-bold focus:ring-1 focus:ring-[#703A3A] outline-none">
                            </div>
                            <p class="text-[10px] text-[#2B211E]/60">Komisi platform 10% dipotong otomatis saat payout mitra (PRD Sec. 7.9).</p>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#2B211E]/70">Kapasitas Maksimum Kunjungan Harian</label>
                            <div class="relative">
                                <input type="number" name="max_daily_capacity" value="{{ old('max_daily_capacity', $destination->max_daily_capacity ?? 150) }}" class="w-full p-2.5 border border-[#2B211E]/20 text-xs font-mono font-bold focus:ring-1 focus:ring-[#703A3A] outline-none">
                                <span class="absolute right-3 top-2.5 text-xs text-[#2B211E]/60">Siswa/Hari</span>
                            </div>
                            <p class="text-[10px] text-[#2B211E]/60">Batas toleransi kelestarian lingkungan & daya tampung adat.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.destinations.verify') }}" class="rgs-btn-outline px-5 py-2.5 text-xs font-semibold uppercase bg-white">
                        Batal
                    </a>
                    <button type="submit" class="rgs-btn-primary px-6 py-2.5 text-xs font-semibold uppercase tracking-wider flex items-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan Pembaruan Kurasi</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right 1 Col: Pratinjau Tampilan Publik & Checklist Kurator -->
        <div class="space-y-6">
            
            <!-- Live Preview Card -->
            <div class="rgs-card bg-white overflow-hidden">
                <div class="bg-[#faf6f0] p-4 border-b border-[#2B211E]/10">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#703A3A]">Tampilan Kartu Direktori:</span>
                </div>
                <div class="h-44 bg-gray-200 overflow-hidden relative">
                    <img src="{{ $destination->cover_image }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2 px-2 py-0.5 bg-[#703A3A] text-white text-[10px] font-mono">
                        Rp {{ number_format($destination->price_per_pax, 0, ',', '.') }}/pax
                    </div>
                </div>
                <div class="p-5 space-y-2">
                    <span class="text-[11px] font-mono text-[#2B211E]/60 uppercase">{{ $destination->city }}, {{ $destination->province }}</span>
                    <h4 class="font-serif text-lg font-bold text-[#2B211E]">{{ $destination->name }}</h4>
                    <p class="text-xs text-[#2B211E]/75 line-clamp-3 leading-relaxed">
                        {{ $destination->description }}
                    </p>
                    <div class="pt-3 border-t border-[#2B211E]/10 flex items-center justify-between text-xs">
                        <span class="text-emerald-800 font-semibold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">verified</span>
                            <span>Kurasi Terverifikasi</span>
                        </span>
                        <a href="{{ route('destinasi.show', $destination->slug) }}" target="_blank" class="text-[#703A3A] font-semibold hover:underline">
                            Buka Detail &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Standar Kepatuhan Kurasi Destinara -->
            <div class="rgs-card bg-[#faf6f0] p-5 border-l-4 border-l-[#2B3A4A] space-y-3">
                <h4 class="font-serif text-sm font-bold text-[#2B211E]">Protokol Kurasi Lapangan</h4>
                <div class="space-y-2 text-xs text-[#2B211E]/80">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-emerald-800 text-[16px] shrink-0 mt-0.5">check_circle</span>
                        <span>Seluruh modul edukatif harus menghormati hak ulayat dan kearifan masyarakat adat setempat.</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-emerald-800 text-[16px] shrink-0 mt-0.5">check_circle</span>
                        <span>Kapasitas harian tidak boleh melebihi hasil kajian daya dukung lingkungan tapak.</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-emerald-800 text-[16px] shrink-0 mt-0.5">check_circle</span>
                        <span>Fasilitas sanitasi dan jalur evakuasi wajib memenuhi standar rombongan bus besar.</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endif

</div>
@endsection
