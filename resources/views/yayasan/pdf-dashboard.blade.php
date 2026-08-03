<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Menyeluruh - Ebony Preschool</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #374151;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        
        /* Kop Surat Resmi */
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .kop-surat td {
            border: none;
            padding: 0;
        }
        .kop-logo {
            width: 70px;
            vertical-align: middle;
        }
        .kop-text {
            text-align: center;
            vertical-align: middle;
        }
        .kop-text h1 {
            font-size: 22px;
            color: #1f2937;
            margin: 0;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .kop-text p {
            font-size: 9px;
            color: #6b7280;
            margin: 3px 0 0 0;
            line-height: 1.3;
        }
        .double-line {
            border: none;
            border-top: 3px solid #1f2937;
            border-bottom: 1px solid #1f2937;
            height: 3px;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        /* Metadata & Info Laporan */
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }
        .meta-table td {
            border: none;
            padding: 8px 12px;
            font-size: 10px;
            color: #4b5563;
        }
        .meta-label {
            font-weight: bold;
            color: #1f2937;
            width: 15%;
        }
        .meta-value {
            width: 35%;
        }

        /* Judul Section */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #1f2937;
            border-bottom: 2px solid #d1d5db;
            padding-bottom: 4px;
            margin-top: 25px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        /* Grid Widget Ringkasan */
        .summary-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-bottom: 20px;
        }
        .summary-grid td {
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 12px 8px;
            text-align: center;
            width: 25%;
        }
        .summary-icon {
            font-size: 18px;
            margin-bottom: 4px;
        }
        .summary-label {
            font-size: 8px;
            font-weight: bold;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-top: 4px;
        }

        /* Layout Columns (Table-Based) */
        .columns-table {
            width: 100%;
            border-collapse: collapse;
        }
        .columns-table td {
            border: none;
            vertical-align: top;
            padding: 0;
        }

        /* Tabel Standar */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #e5e7eb;
            padding: 7px 10px;
            font-size: 10px;
        }
        table.data-table th {
            background-color: #f3f4f6;
            color: #1f2937;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }
        table.data-table tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        table.data-table tr.total-row {
            background-color: #f3f4f6;
            font-weight: bold;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-green {
            background-color: #dcfce7;
            color: #15803d;
        }
        .badge-yellow {
            background-color: #fef9c3;
            color: #a16207;
        }
        .badge-red {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        /* Footer Tanda Tangan */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }
        .signature-table td {
            border: none;
            width: 50%;
            font-size: 11px;
        }
        .signature-box {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
        
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <!-- Kop Surat Resmi -->
    <table class="kop-surat">
        <tr>
            <td class="kop-text">
                <h1>EBONY PRESCHOOL</h1>
                <p>
                    Komp. Ebony Residence No. A1-A3, Palembang, Sumatera Selatan<br>
                    Telp: (0711) 555-1234 | Email: info@ebonypreschool.sch.id | Website: www.ebonypreschool.sch.id
                </p>
            </td>
        </tr>
    </table>

    <div class="double-line"></div>

    <div class="text-center" style="margin-bottom: 20px;">
        <span style="font-size: 14px; font-weight: bold; color: #1f2937; text-decoration: underline;">
            LAPORAN EKSEKUTIF PERKEMBANGAN SEKOLAH
        </span>
    </div>

    <!-- Metadata Laporan -->
    <table class="meta-table">
        <tr>
            <td class="meta-label">📍 Cabang</td>
            <td class="meta-value">: {{ $cabang->nama_cabang ?? 'Semua Cabang (Pusat)' }}</td>
            <td class="meta-label">📅 Tanggal Cetak</td>
            <td class="meta-value">: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="meta-label">👤 Dicetak Oleh</td>
            <td class="meta-value">: {{ Auth::user()->name }} (Yayasan)</td>
            <td class="meta-label">📈 Periode Laporan</td>
            <td class="meta-value">: Tahun {{ $currentYear }}</td>
        </tr>
    </table>

    <div class="section-title">1. Ringkasan Statistik Operasional</div>
    
    <!-- Grid Widgets -->
    <table class="summary-grid">
        <tr>
            <td>
                <div class="summary-icon">👩‍🏫</div>
                <div class="summary-label">Total Guru</div>
                <div class="summary-value">{{ $totalGuru }} orang</div>
            </td>
            <td>
                <div class="summary-icon">👶</div>
                <div class="summary-label">Total Siswa</div>
                <div class="summary-value">{{ $totalSiswa }} anak</div>
            </td>
            <td>
                <div class="summary-icon">📝</div>
                <div class="summary-label">Pendaftaran Baru</div>
                <div class="summary-value">{{ $totalPendaftaran }} berkas</div>
            </td>
            <td>
                <div class="summary-icon">💰</div>
                <div class="summary-label">Pemasukan SPP</div>
                <div class="summary-value" style="font-size: 12px; color: #16a34a;">
                    Rp {{ number_format($totalPembayaranLunas, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Bagian 2: Distribusi Kelas Siswa (Full Width) -->
    <div class="section-title">2. Distribusi Kelas Siswa</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Jenis Kelas</th>
                <th class="text-center" style="width: 30%;">Jumlah Siswa</th>
                <th class="text-center" style="width: 30%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelasStats as $namaKelas => $jumlah)
                @php
                    $pct = $totalSiswa > 0 ? ($jumlah / $totalSiswa) * 100 : 0;
                @endphp
                <tr>
                    <td><strong>{{ $namaKelas }}</strong></td>
                    <td class="text-center">{{ $jumlah }} anak</td>
                    <td class="text-center">{{ round($pct, 1) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bagian 3: Rangkuman Absensi Murid (Full Width di bawahnya) -->
    <div class="section-title">3. Rangkuman Absensi Murid (Hari Ini)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Status Kehadiran</th>
                <th class="text-center" style="width: 40%;">Jumlah Murid</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🟢 Hadir</td>
                <td class="text-center"><strong>{{ $studentAttendanceData['hadir'] }} anak</strong></td>
            </tr>
            <tr>
                <td>🟡 Izin</td>
                <td class="text-center">{{ $studentAttendanceData['izin'] }} anak</td>
            </tr>
            <tr>
                <td>🔵 Sakit</td>
                <td class="text-center">{{ $studentAttendanceData['sakit'] }} anak</td>
            </tr>
            <tr>
                <td>🔴 Alfa</td>
                <td class="text-center">{{ $studentAttendanceData['alfa'] }} anak</td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>

    <div class="section-title" style="margin-top: 0;">4. Laporan Realisasi SPP Bulanan (Tahun {{ $currentYear }})</div>
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 10%;">No</th>
                <th style="width: 50%;">Bulan Tagihan</th>
                <th class="text-right" style="width: 40%;">Total Pemasukan SPP Lunas</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($sppMonthlyOrdered as $bulan => $total)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td><strong>{{ $bulan }}</strong></td>
                    <td class="text-right" style="color: {{ $total > 0 ? '#16a34a' : '#9ca3af' }}; font-weight: {{ $total > 0 ? 'bold' : 'normal' }};">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2" class="text-center">TOTAL REALISASI PEMASUKAN SPP</td>
                <td class="text-right" style="color: #16a34a; font-size: 11px;">
                    Rp {{ number_format($totalPembayaranLunas, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">5. Log Pendaftaran Calon Siswa Terbaru (PPDB)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 8%;">No</th>
                <th style="width: 32%;">Nama Calon Siswa</th>
                <th style="width: 30%;">Nama Wali Murid</th>
                <th class="text-center" style="width: 15%;">Tanggal Daftar</th>
                <th class="text-center" style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentPendaftaran as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $p->nama_anak }}</strong></td>
                    <td>{{ $p->nama_ortu }}</td>
                    <td class="text-center">{{ $p->created_at->translatedFormat('d-m-Y') }}</td>
                    <td class="text-center">
                        <span class="badge {{ $p->status == 'diterima' ? 'badge-green' : ($p->status == 'ditolak' ? 'badge-red' : 'badge-yellow') }}">
                            {{ $p->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada berkas pendaftaran baru yang masuk pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer Tanda Tangan -->
    <table class="signature-table">
        <tr>
            <td></td>
            <td>
                <div class="signature-box">
                    Palembang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                    <strong>Kepala Yayasan Ebony Preschool</strong>
                    <br><br><br><br><br>
                    <span style="text-decoration: underline; font-weight: bold;">(......................................................)</span>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
