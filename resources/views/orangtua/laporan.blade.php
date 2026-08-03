@php
if (!function_exists('getCategoryScore')) {
    function getCategoryScore($score) {
        if (is_null($score) || $score === '') return '';
        $s = (int)$score;
        if ($s >= 90) return ' (Sangat Baik)';
        if ($s >= 75) return ' (Baik)';
        if ($s >= 60) return ' (Cukup)';
        return ' (Kurang)';
    }
}
@endphp
@extends('layouts.orangtua')

@section('title', 'Laporan Anak')

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
                        Hasil Belajar & Tumbuh Kembang
                    </span>
                    <h1 class="text-3xl font-extrabold tracking-tight mt-3">Laporan Perkembangan Anak</h1>
                    
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
                    <span class="text-xs text-pink-200 font-bold uppercase tracking-wider">Total Laporan</span>
                    <span class="text-3xl font-black text-white mt-1">{{ $laporan->count() }} Kali</span>
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
                <h2 class="text-xl font-bold text-gray-800">Riwayat Penilaian & Catatan Harian</h2>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                <table class="w-full text-left border-collapse">
                     <thead>
                        <tr class="bg-gradient-to-r from-pink-500 to-purple-500 text-white">
                            <th class="p-4 font-bold text-sm text-center w-16">No</th>
                            <th class="p-4 font-bold text-sm text-center w-36">Tanggal</th>
                            <th class="p-4 font-bold text-sm">Catatan & Laporan Perkembangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($laporan as $index => $item)
                        <tr class="hover:bg-pink-50/20 transition align-top">
                            <td class="p-4 text-center text-gray-400 font-bold text-sm">
                                {{ $index + 1 }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 px-3 py-1.5 rounded-full text-xs font-bold border border-purple-100">
                                    📅 {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </span>
                            </td>
                            <td class="p-4 space-y-4">
                                <!-- Catatan Guru Card -->
                                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                                    {{ $item->perkembangan ?: $item->catatan ?: '-' }}
                                    
                                    @if($item->guru)
                                        <div class="mt-3 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-gray-400 font-semibold">
                                            <span>✍️ Penilai:</span>
                                            <span class="text-pink-600">Miss/Mr {{ $item->guru->nama }}</span>
                                        </div>
                                    @else
                                        <div class="mt-3 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-gray-400 font-semibold">
                                            <span>✍️ Penilai:</span>
                                            <span class="text-gray-500 italic">Sekolah/Admin</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Kriteria Skor Toddler/Nursery -->
                                @if(($siswa->kelas === 'Toddler' || $siswa->kelas === 'Nursery') && ($item->kognitif || $item->motorik || $item->bahasa || $item->sosial_emosional || $item->agama_moral))
                                    <div class="bg-pink-50/20 border border-pink-100/40 p-4 rounded-2xl">
                                        <p class="text-xs font-bold text-pink-600 mb-3 flex items-center gap-1.5">
                                            📊 Skor Kriteria Perkembangan (0-100)
                                        </p>
                                        <div class="flex flex-wrap gap-2.5">
                                            @if($item->kognitif)
                                                <span class="bg-pink-50 text-pink-700 font-bold px-3 py-1.5 rounded-xl border border-pink-100 flex items-center gap-1.5 shadow-sm text-xs">
                                                    🧠 Kog: <strong class="text-pink-800 text-sm font-black">{{ $item->kognitif }}</strong>{{ getCategoryScore($item->kognitif) }}
                                                </span>
                                            @endif
                                            @if($item->motorik)
                                                <span class="bg-blue-50 text-blue-700 font-bold px-3 py-1.5 rounded-xl border border-blue-100 flex items-center gap-1.5 shadow-sm text-xs">
                                                    🏃 Mot: <strong class="text-blue-800 text-sm font-black">{{ $item->motorik }}</strong>{{ getCategoryScore($item->motorik) }}
                                                </span>
                                            @endif
                                            @if($item->bahasa)
                                                <span class="bg-green-50 text-green-700 font-bold px-3 py-1.5 rounded-xl border border-green-100 flex items-center gap-1.5 shadow-sm text-xs">
                                                    🗣️ Bah: <strong class="text-green-800 text-sm font-black">{{ $item->bahasa }}</strong>{{ getCategoryScore($item->bahasa) }}
                                                </span>
                                            @endif
                                            @if($item->sosial_emosional)
                                                <span class="bg-purple-50 text-purple-700 font-bold px-3 py-1.5 rounded-xl border border-purple-100 flex items-center gap-1.5 shadow-sm text-xs">
                                                    🤝 Sos: <strong class="text-purple-800 text-sm font-black">{{ $item->sosial_emosional }}</strong>{{ getCategoryScore($item->sosial_emosional) }}
                                                </span>
                                            @endif
                                            @if($item->agama_moral)
                                                <span class="bg-yellow-50 text-yellow-800 font-bold px-3 py-1.5 rounded-xl border border-yellow-100/70 flex items-center gap-1.5 shadow-sm text-xs">
                                                    🕌 Rel: <strong class="text-yellow-900 text-sm font-black">{{ $item->agama_moral }}</strong>{{ getCategoryScore($item->agama_moral) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                <!-- Foto Kegiatan Baby Class -->
                                @elseif($siswa->kelas === 'Baby Class' && $item->foto)
                                    <div class="bg-purple-50/20 border border-purple-100/40 p-4 rounded-2xl">
                                        <p class="text-xs font-bold text-purple-600 mb-3 flex items-center gap-1.5">
                                            📷 Dokumentasi Foto Aktivitas Anak
                                        </p>
                                        <a href="{{ asset($item->foto) }}" target="_blank" class="inline-block group relative rounded-2xl overflow-hidden shadow-sm border border-gray-100 bg-white p-1">
                                            <img src="{{ asset($item->foto) }}" class="w-32 h-32 object-cover rounded-xl group-hover:scale-105 transition duration-300">
                                            <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center text-white text-lg">
                                                🔍
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-16 text-gray-400 font-medium">
                                <div class="text-5xl mb-4">📝</div>
                                <div class="text-lg font-bold text-gray-500">Belum Ada Laporan</div>
                                <div class="text-sm text-gray-400 mt-1">Laporan perkembangan anak belum diinput oleh Miss pengajar.</div>
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