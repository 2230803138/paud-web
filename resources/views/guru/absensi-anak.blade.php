@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">
        <h1 class="text-4xl font-bold">Absensi Siswa</h1>
        <p class="mt-3 text-pink-100">Catat kehadiran harian anak-anak Ebony Preschool secara berkelompok.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Kelas & Tanggal -->
    <div class="bg-white rounded-3xl shadow-lg p-6">
        <form method="GET" action="{{ route('guru.absensi-anak') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Tanggal</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Kelas</label>
                <select name="kelas" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach($kelasOptions as $opt)
                        <option value="{{ $opt }}" {{ $kelas == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">
                    🔍 Tampilkan Siswa
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Siswa -->
    @if($kelas)
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa - {{ $kelas }}</h2>
                <span class="bg-purple-100 text-purple-700 px-4 py-1.5 rounded-full font-bold text-sm">
                    Tanggal: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                </span>
            </div>

            @if($siswa->isEmpty())
                <div class="p-8 text-center text-gray-400">
                    Tidak ada data siswa terdaftar di kelas <strong>{{ $kelas }}</strong>.
                </div>
            @else
                <form method="POST" action="{{ route('guru.absensi-anak.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                    <input type="hidden" name="kelas" value="{{ $kelas }}">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                                    <th class="p-4 rounded-l-xl w-16">No</th>
                                    <th class="p-4">Nama Siswa</th>
                                    <th class="p-4">Jenis Kelamin</th>
                                    <th class="p-4 text-center rounded-r-xl">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($siswa as $index => $s)
                                    @php
                                        $currentStatus = $s->absensi_hari_ini ? strtolower($s->absensi_hari_ini->status) : 'hadir';
                                    @endphp
                                    <tr class="hover:bg-pink-50/50 transition">
                                        <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                        <td class="p-4 font-semibold text-gray-700">{{ $s->nama }}</td>
                                        <td class="p-4 text-gray-600">{{ $s->jenis_kelamin }}</td>
                                        <td class="p-4">
                                            <div class="flex justify-center items-center gap-6">
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="statuses[{{ $s->id }}]" value="hadir" 
                                                        {{ $currentStatus == 'hadir' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-green-500 border-gray-300 focus:ring-green-400">
                                                    <span class="text-sm font-semibold text-green-600">Hadir</span>
                                                </label>

                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="statuses[{{ $s->id }}]" value="izin" 
                                                        {{ $currentStatus == 'izin' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-yellow-500 border-gray-300 focus:ring-yellow-400">
                                                    <span class="text-sm font-semibold text-yellow-600">Izin</span>
                                                </label>

                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="statuses[{{ $s->id }}]" value="sakit" 
                                                        {{ $currentStatus == 'sakit' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-blue-500 border-gray-300 focus:ring-blue-400">
                                                    <span class="text-sm font-semibold text-blue-600">Sakit</span>
                                                </label>

                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="statuses[{{ $s->id }}]" value="alfa" 
                                                        {{ $currentStatus == 'alfa' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-red-500 border-gray-300 focus:ring-red-400">
                                                    <span class="text-sm font-semibold text-red-600">Alfa</span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-500 hover:opacity-90 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition duration-200">
                            💾 Simpan Seluruh Absensi
                        </button>
                    </div>
                </form>
            @endif
        </div>
    @else
        <div class="bg-pink-50 border border-pink-200 rounded-3xl p-8 text-center text-gray-500">
            👋 Silakan pilih <strong>Tanggal</strong> dan <strong>Kelas</strong> di atas untuk memuat daftar absensi siswa.
        </div>
    @endif

</div>
@endsection