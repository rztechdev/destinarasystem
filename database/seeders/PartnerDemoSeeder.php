<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PartnerProfile;
use App\Models\PartnerPayout;
use App\Models\Destination;
use App\Models\Booking;
use App\Models\Institution;
use Carbon\Carbon;

class PartnerDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Demo Mitra Pengelola Tapak
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

        // 2. Profil Lembaga Pengelola & Rekening Payout
        PartnerProfile::updateOrCreate(
            ['user_id' => $partner->id],
            [
                'organization_name' => 'Badan Pengelola Desa Wisata Adat Penglipuran',
                'organization_type' => 'yayasan_adat',
                'legal_document_number' => 'SK.BUP-BGL/442/2021 (SK Bupati Bangli tentang Pengakuan Pengelola Adat)',
                'bank_name' => 'Bank BPD Bali',
                'bank_account_number' => '012-02-0049182-1',
                'bank_account_holder' => 'BPD PENGELOLA DESA WISATA PENGLIPURAN',
                'verification_status' => 'verified',
            ]
        );

        // 3. Pastikan Destinasi Penglipuran Terhubung ke Akun Mitra Ini
        $destPenglipuran = Destination::where('slug', 'kampung-kopi-kintamani')->first();
        if ($destPenglipuran) {
            $destPenglipuran->update(['partner_id' => $partner->id]);
        }

        // Tambah Destinasi Kedua (Draft / Sedang Kurasi) untuk Demonstrasi Manajemen Listing
        Destination::updateOrCreate(
            ['slug' => 'hutan-bambu-penglipuran'],
            [
                'partner_id' => $partner->id,
                'name' => 'Zona Konservasi Hutan Bambu Purba Penglipuran',
                'category' => 'konservasi_alam',
                'province' => 'Bali',
                'city' => 'Bangli',
                'price_per_pax' => 30000,
                'description' => 'Jalur ekskursi silvikultur bambu endemik seluas 75 hektar dengan stasiun riset struktur tanah vulkanik dan keanekaragaman avifauna pegunungan.',
                'educational_highlights' => 'Pola zonasi adat hutan suci (Palemahan), taksonomi 15 jenis bambu lokal, dan teknologi pengawetan rebung tradisional.',
                'facilities' => ['Boardwalk Jalur Riset Bambu', 'Pos Pengamatan Burung', 'Toilet Lapangan Terpadu', 'Pemandu Jagawana Adat'],
                'suitable_for' => ['study_tour', 'penelitian'],
                'has_permit_document' => true,
                'cover_image' => 'assets/img/hd/story-ulin.jpg',
                'status' => 'pending_review',
            ]
        );

        // 4. Sample Payouts (Sesuai PRD Section 7.9)
        PartnerPayout::updateOrCreate(
            ['payout_reference' => 'PAYOUT-2026-0801-PLP'],
            [
                'partner_id' => $partner->id,
                'gross_amount' => 2500000,
                'commission' => 250000,
                'net_amount' => 2250000,
                'status' => 'transferred',
                'transferred_at' => Carbon::now()->subDays(40),
                'receipt_doc_path' => 'assets/docs/payout-aug1.pdf',
            ]
        );

        PartnerPayout::updateOrCreate(
            ['payout_reference' => 'PAYOUT-2026-0820-PLP'],
            [
                'partner_id' => $partner->id,
                'gross_amount' => 1800000,
                'commission' => 180000,
                'net_amount' => 1620000,
                'status' => 'transferred',
                'transferred_at' => Carbon::now()->subDays(20),
                'receipt_doc_path' => 'assets/docs/payout-aug20.pdf',
            ]
        );

        PartnerPayout::updateOrCreate(
            ['payout_reference' => 'PAYOUT-2026-0910-PLP'],
            [
                'partner_id' => $partner->id,
                'gross_amount' => 1575000,
                'commission' => 157500,
                'net_amount' => 1417500,
                'status' => 'pending',
                'transferred_at' => null,
                'receipt_doc_path' => null,
            ]
        );

        // 5. Sample Booking Baru yang Menunggu Respon dari Mitra
        $buyerUser = User::where('email', 'guru@sman1candirejo.sch.id')->first();
        $institution = Institution::where('user_id', $buyerUser->id)->first();

        if ($destPenglipuran && $institution) {
            Booking::updateOrCreate(
                ['booking_code' => 'DST-2026-0920-UNY'],
                [
                    'institution_id' => $institution->id,
                    'user_id' => $buyerUser->id,
                    'destination_id' => $destPenglipuran->id,
                    'inquiry_type' => 'penelitian',
                    'planned_date_start' => Carbon::now()->addDays(15)->toDateString(),
                    'planned_date_end' => Carbon::now()->addDays(17)->toDateString(),
                    'participant_count' => 28,
                    'guide_count' => 2,
                    'purpose_notes' => 'Riset Lapangan Etnobotani Bambu & Sistem Tata Ruang Awig-Awig Mahasiswa Semester 5.',
                    'needs_permit_letter' => true,
                    'subtotal_amount' => 1260000,
                    'insurance_amount' => 56000,
                    'platform_fee' => 25000,
                    'total_amount' => 1341000,
                    'status' => 'menunggu_pembayaran',
                    'internal_notes' => 'Menunggu konfirmasi penerimaan tetua adat dan kesiapan balai banjar.',
                ]
            );
        }
    }
}
