@extends('layouts.orangtua')

@section('title', 'Absensi Anak')

@section('content')

<div class="space-y-6">

    <!-- Header Banner / Profile Card -->
    @if($absensi->count() && $absensi->first()->siswa)
        @php $siswa = $absensi->first()->siswa; @endphp
        <div class="bg-gradient-to-r from-pink-500 via-fuchsia-500 to-purple-600 rounded-3xl p-8 shadow-xl shadow-pink-500/20 text-white relative overflow-hidden">
            <!-- Decorative circle overlay -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <span class="bg-white/20 text-white font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider">
                        Kehadiran Harian Siswa
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-tight mt-3">Riwayat Absensi Anak</h1>
                    
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 mt-4 text-sm text-pink-100 font-medium">
                        <span class="flex items-center gap-1.5">
                            👤 <strong>Nama:</strong> {{ $siswa->nama }}
                        </span>
                        <span class="hidden sm:inline text-pink-300">|</span>
                        <span class="flex items-center gap-1.5">
                            🏫 <strong>Kelas:</strong> {{ $siswa->kelas }}
                        </span>
                    </div>
                </div>
                
                <div class="bg-white/15 backdrop-blur-md border border-white/20 px-6 py-4 rounded-2xl shadow-inner text-center self-stretch sm:self-auto flex sm:flex-col justify-center items-center gap-1">
                    <span class="text-xs text-pink-200 font-bold uppercase tracking-wider">Total Hari</span>
                    <span class="text-3xl font-black text-white mt-1">{{ $absensi->count() }} Hari</span>
                </div>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl p-8 shadow-xl text-white">
            <h1 class="text-3xl font-bold">Riwayat Absensi Anak</h1>
            <p class="text-pink-100 mt-2 text-sm">Lihat rekapitulasi kehadiran harian anak didik.</p>
        </div>
    @endif

    <!-- Main Container -->
    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
        
        @if(!$absensi->count())
            <div class="text-center py-16 text-gray-400 font-medium">
                <div class="text-5xl mb-4">📅</div>
                <div class="text-lg font-bold text-gray-500">Belum Ada Data Absensi</div>
                <div class="text-sm text-gray-400 mt-1">Data absensi harian anak belum tersedia pada periode ini.</div>
            </div>
        @else
            <div class="flex items-center gap-2 mb-6">
                <div class="w-2 h-6 bg-pink-500 rounded-full"></div>
                <h2 class="text-xl font-bold text-gray-800">Catatan Kehadiran Bulanan</h2>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                <table class="w-full text-left border-collapse">
                     <thead>
                        <tr class="bg-gradient-to-r from-pink-500 to-purple-500 text-white">
                            <th class="p-4 font-bold text-sm text-center w-16">No</th>
                            <th class="p-4 font-bold text-sm">Nama Anak</th>
                            <th class="p-4 font-bold text-sm text-center w-36">Tanggal</th>
                            <th class="p-4 font-bold text-sm text-center w-32">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($absensi as $index => $item)
                        <tr class="hover:bg-pink-50/20 transition">
                            <td class="p-4 text-center text-gray-400 font-bold text-sm">
                                {{ $index + 1 }}
                            </td>
                            <td class="p-4 font-bold text-gray-800">
                                {{ $item->siswa->nama }}
                                <div class="text-[10px] text-gray-400 font-normal uppercase mt-0.5">Kelas: {{ $item->siswa->kelas }}</div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 px-3 py-1.5 rounded-full text-xs font-bold border border-purple-100">
                                    📅 {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @switch(strtolower(trim($item->status)))
                                    @case('hadir')
                                        <span class="inline-flex items-center justify-center bg-green-100 text-green-700 font-extrabold px-3.5 py-1.5 rounded-xl text-xs shadow-sm border border-green-200">
                                            🟢 Hadir
                                        </span>
                                        @break
                                    @case('izin')
                                        <span class="inline-flex items-center justify-center bg-yellow-100 text-yellow-700 font-extrabold px-3.5 py-1.5 rounded-xl text-xs shadow-sm border border-yellow-200">
                                            🟡 Izin
                                        </span>
                                        @break
                                    @case('sakit')
                                        <span class="inline-flex items-center justify-center bg-blue-100 text-blue-700 font-extrabold px-3.5 py-1.5 rounded-xl text-xs shadow-sm border border-blue-200">
                                            🔵 Sakit
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex items-center justify-center bg-red-100 text-red-700 font-extrabold px-3.5 py-1.5 rounded-xl text-xs shadow-sm border border-red-200">
                                            🔴 Alfa
                                        </span>
                                @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</div>

@endsection