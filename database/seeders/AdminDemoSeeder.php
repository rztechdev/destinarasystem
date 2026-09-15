<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Destination;
use App\Models\DestinationContact;
use App\Models\Institution;
use App\Models\PartnerProfile;
use App\Models\NotificationLog;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Demo Admin Operasional
        $admin = User::updateOrCreate(
            ['email' => 'admin@destinara.id'],
            [
                'name' => 'Rian Pratama, S.Hum.',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0812-8877-6655',
            ]
        );

        // 2. Destinasi Baru Menunggu Verifikasi (Pending Review)
        $dest1 = Destination::updateOrCreate(
            ['slug' => 'candi-cetho-kemuning'],
            [
                'name' => 'Tapak Suci Candi Cetho & Kebun Teh Kemuning',
                'partner_id' => $admin->id,
                'category' => 'situs_budaya',
                'province' => 'Jawa Tengah',
                'city' => 'Karanganyar',
                'description' => 'Situs cagar budaya punden berundak lereng Lawu yang mengajarkan keselarasan mikrokosmos dan makrokosmos. Terintegrasi dengan workshop pemetikan teh organik dan tata ruang lereng vulkanik.',
                'educational_highlights' => 'Eksplorasi arsitektur punden berundak abad ke-15, tata kelola air lereng Lawu, dan workshop pemetikan teh organik bersama komunitas adat.',
                'suitable_for' => ['smp', 'sma', 'universitas'],
                'price_per_pax' => 65000,
                'status' => 'pending_review',
                'cover_image' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80'
                ],
                'facilities' => ['Pondok Diskusi Terbuka', 'Pendopo Pertemuan Adat', 'Toilet Standar Higienis', 'Area Parkir Bus Besar', 'P3K & Jalur Evakuasi'],
                'has_permit_document' => true,
                'created_at' => Carbon::now()->subDays(2),
            ]
        );

        $dest2 = Destination::updateOrCreate(
            ['slug' => 'konservasi-karimunjawa'],
            [
                'name' => 'Stasiun Konservasi Terumbu Karang & Mangrove Karimunjawa',
                'partner_id' => $admin->id,
                'category' => 'konservasi_alam',
                'province' => 'Jawa Tengah',
                'city' => 'Jepara',
                'description' => 'Program riset terapan kelautan untuk siswa dan mahasiswa: transplantasi bibit karang metode biorock, zonasi tangkap lestari adat nelayan, dan pembibitan mangrove pesisir.',
                'educational_highlights' => 'Laboratorium alam restorasi terumbu karang meja dan ekologi lamun bersama Balai Taman Nasional Karimunjawa dan paguyuban nelayan lokal.',
                'suitable_for' => ['sma', 'universitas'],
                'price_per_pax' => 95000,
                'status' => 'pending_review',
                'cover_image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80'
                ],
                'facilities' => ['Peralatan Snorkeling Keselamatan', 'Laboratorium Lapangan Pesisir', 'Life Jacket Standar SOLAS', 'Perahu Edukasi Khusus'],
                'has_permit_document' => true,
                'created_at' => Carbon::now()->subDays(1),
            ]
        );

        // 3. Institusi Pendidikan Menunggu Verifikasi Dokumen
        $instUser = User::updateOrCreate(
            ['email' => 'admin@pradita.sch.id'],
            [
                'name' => 'SMA Pradita Dirgantara',
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'phone' => '0813-1122-3344',
            ]
        );

        Institution::updateOrCreate(
            ['user_id' => $instUser->id],
            [
                'institution_name' => 'SMA Pradita Dirgantara Boyolali',
                'institution_type' => 'sekolah',
                'npsn' => '69978120',
                'province' => 'Jawa Tengah',
                'city' => 'Boyolali',
                'address' => 'Jl. Cendrawasih No. 4, Komplek Bandara Adi Soemarmo',
                'pic_name' => 'Dr. Hendra Gunawan, M.Pd.',
                'pic_phone' => '0813-1122-3344',
                'pic_position' => 'Kepala Pusat Pembelajaran Lapangan',
                'verification_status' => 'pending',
                'official_letterhead' => 'dokumen_legal_npsn_69978120.pdf',
            ]
        );

        // 4. Mitra Pengelola Menunggu Verifikasi
        $partnerUser = User::updateOrCreate(
            ['email' => 'pengelola@kampungnaga.id'],
            [
                'name' => 'Paguyuban Warga Adat Kampung Naga',
                'password' => Hash::make('password'),
                'role' => 'partner',
                'phone' => '0821-4455-6677',
            ]
        );

        PartnerProfile::updateOrCreate(
            ['user_id' => $partnerUser->id],
            [
                'organization_name' => 'Lembaga Kokolot Adat Kampung Naga',
                'organization_type' => 'yayasan_adat',
                'legal_document_number' => 'SK-ADAT/NAGA/2024/09',
                'bank_name' => 'Bank BJB',
                'bank_account_number' => '0019283746101',
                'bank_account_holder' => 'Lembaga Kokolot Adat Kampung Naga',
                'verification_status' => 'pending',
            ]
        );

        // 5. Log Notifikasi Sistem (Queue & Dispatch)
        NotificationLog::truncate();
        $notifs = [
            [
                'recipient_type' => 'buyer',
                'recipient_name' => 'SMA Negeri 1 Candirejo',
                'channel' => 'whatsapp',
                'target' => '0812-3456-7890',
                'event_type' => 'payment_reminder',
                'title' => 'Pengingat Batas Pembayaran VA - DST-2026-0814-KTM',
                'preview_text' => 'Halo SMA Negeri 1 Candirejo, batas akhir pelunasan booking Kintamani berakhir dalam 12 jam. Bayar via VA BCA 8274108123456789.',
                'status' => 'sent',
                'retry_count' => 0,
                'sent_at' => Carbon::now()->subMinutes(15),
            ],
            [
                'recipient_type' => 'partner',
                'recipient_name' => 'Yayasan Desa Adat Penglipuran',
                'channel' => 'whatsapp',
                'target' => '0819-8765-4321',
                'event_type' => 'booking_new',
                'title' => 'Reservasi Rombongan Baru Masuk: UNY (40 Mahasiswa)',
                'preview_text' => 'Pemberitahuan: Rombongan Universitas Negeri Yogyakarta mengajukan kunjungan pada 20 September 2026. Segera respon dalam 24 jam.',
                'status' => 'sent',
                'retry_count' => 0,
                'sent_at' => Carbon::now()->subMinutes(45),
            ],
            [
                'recipient_type' => 'buyer',
                'recipient_name' => 'Universitas Negeri Yogyakarta',
                'channel' => 'email',
                'target' => 'studi.uny@uny.ac.id',
                'event_type' => 'booking_created',
                'title' => 'Bukti Pengajuan Booking DST-2026-0920-UNY Telah Diterima',
                'preview_text' => 'Draf permohonan ekskursi Anda sedang ditelaah oleh Pengelola Desa Adat Penglipuran. Estimasi respon maks. 1x24 jam kerja.',
                'status' => 'sent',
                'retry_count' => 0,
                'sent_at' => Carbon::now()->subHours(1),
            ],
            [
                'recipient_type' => 'partner',
                'recipient_name' => 'Pengelola Desa Wisata Sade',
                'channel' => 'whatsapp',
                'target' => '0878-1122-3344',
                'event_type' => 'payout_processed',
                'title' => 'Pencairan Dana Ekskursi Rp 1.575.000 Berhasil Ditransfer',
                'preview_text' => 'Dana pelunasan ekskursi rombongan telah dikirimkan ke rek. Bank Mandiri a/n Kelompok Sadar Wisata Sade. Ref: PAYOUT-2026-0520-SAD.',
                'status' => 'sent',
                'retry_count' => 0,
                'sent_at' => Carbon::now()->subHours(3),
            ],
            [
                'recipient_type' => 'buyer',
                'recipient_name' => 'SMA Pradita Dirgantara',
                'channel' => 'email',
                'target' => 'admin@pradita.sch.id',
                'event_type' => 'verification_reminder',
                'title' => 'Kelengkapan Dokumen NPSN Sekolah Sedang Ditelaah',
                'preview_text' => 'Tim Kurator Destinara sedang memvalidasi SK Operasional dan legalitas BOS sekolah Anda. Waktu proses normal 1 hari kerja.',
                'status' => 'queued',
                'retry_count' => 0,
                'sent_at' => null,
            ],
            [
                'recipient_type' => 'partner',
                'recipient_name' => 'Komunitas Adat Cetho',
                'channel' => 'whatsapp',
                'target' => '0852-9900-1122',
                'event_type' => 'curation_update',
                'title' => 'Dossier Tapak Candi Cetho Memasuki Tahap Telaah Kurasi',
                'preview_text' => 'Kurator Destinara sedang memeriksa kelayakan modul P5 dan daya dukung tapak yang diajukan.',
                'status' => 'queued',
                'retry_count' => 0,
                'sent_at' => null,
            ],
            [
                'recipient_type' => 'buyer',
                'recipient_name' => 'SMP Labschool UPI Bandung',
                'channel' => 'whatsapp',
                'target' => '0812-9988-7700',
                'event_type' => 'payment_reminder',
                'title' => 'Tagihan Invoice BOS - Rombongan Ekspedisi Geologi Merapi',
                'preview_text' => 'Pengingat faktur BOS no. INV-2026-0881. Mohon unggah bukti SP2D jika menggunakan mekanisme transfer pemda.',
                'status' => 'failed',
                'retry_count' => 2,
                'sent_at' => Carbon::now()->subHours(5),
            ],
            [
                'recipient_type' => 'buyer',
                'recipient_name' => 'SMA Negeri 1 Candirejo',
                'channel' => 'whatsapp',
                'target' => '0812-3456-7890',
                'event_type' => 'epass_issued',
                'title' => 'e-Pass Rombongan Wonosadi Resmi Diterbitkan',
                'preview_text' => 'Dokumen e-Pass dan Surat Izin Ekskursi No. DST/EPASS/2026/0702 siap diunduh di dashboard buyer Anda.',
                'status' => 'sent',
                'retry_count' => 0,
                'sent_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($notifs as $n) {
            NotificationLog::create($n);
        }

        // 6. Audit Trail Aktivitas Admin Operasional
        AuditLog::truncate();
        $audits = [
            [
                'user_id' => $admin->id,
                'action' => 'verify_partner',
                'entity_type' => 'PartnerProfile',
                'entity_id' => 1,
                'description' => 'Memverifikasi legalitas Desa Adat Penglipuran (SK Bupati Bangli No. 430/2012) dan rekening Bank BPD Bali.',
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::now()->subHours(6),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'publish_destination',
                'entity_type' => 'Destination',
                'entity_id' => 1,
                'description' => 'Menyetujui kurasi & mempublikasikan tapak Desa Adat Penglipuran ke direktori publik.',
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'verify_institution',
                'entity_type' => 'Institution',
                'entity_id' => 1,
                'description' => 'Memvalidasi data NPSN 20400012 SMAN 1 Candirejo terdaftar di Kemendikbudristek.',
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::now()->subHours(4),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'reissue_document',
                'entity_type' => 'Document',
                'entity_id' => 2,
                'description' => 'Menerbitkan ulang salinan resmi e-Pass untuk booking DST-2026-0702-WNS.',
                'ip_address' => '127.0.0.1',
                'created_at' => Carbon::now()->subHours(2),
            ],
        ];

        foreach ($audits as $a) {
            AuditLog::create($a);
        }
    }
}
