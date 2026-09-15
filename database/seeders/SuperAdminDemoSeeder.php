<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SystemSetting;
use App\Models\FinancialReconciliation;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SuperAdminDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Super Admin
        $superadmin = User::updateOrCreate(
            ['email' => 'superadmin@destinara.id'],
            [
                'name' => 'Dr. Ir. Suryadi Pratama, M.Sc.',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'phone' => '0811-2233-4455',
            ]
        );

        // 2. Master System Settings
        $settings = [
            // Payment
            ['key' => 'midtrans_server_key', 'value' => 'SB-Mid-server-82xK9L2pQW09mNZ', 'group' => 'payment', 'description' => 'Server Key Midtrans API Production/Sandbox'],
            ['key' => 'midtrans_client_key', 'value' => 'SB-Mid-client-11jKlO098zA', 'group' => 'payment', 'description' => 'Client Key Midtrans JS Snap'],
            ['key' => 'midtrans_environment', 'value' => 'sandbox', 'group' => 'payment', 'description' => 'Mode Transaksi (sandbox / production)'],
            ['key' => 'payment_expiry_hours', 'value' => '24', 'group' => 'payment', 'description' => 'Batas waktu pembayaran VA sebelum auto-cancel (Jam)'],

            // Commission
            ['key' => 'platform_commission_percent', 'value' => '10', 'group' => 'commission', 'description' => 'Persentase komisi platform Destinara (%)'],
            ['key' => 'partner_share_percent', 'value' => '90', 'group' => 'commission', 'description' => 'Persentase hak bersih mitra pengelola tapak (%)'],
            ['key' => 'payout_schedule_day', 'value' => 'Senin', 'group' => 'commission', 'description' => 'Jadwal batch transfer payout mingguan'],

            // System & Security
            ['key' => 'maintenance_mode', 'value' => '0', 'group' => 'system', 'description' => 'Status mode pemeliharaan sistem darurat (0 = nonaktif, 1 = aktif)'],
            ['key' => 'max_upload_size_mb', 'value' => '15', 'group' => 'system', 'description' => 'Batas maksimal unggah dokumen perizinan (MB)'],
            ['key' => 'document_stamp_hash', 'value' => 'SHA256-DESTINARA-RGS-2026-ROOT', 'group' => 'system', 'description' => 'Kunci enkripsi stempel digital dokumen resmi'],

            // Notifications
            ['key' => 'whatsapp_gateway_status', 'value' => 'connected', 'group' => 'notification', 'description' => 'Status Fonnte Gateway Dispatcher'],
            ['key' => 'whatsapp_template_booking', 'value' => 'Halo {NAMA_INSTITUSI}, pengajuan kunjungan {KODE_BOOKING} di {NAMA_TAPAK} telah kami terima. Mohon pantau status persetujuan mitra adat dalam 1x24 jam.', 'group' => 'notification', 'description' => 'Template WA Reservasi Masuk'],
            ['key' => 'email_template_epass', 'value' => 'Yth. {NAMA_PIC}, e-Pass resmi kunjungan {KODE_BOOKING} untuk rombongan {JUMLAH_PAX} peserta telah terbit dan siap digunakan di gerbang masuk.', 'group' => 'notification', 'description' => 'Template Email Tiket e-Pass'],
        ];

        foreach ($settings as $s) {
            SystemSetting::updateOrCreate(['key' => $s['key']], $s);
        }

        // 3. Financial Reconciliations
        FinancialReconciliation::truncate();
        FinancialReconciliation::create([
            'period_month' => '2026-08',
            'gross_inflow' => 145800000,
            'platform_commission' => 14580000,
            'partner_payouts_total' => 131220000,
            'escrow_holding' => 0,
            'status' => 'reconciled',
            'reconciled_by' => $superadmin->id,
            'notes' => 'Rekonsiliasi tutup buku Agustus 2026 tuntas 100% cocok dengan mutasi Bank BCA & Mandiri.',
        ]);

        FinancialReconciliation::create([
            'period_month' => '2026-09',
            'gross_inflow' => 32450000,
            'platform_commission' => 3245000,
            'partner_payouts_total' => 21850000,
            'escrow_holding' => 7355000,
            'status' => 'reconciled',
            'reconciled_by' => $superadmin->id,
            'notes' => 'Periode berjalan September 2026: Escrow holding mencakup booking aktif belum selesai pelaksanaan.',
        ]);
    }
}
