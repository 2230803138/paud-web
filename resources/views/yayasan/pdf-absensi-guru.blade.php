<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Guru - Ebony Preschool</title>
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
    <h4>LAPORAN ABSENSI GURU</h4>
    <hr>
</div>

<div class="info-filter">
    Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($tanggalSelesai)->translatedFormat('d F Y') }}<br>
    @if($selectedGuru)
        Guru: {{ $selectedGuru->nama }} (NIP: {{ $selectedGuru->nip }})
    @else
        Guru: Semua Kepegawaian
    @endif
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Tanggal</th>
            <th width="25%">Nama Guru</th>
            <th width="12%">Jam Masuk</th>
            <th width="12%">Jam Pulang</th>
            <th width="13%">Status</th>
            <th width="18%">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($absensi as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}</td>
                <td><b>{{ $item->guru->nama }}</b></td>
                <td class="text-center">{{ $item->jam_masuk ?? '-' }}</td>
                <td class="text-center">{{ $item->jam_pulang ?? '-' }}</td>
                <td class="text-center"><b>{{ $item->status }}</b></td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 15px;">Belum ada riwayat absensi guru pada periode ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>

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
