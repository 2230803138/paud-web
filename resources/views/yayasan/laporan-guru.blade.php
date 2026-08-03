@extends('layouts.yayasan')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-4xl font-bold">Laporan Kepegawaian Guru</h1>
            <p class="mt-3 text-pink-100">Monitoring data kepegawaian serta riwayat kehadiran guru Ebony Preschool.</p>
        </div>
        <a href="{{ route('yayasan.laporan-guru.pdf') }}" class="bg-white text-pink-600 font-bold px-6 py-3.5 rounded-xl shadow-lg hover:scale-105 duration-200">
            🖨️ Cetak PDF Data Guru
        </a>
    </div>

    <!-- Filter & Riwayat Absensi -->
    <div class="bg-white rounded-3xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Filter Kehadiran Guru</h2>
            
            <!-- Download Absensi PDF with matching queries -->
            <a href="{{ route('yayasan.laporan-guru.absensi.pdf', request()->query()) }}" 
                class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-6 py-3 rounded-xl shadow-md transition duration-200">
                📥 Download PDF Absensi
            </a>
        </div>

        <form method="GET" action="{{ route('yayasan.laporan-guru') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Guru</label>
                <select name="guru_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="">-- Semua Guru --</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}" {{ $guruId == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
            </div>

            <div>
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">
                    🔍 Filter Data
                </button>
            </div>
        </form>

        <!-- Tabel Log Absensi -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                        <th class="p-4 rounded-l-xl">No</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Nama Guru</th>
                        <th class="p-4">Jam Masuk</th>
                        <th class="p-4">Jam Pulang</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 rounded-r-xl">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($absensi as $index => $item)
                        <tr class="hover:bg-pink-50/50 transition">
                            <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 font-semibold text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}
                            </td>
                            <td class="p-4 font-bold text-gray-800">{{ $item->guru->nama }}</td>
                            <td class="p-4 text-gray-600">{{ $item->jam_masuk ?? '-' }}</td>
                            <td class="p-4 text-gray-600">{{ $item->jam_pulang ?? '-' }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full font-bold text-xs
                                    {{ $item->status == 'Hadir' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $item->status == 'Izin' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $item->status == 'Sakit' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $item->status == 'Alfa' ? 'bg-red-100 text-red-700' : '' }}
                                ">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500 text-sm max-w-xs truncate" title="{{ $item->keterangan }}">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400">Belum ada riwayat absensi guru pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
