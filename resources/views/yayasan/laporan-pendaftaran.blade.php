@extends('layouts.yayasan')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-4xl font-bold">Laporan Pendaftaran Siswa Baru</h1>
            <p class="mt-3 text-pink-100">Monitoring data calon siswa baru yang mendaftar ke Ebony Preschool.</p>
        </div>
        
        <!-- Print PDF with current filter queries -->
        <a href="{{ route('yayasan.laporan-pendaftaran.pdf', request()->query()) }}" 
            class="bg-white text-pink-600 font-bold px-6 py-3.5 rounded-xl shadow-lg hover:scale-105 duration-200">
            🖨️ Cetak PDF Pendaftaran
        </a>
    </div>

    <!-- Filter & Tabel Log Pendaftaran -->
    <div class="bg-white rounded-3xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Filter Laporan Pendaftaran</h3>

        <form method="GET" action="{{ route('yayasan.laporan-pendaftaran') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Filter Status Pendaftaran</label>
                <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="">-- Semua Status --</option>
                    <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="diterima" {{ $status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                        <th class="p-4">Nama Calon Siswa</th>
                        <th class="p-4">Jenis Kelamin</th>
                        <th class="p-4">Nama Orang Tua</th>
                        <th class="p-4">Nomor HP</th>
                        <th class="p-4">Tanggal Lahir</th>
                        <th class="p-4 rounded-r-xl">Status Pendaftaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pendaftaran as $index => $item)
                        <tr class="hover:bg-pink-50/50 transition">
                            <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 font-bold text-gray-800">{{ $item->nama_anak }}</td>
                            <td class="p-4 text-gray-600">{{ $item->jenis_kelamin }}</td>
                            <td class="p-4 font-semibold text-gray-700">{{ $item->nama_ortu }}</td>
                            <td class="p-4 text-gray-600">{{ $item->no_hp }}</td>
                            <td class="p-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($item->tgl_lahir)->translatedFormat('d F Y') }}
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full font-bold text-xs
                                    {{ $item->status == 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $item->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $item->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400">Belum ada data pendaftaran calon siswa pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
