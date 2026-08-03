<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemasukan Keuangan SPP - Ebony Preschool</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h2 {
            font-size: 18px;
            color: #333333;
        }
        h4 {
            font-size: 12px;
            margin-top: 5px;
            color: #555;
        }
        .header-section {
            margin-bottom: 20px;
        }
        hr {
            border: 0;
            border-top: 2px solid #333333;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 40px;
            width: 100%;
        }
        .footer-table td {
            border: none;
        }
        .info-filter {
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="header-section">
    <h2>EBONY PRESCHOOL</h2>
    <h4>LAPORAN PEMBAYARAN SPP KEUANGAN</h4>
    <hr>
</div>

<div class="info-filter">
    Bulan: {{ $bulan ?? 'Semua Bulan' }} | Tahun: {{ $tahun ?? 'Semua Tahun' }}<br>
    Status: {{ $status ?? 'Semua Status' }}
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="30%">Nama Siswa</th>
            <th width="15%">Kelas</th>
            <th width="15%">Bulan/Tahun</th>
            <th width="15%">Nominal</th>
            <th width="20%">Tanggal Bayar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pembayaran as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td><b>{{ $item->siswa->nama ?? '-' }}</b></td>
                <td class="text-center">{{ $item->siswa->kelas ?? '-' }}</td>
                <td class="text-center">{{ $item->bulan }} / {{ $item->tahun }}</td>
                <td class="text-right">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                <td class="text-center">
                    {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->translatedFormat('d-m-Y') : '-' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 15px;">Belum ada riwayat transaksi pembayaran SPP.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<h3 style="text-align: right; margin-top: 25px; color: #db2777;">
    Total Pemasukan (Lunas): Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
</h3>

<table class="footer footer-table">
    <tr>
        <td></td>
        <td style="text-align: center; width: 250px;">
            Palembang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <br><br><br><br>
            <b>Ketua Yayasan Ebony Preschool</b>
        </td>
    </tr>
</table>

</body>
</html>
