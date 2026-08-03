@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">
        <h1 class="text-4xl font-bold">Riwayat Absensi Mandiri</h1>
        <p class="mt-3 text-pink-100">Pantau kehadiran Anda dan ajukan izin/sakit jika berhalangan hadir.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Form Pengajuan Izin/Sakit -->
        <div class="bg-white rounded-3xl shadow-lg p-6 lg:col-span-1 h-fit">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Pengajuan Ketidakhadiran</h2>
            
            @php
                $todayAbsence = $absensi->where('tanggal', today()->toDateString())->first();
            @endphp

            @if($todayAbsence)
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 text-center">
                    <p class="text-gray-600">Absensi Anda hari ini:</p>
                    <span class="inline-block mt-2 px-4 py-1.5 rounded-full font-bold text-sm 
                        {{ $todayAbsence->status == 'Hadir' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $todayAbsence->status == 'Izin' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $todayAbsence->status == 'Sakit' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $todayAbsence->status == 'Alfa' ? 'bg-red-100 text-red-700' : '' }}
                    ">
                        {{ $todayAbsence->status }}
                    </span>
                    @if($todayAbsence->keterangan)
                        <p class="text-gray-500 text-sm mt-2 italic">"{{ $todayAbsence->keterangan }}"</p>
                    @endif
                </div>
            @else
                <form action="{{ route('guru.absen.izin-sakit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Status Absensi</label>
                        <select name="status" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Alasan / Keterangan</label>
                        <textarea name="keterangan" required rows="3" placeholder="Tulis alasan Anda..." class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:opacity-90 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">
                        Kirim Pengajuan
                    </button>
                </form>
            @endif
        </div>

        <!-- Tabel Riwayat -->
        <div class="bg-white rounded-3xl shadow-lg p-6 lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Log Absensi Anda</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                            <th class="p-4 rounded-l-xl">No</th>
                            <th class="p-4">Tanggal</th>
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
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </td>
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
                                <td colspan="6" class="p-8 text-center text-gray-400">Belum ada riwayat absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection