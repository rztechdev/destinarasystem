<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ strtoupper($type) }} — {{ $booking->booking_code }}</title>
    <!-- Google Fonts: Newsreader & Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,600;0,6..72,700;1,6..72,400&family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..24,400,0..1,0" />
    <style>
        body {
            font-family: 'Work Sans', sans-serif;
            color: #2B211E;
            background: #f0ebe6;
            margin: 0;
            padding: 30px;
        }
        .paper {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid rgba(43, 33, 30, 0.2);
            padding: 50px 60px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            position: relative;
        }
        .header-border {
            border-bottom: 2px solid #703A3A;
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .logo-title {
            font-family: 'Newsreader', serif;
            font-size: 24px;
            font-weight: bold;
            color: #703A3A;
            letter-spacing: -0.5px;
        }
        .doc-title {
            font-family: 'Newsreader', serif;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #2B211E;
            margin-bottom: 5px;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 13px;
        }
        .table-data th {
            background: #faf6f0;
            border: 1px solid rgba(43, 33, 30, 0.15);
            padding: 10px 12px;
            text-align: left;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .table-data td {
            border: 1px solid rgba(43, 33, 30, 0.15);
            padding: 10px 12px;
        }
        .stamp-box {
            display: inline-block;
            border: 2px dashed #51634b;
            color: #51634b;
            padding: 8px 16px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transform: rotate(-3deg);
            margin-top: 20px;
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #703A3A;
            color: white;
            padding: 10px 20px;
            border: none;
            font-family: 'Work Sans', sans-serif;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 100;
        }
        @media print {
            body { background: white; padding: 0; }
            .paper { box-shadow: none; border: none; padding: 0; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn">
        Cetak Dokumen Resmi (PDF)
    </button>

    <div class="paper">
        <!-- Kop Dokumen -->
        <div class="header-border">
            <div style="display: flex; align-items: flex-start; gap: 14px;">
                <img src="{{ asset('assets/img/logo-mark-tight.png') }}" alt="Logo Destinara" style="height: 48px; width: auto; object-fit: contain;">
                <div>
                    <div class="logo-title">DESTINARA</div>
                    <div style="font-size: 11px; color: #703A3A; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                        Ruang Belajar Tapak Nusantara
                    </div>
                    <div style="font-size: 11px; color: #666; margin-top: 4px;">
                        PT Destinara Edukasi Nusantara • SK Kemenkumham RI: AHU-0019283.AH.01.01
                    </div>
                </div>
            </div>
            <div style="text-align: right;">
                <div class="doc-title">
                    @if($type === 'invoice')
                        INVOICE RESMI
                    @elseif($type === 'surat_konfirmasi')
                        SURAT KONFIRMASI & e-PASS
                    @else
                        DRAF SURAT IZIN RISET
                    @endif
                </div>
                <div style="font-family: monospace; font-size: 13px; font-weight: bold; color: #703A3A;">
                    NO: {{ $booking->booking_code }}
                </div>
                <div style="font-size: 11px; color: #666; margin-top: 2px;">
                    Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        <!-- Identitas Pemohon -->
        <table style="width: 100%; font-size: 13px; margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <strong style="text-transform: uppercase; font-size: 11px; color: #703A3A;">Institusi Pemohon:</strong><br>
                    <strong>{{ $booking->institution->institution_name }}</strong><br>
                    NPSN: {{ $booking->institution->npsn ?? '-' }}<br>
                    {{ $booking->institution->address }}<br>
                    {{ $booking->institution->city }}, {{ $booking->institution->province }}
                </td>
                <td style="width: 50%; vertical-align: top; text-align: right;">
                    <strong style="text-transform: uppercase; font-size: 11px; color: #703A3A;">Tapak Destinasi Tujuan:</strong><br>
                    <strong>{{ $booking->destination->name }}</strong><br>
                    {{ $booking->destination->city }}, {{ $booking->destination->province }}<br>
                    Kategori: {{ strtoupper(str_replace('_', ' ', $booking->destination->category)) }}<br>
                    Jadwal: {{ \Carbon\Carbon::parse($booking->planned_date_start)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($booking->planned_date_end)->translatedFormat('d M Y') }}
                </td>
            </tr>
        </table>

        <!-- Tabel Rincian -->
        <table class="table-data">
            <thead>
                <tr>
                    <th>Deskripsi Komponen Edukasi</th>
                    <th style="text-align: center;">Kuantitas</th>
                    <th style="text-align: right;">Tarif Satuan</th>
                    <th style="text-align: right;">Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Akses Laboratorium Alam & Fasilitator Adat</strong><br>
                        <span style="font-size: 11px; color: #666;">
                            Kunjungan akademik {{ $booking->inquiry_type === 'study_tour' ? 'Study Tour P5' : 'Penelitian Lapangan' }} di {{ $booking->destination->name }}.
                        </span>
                    </td>
                    <td style="text-align: center;">{{ $booking->participant_count }} Siswa</td>
                    <td style="text-align: right;">Rp {{ number_format($booking->destination->price_per_pax, 0, ',', '.') }}</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($booking->subtotal_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Premi Asuransi Proteksi Lapangan Siswa</strong><br>
                        <span style="font-size: 11px; color: #666;">Jaminan keselamatan lapangan selama durasi ekskursi.</span>
                    </td>
                    <td style="text-align: center;">{{ $booking->participant_count }} Peserta</td>
                    <td style="text-align: right;">Rp 2.000</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($booking->insurance_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Administrasi e-Pass & Draf Izin Riset</strong><br>
                        <span style="font-size: 11px; color: #666;">Verifikasi legalitas dan arsip LPJ BOS.</span>
                    </td>
                    <td style="text-align: center;">1 Rombongan</td>
                    <td style="text-align: right;">Rp 25.000</td>
                    <td style="text-align: right; font-weight: bold;">Rp 25.000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="background: #faf6f0; font-size: 14px;">
                    <td colspan="3" style="text-align: right; font-weight: bold;">TOTAL TRANSAKSI RESMI:</td>
                    <td style="text-align: right; font-weight: bold; color: #703A3A; font-family: monospace; font-size: 16px;">
                        Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Stempel Digital & Tanda Tangan -->
        <div style="margin-top: 40px; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <div class="stamp-box">
                    ✓ DESTINARA VERIFIED & DIGITALLY SEALED
                </div>
                <div style="font-size: 10px; color: #888; margin-top: 6px;">
                    Hash Dokumen: {{ md5($booking->booking_code . $booking->total_amount) }}
                </div>
            </div>

            <div style="text-align: center; width: 220px; font-size: 12px;">
                <div>Dikeluarkan Resmi Oleh:</div>
                <div style="font-weight: bold; margin-top: 2px;">Direktorat Kemitraan & Kurikulum</div>
                <div style="height: 60px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-family: 'Newsreader', serif; font-size: 20px; font-style: italic; color: #703A3A;">Destinara Indonesia</span>
                </div>
                <div style="border-top: 1px solid #2B211E; padding-top: 4px; font-weight: bold;">
                    Aditya Nugroho, M.Ed.
                </div>
                <div style="font-size: 10px; color: #666;">NIPD. 2026.01.0091</div>
            </div>
        </div>
    </div>

</body>
</html>
