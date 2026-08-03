@extends('layouts.yayasan')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-4xl font-bold">Laporan SPP & Pemasukan Keuangan</h1>
            <p class="mt-3 text-pink-100">Monitoring data pembayaran SPP siswa Ebony Preschool secara realtime.</p>
        </div>
        
        <!-- Print PDF with current filter queries -->
        <a href="{{ route('yayasan.laporan-pembayaran.pdf', request()->query()) }}" 
            class="bg-white text-pink-600 font-bold px-6 py-3.5 rounded-xl shadow-lg hover:scale-105 duration-200">
            🖨️ Cetak PDF Laporan Keuangan
        </a>
    </div>

    <!-- Statistik Keuangan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Total Pendapatan -->
        <div class="bg-white rounded-3xl shadow-lg p-6 flex items-center gap-4 border-l-8 border-green-500">
            <div class="w-12 h-12 bg-green-150 rounded-2xl flex items-center justify-center text-xl text-green-600">
                💰
            </div>
            <div>
                <p class="text-gray-400 text-sm font-semibold">Total Pemasukan (Lunas)</p>
                <h3 class="text-2xl font-extrabold text-gray-800 mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Jumlah Lunas -->
        <div class="bg-white rounded-3xl shadow-lg p-6 flex items-center gap-4 border-l-8 border-blue-500">
            <div class="w-12 h-12 bg-blue-150 rounded-2xl flex items-center justify-center text-xl text-blue-600">
                ✔️
            </div>
            <div>
                <p class="text-gray-400 text-sm font-semibold">Transaksi Lunas</p>
                <h3 class="text-2xl font-extrabold text-gray-800 mt-1">{{ $jumlahLunas }} Transaksi</h3>
            </div>
        </div>

        <!-- Jumlah Belum Lunas -->
        <div class="bg-white rounded-3xl shadow-lg p-6 flex items-center gap-4 border-l-8 border-red-500">
            <div class="w-12 h-12 bg-red-150 rounded-2xl flex items-center justify-center text-xl text-red-600">
                ❌
            </div>
            <div>
                <p class="text-gray-400 text-sm font-semibold">Transaksi Belum Lunas</p>
                <h3 class="text-2xl font-extrabold text-gray-800 mt-1">{{ $jumlahBelumLunas }} Transaksi</h3>
            </div>
        </div>

    </div>

    <!-- Filter & Tabel Log SPP -->
    <div class="bg-white rounded-3xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Filter Laporan Pembayaran</h3>

        <form method="GET" action="{{ route('yayasan.laporan-pembayaran') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Filter Bulan</label>
                <select name="bulan" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="">-- Semua Bulan --</option>
                    @php
                        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    @endphp
                    @foreach($months as $m)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $m }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Filter Tahun</label>
                <select name="tahun" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="">-- Semua Tahun --</option>
                    @php
                        $startYear = today()->year - 2;
                        $endYear = today()->year + 2;
                    @endphp
                    @for($y = $startYear; $y <= $endYear; $y++)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Filter Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="">-- Semua Status --</option>
                    <option value="Lunas" {{ $status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Belum Lunas" {{ $status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
            </div>

            <div>
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">
                    🔍 Filter Laporan
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                        <th class="p-4 rounded-l-xl">No</th>
                        <th class="p-4">Nama Siswa</th>
                        <th class="p-4">Kelas</th>
                        <th class="p-4">Bulan / Tahun</th>
                        <th class="p-4">Nominal SPP</th>
                        <th class="p-4">Tanggal Bayar</th>
                        <th class="p-4 rounded-r-xl">Status SPP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pembayaran as $index => $item)
                        <tr class="hover:bg-pink-50/50 transition">
                            <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 font-bold text-gray-800">{{ $item->siswa->nama ?? '-' }}</td>
                            <td class="p-4 text-gray-600">{{ $item->siswa->kelas ?? '-' }}</td>
                            <td class="p-4 font-semibold text-purple-700">{{ $item->bulan }} / {{ $item->tahun }}</td>
                            <td class="p-4 font-bold text-gray-800">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="p-4 text-gray-600">
                                {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->translatedFormat('d F Y') : '-' }}
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full font-bold text-xs
                                    {{ $item->status == 'Lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                                ">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400">Belum ada riwayat transaksi SPP pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
