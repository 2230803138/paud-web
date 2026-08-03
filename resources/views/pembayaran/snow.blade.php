@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <h2 class="text-2xl font-bold mb-6">
        Detail Pembayaran
    </h2>

    <table class="table-auto w-full">

        <tr>
            <td class="font-semibold py-2">Nama Siswa</td>
            <td>{{ $pembayaran->siswa->nama ?? '-' }}</td>
        </tr>

        <tr>
            <td class="font-semibold py-2">Bulan</td>
            <td>{{ $pembayaran->bulan }}</td>
        </tr>

        <tr>
            <td class="font-semibold py-2">Tahun</td>
            <td>{{ $pembayaran->tahun }}</td>
        </tr>

        <tr>
            <td class="font-semibold py-2">Nominal</td>
            <td>Rp {{ number_format($pembayaran->nominal,0,',','.') }}</td>
        </tr>

        <tr>
            <td class="font-semibold py-2">Status</td>
            <td>{{ $pembayaran->status }}</td>
        </tr>

        <tr>
            <td class="font-semibold py-2">Tanggal Bayar</td>
            <td>{{ $pembayaran->tanggal_bayar }}</td>
        </tr>

    </table>

    <a href="{{ route('pembayaran.index') }}"
       class="mt-6 inline-block bg-purple-600 text-white px-5 py-2 rounded-lg">
        Kembali
    </a>

</div>

@endsection