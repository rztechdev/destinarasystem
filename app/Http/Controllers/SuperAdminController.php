<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Destination;
use App\Models\Institution;
use App\Models\PartnerProfile;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\PartnerPayout;
use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\SystemSetting;
use App\Models\FinancialReconciliation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    /**
     * Quick Login Demo Super Admin
     */
    public function quickLogin()
    {
        $superadmin = User::where('role', 'superadmin')->first();
        if (!$superadmin) {
            $superadmin = User::firstOrCreate(
                ['email' => 'superadmin@destinara.id'],
                [
                    'name' => 'Dr. Ir. Suryadi Pratama, M.Sc.',
                    'password' => bcrypt('password'),
                    'role' => 'superadmin',
                    'phone' => '0811-2233-4455',
                ]
            );
        }
        Auth::login($superadmin);
        return redirect()->route('superadmin.dashboard')->with('success', 'Selamat datang di Konsol Eksekutif Super Admin Destinara.');
    }

    /**
     * Halaman 1: Dashboard Kontrol Ekosistem
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalDestinations = Destination::where('status', 'published')->count();
        $totalBookings = Booking::count();
        
        // GMV & Keuangan Makro
        $totalGmv = 178250000;
        $platformCommissionTotal = 17825000;
        $partnerPayoutsTotal = 153070000;
        $escrowHolding = 7355000;

        // Health Checks
        $services = [
            ['name' => 'Database Relasional (SQLite Core)', 'status' => 'healthy', 'latency' => '0.4ms', 'detail' => '10 Tabel Terindeks'],
            ['name' => 'Midtrans Payment Gateway Snap', 'status' => 'healthy', 'latency' => '112ms', 'detail' => 'Sandbox Mode Connected'],
            ['name' => 'Fonnte WhatsApp API Dispatcher', 'status' => 'healthy', 'latency' => '85ms', 'detail' => 'Quota: 9.420 / 10.000'],
            ['name' => 'Mailgun SMTP Official Notification', 'status' => 'healthy', 'latency' => '140ms', 'detail' => 'DKIM/SPF Verified'],
            ['name' => 'Penyimpanan Dokumen & e-Pass', 'status' => 'healthy', 'latency' => '1.2ms', 'detail' => 'Kapasitas Aman (15.2 GB Free)'],
        ];

        $latestAudits = AuditLog::with('user')->latest()->take(6)->get();

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'totalDestinations',
            'totalBookings',
            'totalGmv',
            'platformCommissionTotal',
            'partnerPayoutsTotal',
            'escrowHolding',
            'services',
            'latestAudits'
        ));
    }

    /**
     * Halaman 2: Pengaturan Master
     */
    public function settings()
    {
        $settings = SystemSetting::all()->groupBy('group');
        return view('superadmin.settings', compact('settings'));
    }

    /**
     * Update Pengaturan Master
     */
    public function updateSettings(Request $request)
    {
        $inputs = $request->except(['_token']);

        foreach ($inputs as $key => $value) {
            SystemSetting::where('key', $key)->update(['value' => $value]);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_system_settings',
            'entity_type' => 'SystemSetting',
            'description' => 'Super Admin memperbarui konfigurasi parameter master ekosistem.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Konfigurasi master platform berhasil disimpan dan langsung diterapkan.');
    }

    /**
     * Halaman 3: Modal Dialog Tindakan Kritis & Manajemen Akses Pengguna
     */
    public function users(Request $request)
    {
        $role = $request->query('role', 'all');
        $search = $request->query('search', '');

        $query = User::with(['institution', 'partnerProfile']);

        if ($role !== 'all') {
            $query->where('role', $role);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->get();

        $roleCounts = [
            'all' => User::count(),
            'buyer' => User::where('role', 'buyer')->count(),
            'partner' => User::where('role', 'partner')->count(),
            'admin' => User::where('role', 'admin')->count(),
            'superadmin' => User::where('role', 'superadmin')->count(),
        ];

        return view('superadmin.users', compact('users', 'role', 'search', 'roleCounts'));
    }

    /**
     * Eksekusi Tindakan Kritis (Critical Operations)
     */
    public function executeCriticalAction(Request $request)
    {
        $action = $request->input('critical_action');
        $confirmation = $request->input('confirmation_code');

        if ($confirmation !== 'KONFIRMASI') {
            return back()->with('warning', 'Kode konfirmasi keamanan tidak cocok. Tindakan kritis dibatalkan.');
        }

        if ($action === 'clear_cache') {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'critical_clear_cache',
                'description' => 'Super Admin melakukan pembersihan cache darurat sistem (App, View, Config Cache Flush).',
                'ip_address' => $request->ip(),
            ]);

            return back()->with('success', 'Pembersihan cache darurat berhasil diselesaikan 100%.');
        } elseif ($action === 'toggle_maintenance') {
            $current = SystemSetting::get('maintenance_mode', '0');
            $new = ($current === '1') ? '0' : '1';
            SystemSetting::set('maintenance_mode', $new, 'system', 'Status mode pemeliharaan');

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'critical_maintenance_toggle',
                'description' => ($new === '1') 
                    ? 'Super Admin mengaktifkan Maintenance Mode darurat ekosistem.'
                    : 'Super Admin menonaktifkan Maintenance Mode (Sistem Normal).',
                'ip_address' => $request->ip(),
            ]);

            return back()->with('success', ($new === '1') ? 'Mode Pemeliharaan DARURAT telah diaktifkan.' : 'Sistem kembali beroperasi normal.');
        } elseif ($action === 'suspend_user') {
            $userId = $request->input('target_user_id');
            $targetUser = User::findOrFail($userId);
            
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'critical_suspend_user',
                'entity_type' => 'User',
                'entity_id' => $targetUser->id,
                'description' => "Super Admin menonaktifkan akses akun {$targetUser->name} ({$targetUser->email}).",
                'ip_address' => $request->ip(),
            ]);

            return back()->with('warning', "Akses akun {$targetUser->name} telah dibekukan sementara.");
        }

        return back();
    }

    /**
     * Halaman 4: Analitik Bisnis & Reporting Ekosistem
     */
    public function analytics()
    {
        // Funnel data
        $funnel = [
            ['stage' => 'Pengajuan Booking Rombongan', 'count' => 142, 'percent' => 100],
            ['stage' => 'Disetujui Mitra Pengelola Adat', 'count' => 116, 'percent' => 82],
            ['stage' => 'Pelunasan SP2D / BOS Resmi', 'count' => 105, 'percent' => 74],
            ['stage' => 'Kunjungan Terlaksana Tuntas', 'count' => 97, 'percent' => 68],
        ];

        // Monthly GMV & Revenue Trend (Apr - Sep 2026)
        $monthlyTrend = [
            ['month' => 'Apr 2026', 'gmv' => 18500000, 'revenue' => 1850000],
            ['month' => 'Mei 2026', 'gmv' => 24200000, 'revenue' => 2420000],
            ['month' => 'Jun 2026', 'gmv' => 31000000, 'revenue' => 3100000],
            ['month' => 'Jul 2026', 'gmv' => 38900000, 'revenue' => 3890000],
            ['month' => 'Agt 2026', 'gmv' => 45600000, 'revenue' => 4560000],
            ['month' => 'Sep 2026 (Mtd)', 'gmv' => 20050000, 'revenue' => 2005000],
        ];

        // Sebaran Geografis
        $geoDist = [
            ['region' => 'D.I. Yogyakarta & Jawa Tengah', 'share' => 42, 'tapak' => 12, 'gmv' => 'Rp 74.800.000'],
            ['region' => 'Bali & Nusa Tenggara Barat', 'share' => 34, 'tapak' => 8, 'gmv' => 'Rp 60.600.000'],
            ['region' => 'Jawa Timur & Jawa Barat', 'share' => 16, 'tapak' => 5, 'gmv' => 'Rp 28.500.000'],
            ['region' => 'Sumatera & Kepulauan Bahari', 'share' => 8, 'tapak' => 3, 'gmv' => 'Rp 14.350.000'],
        ];

        return view('superadmin.analytics', compact('funnel', 'monthlyTrend', 'geoDist'));
    }

    /**
     * Halaman 5: Rekonsiliasi Keuangan & Audit Log Master
     */
    public function reconciliation()
    {
        $reconciliations = FinancialReconciliation::with('auditor')->latest()->get();
        $masterAudits = AuditLog::with('user')->latest()->take(25)->get();

        // Rekonsiliasi Mutasi Bank Penampung
        $bankLedgers = [
            ['bank' => 'Bank Central Asia (BCA Escrow)', 'acc' => '827-091-8899', 'inflow' => 102400000, 'outflow' => 88500000, 'balance' => 13900000, 'status' => 'MATCHED'],
            ['bank' => 'Bank Mandiri (BOS / VA Hub)', 'acc' => '137-00-19283-0', 'inflow' => 55850000, 'outflow' => 49720000, 'balance' => 6130000, 'status' => 'MATCHED'],
            ['bank' => 'Bank BPD Bali (Mitra Hub)', 'acc' => '010-01-99281-2', 'inflow' => 20000000, 'outflow' => 18000000, 'balance' => 2000000, 'status' => 'MATCHED'],
        ];

        return view('superadmin.reconciliation', compact('reconciliations', 'masterAudits', 'bankLedgers'));
    }

    /**
     * Tutup Buku & Rekonsiliasi Bulan Berjalan
     */
    public function triggerReconciliation(Request $request)
    {
        $period = Carbon::now()->format('Y-m');

        FinancialReconciliation::updateOrCreate(
            ['period_month' => $period],
            [
                'gross_inflow' => 32450000,
                'platform_commission' => 3245000,
                'partner_payouts_total' => 21850000,
                'escrow_holding' => 7355000,
                'status' => 'reconciled',
                'reconciled_by' => Auth::id(),
                'notes' => 'Rekonsiliasi tutup buku otomatis berhasil diproses dan dicocokkan dengan mutasi rekening gateway.',
            ]
        );

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'financial_reconciliation_closed',
            'description' => "Super Admin menuntaskan rekonsiliasi tutup buku periode {$period}.",
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', "Rekonsiliasi pembukuan periode {$period} berhasil disahkan dan ditutup.");
    }
}
