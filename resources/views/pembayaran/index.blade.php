@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')

<div class="space-y-6">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    {{-- Header --}}
<div class="bg-white rounded-3xl shadow-lg p-6">

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Data Pembayaran
            </h2>

            <p class="text-gray-500 mt-2">
                Kelola pembayaran SPP seluruh siswa Ebony Preschool.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('pembayaran.pdf') }}"
               class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl shadow-lg transition">
                📄 Export PDF
            </a>

            <a href="{{ route('pembayaran.create') }}"
               class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-3 rounded-xl shadow-lg hover:opacity-90 transition">
                ➕ Tambah Pembayaran
            </a>

        </div>

    </div>

</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-green-500 text-white rounded-3xl shadow-lg p-6">

        <p class="text-sm">
            Total Pemasukan
        </p>

        <h2 class="text-3xl font-bold mt-2">
            Rp {{ number_format($totalPemasukan,0,',','.') }}
        </h2>

    </div>

    <div class="bg-blue-500 text-white rounded-3xl shadow-lg p-6">

        <p class="text-sm">
            Pembayaran Lunas
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $jumlahLunas }}
        </h2>

    </div>

    <div class="bg-red-500 text-white rounded-3xl shadow-lg p-6">

        <p class="text-sm">
            Belum Lunas
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $jumlahBelumLunas }}
        </h2>

    </div>

</div>

    {{-- Tabel --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-gradient-to-r from-pink-500 to-purple-600 text-white">

                        <th class="px-5 py-4 text-left">
                            No
                        </th>

                        <th class="px-5 py-4 text-left">
                            Nama Siswa
                        </th>

                        <th class="px-5 py-4 text-center">
                            Bulan
                        </th>

                        <th class="px-5 py-4 text-center">
                            Tahun
                        </th>

                        <th class="px-5 py-4 text-right">
                            Nominal
                        </th>

                        <th class="px-5 py-4 text-center">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center">
                            Tanggal Bayar
                        </th>

                        <th class="px-5 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>
                    @forelse($pembayaran as $item)

<tr class="border-b hover:bg-pink-50 transition duration-200">

    <td class="px-5 py-4">
        {{ $loop->iteration + ($pembayaran->currentPage() - 1) * $pembayaran->perPage() }}
    </td>

    <td class="px-5 py-4 font-semibold text-gray-700">
    @if($item->siswa)
        {{ $item->siswa->nama }}
    @else
        <span class="text-red-500">-</span>
    @endif
</td>

    <td class="px-5 py-4 text-center">
        {{ $item->bulan }}
    </td>

    <td class="px-5 py-4 text-center">
        {{ $item->tahun }}
    </td>

    <td class="px-5 py-4 text-right font-semibold text-green-600">
        Rp {{ number_format($item->nominal, 0, ',', '.') }}
    </td>

    <td class="px-5 py-4 text-center">

        @if($item->status == 'Lunas')

            <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                ✅ Lunas
            </span>

        @else

            <span class="px-4 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                ❌ Belum Lunas
            </span>

        @endif

    </td>

    <td class="px-5 py-4 text-center">
        {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d-m-Y') : '-' }}
    </td>

    <td class="px-5 py-4">

        <div class="flex justify-center gap-2">

            <a href="{{ route('pembayaran.edit', $item->id) }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg transition">

                ✏ Edit

            </a>

            <form action="{{ route('pembayaran.destroy', $item->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data pembayaran ini?')">

                @csrf
                @method('DELETE')

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                    🗑 Hapus

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="8" class="text-center py-12 text-gray-400">

        <div class="flex flex-col items-center">

            <div class="text-6xl mb-4">
                💳
            </div>

            <h3 class="text-xl font-semibold">
                Belum ada data pembayaran
            </h3>

            <p class="mt-2">
                Silakan tambahkan pembayaran pertama.
            </p>

        </div>

    </td>

</tr>

@endforelse
                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t bg-gray-50">

            {{ $pembayaran->links() }}

        </div>

    </div>

</div>

@endsection