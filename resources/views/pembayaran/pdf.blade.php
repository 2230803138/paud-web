<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
            margin-bottom:2px;
        }

        h4{
            text-align:center;
            margin-top:0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:8px;
        }

        table th{
            background:#eeeeee;
        }

        .text-right{
            text-align:right;
        }

        .text-center{
            text-align:center;
        }

        .footer{
            margin-top:50px;
            width:100%;
        }

    </style>

</head>

<body>

<h2>EBONY PRESCHOOL</h2>

<h4>LAPORAN PEMBAYARAN SPP</h4>

<hr>

<table>

<thead>

<tr>

<th>No</th>
<th>Nama Siswa</th>
<th>Bulan</th>
<th>Tahun</th>
<th>Nominal</th>
<th>Status</th>
<th>Tanggal Bayar</th>

</tr>

</thead>

<tbody>

@foreach($pembayaran as $item)

<tr>

<td class="text-center">
{{ $loop->iteration }}
</td>

<td>
{{ $item->siswa->nama ?? '-' }}
</td>

<td class="text-center">
{{ $item->bulan }}
</td>

<td class="text-center">
{{ $item->tahun }}
</td>

<td class="text-right">
Rp {{ number_format($item->nominal,0,',','.') }}
</td>

<td class="text-center">
{{ $item->status }}
</td>

<td class="text-center">
{{ $item->tanggal_bayar }}
</td>

</tr>

@endforeach

</tbody>

</table>

<h3 style="text-align:right; margin-top:25px;">

Total Pemasukan :
Rp {{ number_format($totalPemasukan,0,',','.') }}

</h3>

<table class="footer" style="border:none;">

<tr style="border:none;">

<td style="border:none;"></td>

<td style="border:none; text-align:center; width:250px;">

Palembang, {{ date('d F Y') }}

<br><br><br><br>

<b>Kepala Sekolah</b>

</td>

</tr>

</table>

</body>

</html>