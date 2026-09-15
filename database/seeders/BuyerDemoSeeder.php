<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Institution;
use App\Models\Destination;
use App\Models\DestinationContact;
use App\Models\AvailabilitySlot;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Document;
use Carbon\Carbon;

class BuyerDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Buyer Utama (Institusi Sekolah)
        $buyer = User::updateOrCreate(
            ['email' => 'guru@sman1candirejo.sch.id'],
            [
                'name' => 'Drs. Bambang Hidayat, M.Pd.',
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'phone' => '081234567890',
                'status' => 'active',
            ]
        );

        // Institusi Buyer
        $institution = Institution::updateOrCreate(
            ['user_id' => $buyer->id],
            [
                'institution_name' => 'SMA Negeri 1 Candirejo',
                'institution_type' => 'sekolah',
                'npsn' => '20104567',
                'address' => 'Jl. Raya Candirejo No. 14, Borobudur',
                'city' => 'Magelang',
                'province' => 'Jawa Tengah',
                'pic_name' => 'Drs. Bambang Hidayat, M.Pd.',
                'pic_position' => 'Wakil Kepala Sekolah Bidang Kesiswaan & Kurikulum',
                'pic_phone' => '081234567890',
                'pic_email' => 'guru@sman1candirejo.sch.id',
                'official_letterhead' => 'assets/docs/kop-sman1candirejo.png',
                'verification_status' => 'verified',
            ]
        );

        // 2. Akun Demo Mitra (Pengelola Tapak)
        $partner = User::updateOrCreate(
            ['email' => 'mitra@penglipuran.id'],
            [
                'name' => 'I Wayan Sudarma, S.Pd.H.',
                'password' => Hash::make('password'),
                'role' => 'partner',
                'phone' => '087812349900',
                'status' => 'active',
            ]
        );

        // 3. Destinasi Pembelajaran Unggulan (6 Tapak Nyata)
        $destinationsData = [
            [
                'name' => 'Desa Wisata Adat Penglipuran & Kintamani',
                'slug' => 'kampung-kopi-kintamani',
                'category' => 'desa_wisata',
                'province' => 'Bali',
                'city' => 'Bangli',
                'price_per_pax' => 45000,
                'description' => 'Laboratorium hidup tata kelola ruang adat Tri Hita Karana, agroklimatologi kopi arabika vulkanik, dan konservasi hutan bambu seluas 75 hektar berbasis kearifan hukum adat Awig-Awig.',
                'educational_highlights' => 'Arsitektur vernakular bambu tahan gempa, zonasi ruang Tri Mandala, serta model ekonomi sirkular koperasi kebun rakyat Kintamani.',
                'facilities' => ['Bale Banjar Pertemuan Rombongan (Kapasitas 120)', 'Laboratorium Kebun Kopi & Pengolahan Basah', 'Toilet Sanitasi Standar Wisata (8 Titik)', 'Area Parkir Bus Besar & Truk Riset', 'Akses WiFi Desa Adat & Listrik Stabil'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/dest-kintamani.jpg',
                'gallery_images' => [
                    'assets/img/hd/dest-kintamani.jpg',
                    'assets/img/hd/dest-wonosadi.jpg',
                    'assets/img/hd/peneliti-ciptagelar.jpg',
                    'assets/img/hd/story-ulin.jpg',
                    'assets/img/hd/dest-sasak-sade.jpg',
                ],
                'contact' => [
                    'name' => 'I Wayan Sudarma, S.Pd.H.',
                    'role' => 'Kelian Adat & Koordinator Kunjungan Akademik',
                    'phone' => '0878-1234-9900',
                    'email' => 'sekretariat@penglipuran.or.id',
                ],
            ],
            [
                'name' => 'Hutan Adat Wonosadi & Konservasi Sumber Air',
                'slug' => 'hutan-adat-wonosadi',
                'category' => 'konservasi_alam',
                'province' => 'D.I. Yogyakarta',
                'city' => 'Gunungkidul',
                'price_per_pax' => 35000,
                'description' => 'Hutan larangan adat di perbukitan karst purba Gunungkidul dengan 48 mata air abadi dan pohon preh raksasa ratusan tahun yang dijaga secara turun-temurun.',
                'educational_highlights' => 'Hidrologi karst, taksonomi vegetasi endemik, dan antropologi perlindungan sumber air komunal.',
                'facilities' => ['Pendopo Belajar Terbuka Kapasitas 80 Orang', 'Jalur Tracking Edukasi Karst Terbimbing', 'Musholla &MCK Air Bersih Mata Air', 'Area Camping Riset Biologi Lapangan'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/dest-wonosadi.jpg',
                'gallery_images' => [
                    'assets/img/hd/dest-wonosadi.jpg',
                    'assets/img/hd/story-ulin.jpg',
                    'assets/img/hd/peneliti-ciptagelar.jpg',
                    'assets/img/hd/dest-kintamani.jpg',
                ],
                'contact' => [
                    'name' => 'Ki Sumodiharjo',
                    'role' => 'Sesepuh Lembaga Konservasi Jagawana Wonosadi',
                    'phone' => '0813-9876-1122',
                    'email' => 'wonosadi.karst@gmail.com',
                ],
            ],
            [
                'name' => 'Kampung Adat Sasak Sade',
                'slug' => 'desa-sasak-sade',
                'category' => 'situs_budaya',
                'province' => 'Nusa Tenggara Barat',
                'city' => 'Lombok Tengah',
                'price_per_pax' => 40000,
                'description' => 'Permukiman tradisional suku Sasak yang mempertahankan arsitektur bale tani lantai kotoran kerbau alami, tradisi menenun songket serat alam, dan sistem kekerabatan komunal.',
                'educational_highlights' => 'Teknologi material vernakular tahan gempa, etnografi pola tenun songket suku Sasak, dan pelestarian adat perkawinan merarik.',
                'facilities' => ['Sanggar Belajar Tenun & Seni Tradisi', 'Pusat Dokumentasi Adat Sade', 'Area Parkir Bus Pariwisata Edukasi', 'Pemandu Lokal Berlisensi Adat'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/dest-sasak-sade.jpg',
                'gallery_images' => [
                    'assets/img/hd/dest-sasak-sade.jpg',
                    'assets/img/hd/story-sikka.jpg',
                    'assets/img/hd/dest-kintamani.jpg',
                ],
                'contact' => [
                    'name' => 'Lalu Amran Syarif',
                    'role' => 'Ketua Pengelola Edukasi Adat Sade',
                    'phone' => '0852-3344-5566',
                    'email' => 'info@sasaksade.id',
                ],
            ],
            [
                'name' => 'Desa Wisata Adat Wae Rebo',
                'slug' => 'desa-adat-wae-rebo',
                'category' => 'desa_wisata',
                'province' => 'Nusa Tenggara Timur',
                'city' => 'Manggarai',
                'price_per_pax' => 150000,
                'description' => 'Kampung tradisional Manggarai di ketinggian 1.200 mdpl dengan 7 rumah kerucut Mbaru Niang berlantai lima yang meraih UNESCO Asia-Pacific Awards for Cultural Heritage Conservation.',
                'educational_highlights' => 'Struktur geometri fraktal Mbaru Niang, pertanian kopi organik pegunungan, dan upacara adat penerimaan tamu Pa’u Wae Lu’u.',
                'facilities' => ['Mbaru Niang Tamu Rombongan (Inap Adat)', 'Dapur Bersama Kuliner Organik Lokal', 'Pemandu Jalur Pendakian Jalur Hutan Lindung Todoloko'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/dest-waerebo.jpg',
                'gallery_images' => [
                    'assets/img/hd/dest-waerebo.jpg',
                    'assets/img/hd/story-ulin.jpg',
                    'assets/img/hd/peneliti-ciptagelar.jpg',
                ],
                'contact' => [
                    'name' => 'Fransiskus Asisi',
                    'role' => 'Lembaga Pengelola Adat Wae Rebo',
                    'phone' => '0821-4455-6677',
                    'email' => 'waerebo.official@gmail.com',
                ],
            ],
            [
                'name' => 'Hutan Lindung Sungai Wain',
                'slug' => 'hutan-lindung-sungai-wain',
                'category' => 'konservasi_alam',
                'province' => 'Kalimantan Timur',
                'city' => 'Balikpapan',
                'price_per_pax' => 60000,
                'description' => 'Kawasan hutan hujan tropis primer seluas 10.025 hektar yang menjadi habitat alami orangutan reintroduksi, beruang madu, dan pohon ulin purba.',
                'educational_highlights' => 'Ekologi kanopi hutan hujan dipterokarpa, program konservasi primata, dan pengamatan Daerah Aliran Sungai (DAS) alami.',
                'facilities' => ['Stasiun Riset Lapangan & Herbarium Mini', 'Canopy Bridge & Jalur Boardwalk Rawa Air Tawar', 'Asrama Mahasiswa & Peneliti Lapangan (40 Bed)'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/story-ulin.jpg',
                'gallery_images' => [
                    'assets/img/hd/story-ulin.jpg',
                    'assets/img/hd/dest-wonosadi.jpg',
                ],
                'contact' => [
                    'name' => 'Ir. Agus Santoso, M.Sc.',
                    'role' => 'Kepala Balai Pengelola Hutan Lindung Sungai Wain',
                    'phone' => '0811-540-1234',
                    'email' => 'riset@sungaiwain.org',
                ],
            ],
            [
                'name' => 'Kawasan Konservasi Laut Wakatobi',
                'slug' => 'taman-nasional-wakatobi',
                'category' => 'konservasi_alam',
                'province' => 'Sulawesi Tenggara',
                'city' => 'Wakatobi',
                'price_per_pax' => 85000,
                'description' => 'Cagar Biosfer Dunia UNESCO dengan 750 dari total 850 spesies karang dunia, serta komunitas suku Bajo yang mempraktikkan kearifan pelaut tradisional.',
                'educational_highlights' => 'Oseanografi terumbu karang, konservasi padang lamun (seagrass), dan kearifan ekologi maritim Bajo.',
                'facilities' => ['Perahu Katamaran Riset Terumbu Karang', 'Peralatan Snorkeling & Alat Ukur Kualitas Air', 'Pusat Edukasi Konservasi Penyu Wangi-Wangi'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/dest-wakatobi.jpg',
                'gallery_images' => [
                    'assets/img/hd/dest-wakatobi.jpg',
                    'assets/img/hd/dest-sasak-sade.jpg',
                ],
                'contact' => [
                    'name' => 'Dr. La Ode Mansur',
                    'role' => 'Koordinator Monitoring Terumbu Karang TN Wakatobi',
                    'phone' => '0813-8899-0011',
                    'email' => 'edukasi@wakatobinationalpark.id',
                ],
            ],
        ];

        foreach ($destinationsData as $data) {
            $contact = $data['contact'];
            unset($data['contact']);

            $data['partner_id'] = $partner->id;
            $dest = Destination::updateOrCreate(['slug' => $data['slug']], $data);

            DestinationContact::updateOrCreate(
                ['destination_id' => $dest->id],
                [
                    'contact_name' => $contact['name'],
                    'role' => $contact['role'],
                    'phone' => $contact['phone'],
                    'email' => $contact['email'],
                ]
            );

            // Buat slot ketersediaan 30 hari ke depan
            for ($d = 1; $d <= 30; $d++) {
                $date = Carbon::now()->addDays($d)->toDateString();
                AvailabilitySlot::updateOrCreate(
                    ['destination_id' => $dest->id, 'date' => $date],
                    [
                        'capacity' => 120,
                        'booked_count' => ($d % 5 == 0) ? 60 : 0,
                        'status' => ($d % 7 == 0) ? 'full' : 'open',
                    ]
                );
            }
        }

        $destKintamani = Destination::where('slug', 'kampung-kopi-kintamani')->first();
        $destWonosadi = Destination::where('slug', 'hutan-adat-wonosadi')->first();
        $destSade = Destination::where('slug', 'desa-sasak-sade')->first();

        // 4. Sample Booking 1: Menunggu Pembayaran (Kintamani)
        $b1 = Booking::updateOrCreate(
            ['booking_code' => 'DST-2026-0814-KTM'],
            [
                'institution_id' => $institution->id,
                'user_id' => $buyer->id,
                'destination_id' => $destKintamani->id,
                'inquiry_type' => 'study_tour',
                'planned_date_start' => Carbon::now()->addDays(20)->toDateString(),
                'planned_date_end' => Carbon::now()->addDays(22)->toDateString(),
                'participant_count' => 35,
                'guide_count' => 3,
                'purpose_notes' => 'Projek Penguatan Profil Pelajar Pancasila (P5) Tema Kearifan Lokal dan Kewirausahaan Kopi Berkelanjutan.',
                'needs_permit_letter' => true,
                'subtotal_amount' => 1575000,
                'insurance_amount' => 76000,
                'platform_fee' => 25000,
                'total_amount' => 1676000,
                'status' => 'menunggu_pembayaran',
                'internal_notes' => 'Permintaan bus pariwisata 1 unit besar dapat parkir di pelataran Pura Desa.',
            ]
        );

        Payment::updateOrCreate(
            ['booking_id' => $b1->id],
            [
                'gateway_ref' => 'MID-SNAP-20260914-001',
                'payment_method' => 'bca_va',
                'amount' => 1676000,
                'status' => 'pending',
            ]
        );

        Document::updateOrCreate(
            ['booking_id' => $b1->id, 'type' => 'invoice'],
            [
                'title' => 'Invoice Resmi #INV-2026-0814-KTM',
                'file_path' => 'assets/docs/invoice-sample.pdf',
                'generated_at' => Carbon::now()->subHours(2),
            ]
        );

        // 5. Sample Booking 2: Dikonfirmasi & Siap Kunjungan (Wonosadi)
        $b2 = Booking::updateOrCreate(
            ['booking_code' => 'DST-2026-0702-WNS'],
            [
                'institution_id' => $institution->id,
                'user_id' => $buyer->id,
                'destination_id' => $destWonosadi->id,
                'inquiry_type' => 'penelitian',
                'planned_date_start' => Carbon::now()->addDays(8)->toDateString(),
                'planned_date_end' => Carbon::now()->addDays(10)->toDateString(),
                'participant_count' => 20,
                'guide_count' => 2,
                'purpose_notes' => 'Penelitian Lapangan Ekologi Vegetasi Karst dan Pengukuran Laju Resapan Mata Air Gunungkidul.',
                'needs_permit_letter' => true,
                'subtotal_amount' => 700000,
                'insurance_amount' => 44000,
                'platform_fee' => 25000,
                'total_amount' => 769000,
                'status' => 'dikonfirmasi',
                'internal_notes' => 'Mitra telah menyiapkan pemandu tetua adat Ki Sumodiharjo dan izin pendopo.',
            ]
        );

        Payment::updateOrCreate(
            ['booking_id' => $b2->id],
            [
                'gateway_ref' => 'MID-SNAP-20260905-088',
                'payment_method' => 'qris',
                'amount' => 769000,
                'paid_at' => Carbon::now()->subDays(5),
                'status' => 'settled',
            ]
        );

        Document::updateOrCreate(
            ['booking_id' => $b2->id, 'type' => 'invoice'],
            [
                'title' => 'Invoice Lunas #INV-2026-0702-WNS',
                'file_path' => 'assets/docs/invoice-settled.pdf',
                'generated_at' => Carbon::now()->subDays(5),
            ]
        );

        Document::updateOrCreate(
            ['booking_id' => $b2->id, 'type' => 'surat_konfirmasi'],
            [
                'title' => 'Surat Konfirmasi & e-Pass Rombongan #PASS-2026-0702-WNS',
                'file_path' => 'assets/docs/epass-wonosadi.pdf',
                'generated_at' => Carbon::now()->subDays(4),
            ]
        );

        Document::updateOrCreate(
            ['booking_id' => $b2->id, 'type' => 'draf_surat_izin'],
            [
                'title' => 'Draf Surat Pengantar Izin Riset Resmi #IZIN-2026-0702-WNS',
                'file_path' => 'assets/docs/izin-riset-wonosadi.pdf',
                'generated_at' => Carbon::now()->subDays(4),
            ]
        );

        // 6. Sample Booking 3: Selesai (Sade) - Siap Repeat Order
        $b3 = Booking::updateOrCreate(
            ['booking_code' => 'DST-2026-0518-SSD'],
            [
                'institution_id' => $institution->id,
                'user_id' => $buyer->id,
                'destination_id' => $destSade->id,
                'inquiry_type' => 'study_tour',
                'planned_date_start' => Carbon::now()->subDays(60)->toDateString(),
                'planned_date_end' => Carbon::now()->subDays(58)->toDateString(),
                'participant_count' => 45,
                'guide_count' => 4,
                'purpose_notes' => 'Ekskursi Budaya dan Dokumentasi Tenun Tradisional Songket Sade Angkatan 2025/2026.',
                'needs_permit_letter' => true,
                'subtotal_amount' => 1800000,
                'insurance_amount' => 90000,
                'platform_fee' => 25000,
                'total_amount' => 1915000,
                'status' => 'selesai',
                'internal_notes' => 'Kunjungan sukses terlaksana dengan apresiasi memuaskan dari pihak sekolah.',
            ]
        );

        Payment::updateOrCreate(
            ['booking_id' => $b3->id],
            [
                'gateway_ref' => 'MID-SNAP-20260710-044',
                'payment_method' => 'dana_bos',
                'amount' => 1915000,
                'paid_at' => Carbon::now()->subDays(65),
                'status' => 'settled',
            ]
        );

        Document::updateOrCreate(
            ['booking_id' => $b3->id, 'type' => 'invoice'],
            [
                'title' => 'Bukti Tanda Terima & Rekap BOS #LPJ-2026-0518-SSD',
                'file_path' => 'assets/docs/rekap-bos-sade.pdf',
                'generated_at' => Carbon::now()->subDays(58),
            ]
        );
    }
}
