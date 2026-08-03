@extends('layouts.orangtua')

@section('title', 'Jadwal Anak')

@section('content')

<div class="space-y-6">

    <!-- Header Banner / Profile Card -->
    @if($siswa)
        <div class="bg-gradient-to-r from-pink-500 via-fuchsia-500 to-purple-600 rounded-3xl p-8 shadow-xl shadow-pink-500/20 text-white relative overflow-hidden">
            <!-- Decorative circle overlay -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <span class="bg-white/20 text-white font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider">
                        Agenda & Kegiatan Kelas
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-tight mt-3">Jadwal Kegiatan Anak</h1>
                    
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
                    <span class="text-xs text-pink-200 font-bold uppercase tracking-wider">Agenda Aktif</span>
                    <span class="text-3xl font-black text-white mt-1">{{ $jadwal->count() }} Kegiatan</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Container -->
    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
        
        @if(!$siswa)
            <div class="bg-red-50 border border-red-200 text-red-700 p-6 rounded-2xl text-center font-bold">
                Akun Anda belum dikaitkan dengan data peserta didik. Silakan hubungi admin sekolah.
            </div>
        @else
            <div class="flex items-center gap-2 mb-6">
                <div class="w-2 h-6 bg-pink-500 rounded-full"></div>
                <h2 class="text-xl font-bold text-gray-800">Kalender Agenda Kelas - {{ $siswa->kelas }}</h2>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                <table class="w-full text-left border-collapse">
                     <thead>
                        <tr class="bg-gradient-to-r from-pink-500 to-purple-500 text-white">
                            <th class="p-4 font-bold text-sm text-center w-16">No</th>
                            <th class="p-4 font-bold text-sm">Nama Kegiatan</th>
                            <th class="p-4 font-bold text-sm text-center w-36">Tanggal</th>
                            <th class="p-4 font-bold text-sm text-center w-28">Waktu/Jam</th>
                            <th class="p-4 font-bold text-sm">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($jadwal as $index => $item)
                        <tr class="hover:bg-pink-50/20 transition align-top">
                            <td class="p-4 text-center text-gray-400 font-bold text-sm">
                                {{ $index + 1 }}
                            </td>
                            <td class="p-4 font-bold text-gray-800">
                                🔔 {{ $item->kegiatan }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 px-3 py-1.5 rounded-full text-xs font-bold border border-purple-100">
                                    📅 {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </span>
                            </td>
                            <td class="p-4 text-center font-semibold text-gray-600">
                                <span class="inline-flex items-center gap-1 bg-pink-50 text-pink-700 px-2.5 py-1 rounded-lg text-xs border border-pink-100/60 font-bold">
                                    ⏰ {{ $item->jam }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-650 text-sm">
                                {{ $item->keterangan ?: '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-16 text-gray-400 font-medium">
                                <div class="text-5xl mb-4">📅</div>
                                <div class="text-lg font-bold text-gray-500">Belum Ada Jadwal</div>
                                <div class="text-sm text-gray-400 mt-1">Jadwal kegiatan atau agenda kelas untuk kelas <strong>{{ $siswa->kelas }}</strong> belum diinput oleh pihak sekolah.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</div>

@endsection