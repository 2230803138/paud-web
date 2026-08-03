@extends('layouts.yayasan')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-4xl font-bold">Laporan Kesiswaan & Absensi</h1>
            <p class="mt-3 text-pink-100">Monitoring data siswa Ebony Preschool per kelas beserta rekap kehadirannya.</p>
        </div>
        
        <form method="GET" action="{{ route('yayasan.laporan-siswa.pdf') }}" class="flex items-center gap-2">
            <select name="kelas" class="border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-700 font-semibold focus:outline-none text-sm">
                <option value="">Semua Kelas</option>
                @foreach($kelasOptions as $opt)
                    <option value="{{ $opt }}" {{ $kelas == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-white text-pink-600 font-bold px-5 py-3 rounded-xl shadow-lg hover:scale-105 duration-200 text-sm">
                🖨️ Cetak PDF Siswa
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Daftar Siswa -->
        <div class="bg-white rounded-3xl shadow-lg p-6 lg:col-span-1 h-fit">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Pilih Kelas Monitoring</h3>
            
            <form method="GET" action="{{ route('yayasan.laporan-siswa') }}" class="space-y-3 mb-6">
                <!-- Keep other queries if any -->
                <input type="hidden" name="tanggal_mulai" value="{{ $tanggalMulai }}">
                <input type="hidden" name="tanggal_selesai" value="{{ $tanggalSelesai }}">
                <input type="hidden" name="kelas_absensi" value="{{ $kelasAbsensi }}">

                <select name="kelas" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="">-- Semua Kelas --</option>
                    @foreach($kelasOptions as $opt)
                        <option value="{{ $opt }}" {{ $kelas == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </form>

            <div class="overflow-y-auto max-h-96 space-y-3 pr-2">
                @forelse($siswa as $s)
                    <div class="bg-pink-50/50 p-4 rounded-2xl flex justify-between items-center border border-pink-100">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $s->nama }}</h4>
                            <span class="text-xs text-gray-400 font-semibold uppercase">{{ $s->jenis_kelamin }}</span>
                        </div>
                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">
                            {{ $s->kelas ?? 'Belum Ada' }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-6">Tidak ada siswa terdaftar.</p>
                @endforelse
            </div>
        </div>

        <!-- Absensi Siswa -->
        <div class="bg-white rounded-3xl shadow-lg p-6 lg:col-span-2">
            <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
                <h3 class="text-xl font-bold text-gray-800">Filter Absensi Siswa</h3>
                
                <a href="{{ route('yayasan.laporan-siswa.absensi.pdf', request()->query()) }}" 
                    class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-200 text-sm">
                    📥 Download PDF Absensi
                </a>
            </div>

            <form method="GET" action="{{ route('yayasan.laporan-siswa') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-6">
                <!-- Keep other queries if any -->
                <input type="hidden" name="kelas" value="{{ $kelas }}">

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Kelas Siswa</label>
                    <select name="kelas_absensi" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelasOptions as $opt)
                            <option value="{{ $opt }}" {{ $kelasAbsensi == $opt ? 'selected' : '' }}>{{ $opt }}</option>
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

                <div class="md:col-span-3">
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">
                        🔍 Filter Absensi
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                            <th class="p-4 rounded-l-xl">No</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Nama Siswa</th>
                            <th class="p-4">Kelas</th>
                            <th class="p-4 rounded-r-xl">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($absensi as $index => $item)
                            <tr class="hover:bg-pink-50/50 transition">
                                <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                <td class="p-4 font-semibold text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}
                                </td>
                                <td class="p-4 font-bold text-gray-800">{{ $item->siswa->nama }}</td>
                                <td class="p-4 text-gray-600">{{ $item->siswa->kelas ?? '-' }}</td>
                                <td class="p-4">
                                    @php
                                        $status = strtolower($item->status);
                                    @endphp
                                    <span class="px-3 py-1 rounded-full font-bold text-xs
                                        {{ $status == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $status == 'izin' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $status == 'sakit' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $status == 'alfa' ? 'bg-red-100 text-red-700' : '' }}
                                    ">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">Belum ada riwayat absensi siswa pada periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
