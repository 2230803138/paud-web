<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Guru - Ebony Preschool</title>
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
    </style>
</head>
<body>

<div class="header-section">
    <h2>EBONY PRESCHOOL</h2>
    <h4>LAPORAN DATABASE KEPEGAWAIAN GURU</h4>
    <hr>
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">NIP</th>
            <th width="20%">Nama Lengkap</th>
            <th width="12%">Jenis Kelamin</th>
            <th width="15%">Jabatan</th>
            <th width="13%">No Handphone</th>
            <th width="20%">Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guru as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item->nip }}</td>
                <td><b>{{ $item->nama }}</b></td>
                <td class="text-center">{{ $item->jenis_kelamin }}</td>
                <td class="text-center">{{ ucwords($item->jabatan) }}</td>
                <td class="text-center">{{ $item->no_hp }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
        @endforeach
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
