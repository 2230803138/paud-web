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
@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">
        <h1 class="text-4xl font-bold">Laporan Perkembangan Anak</h1>
        <p class="mt-3 text-pink-100">Catat milestones, perkembangan belajar, dan catatan khusus perkembangan anak.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-350 text-red-700 px-5 py-4 rounded-2xl mb-4">
            <ul class="list-disc pl-5 space-y-1 text-sm font-semibold">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg p-6">
        
        <!-- Tab Buttons (simulated with standard bootstrap/tailwind or simple toggle tabs) -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-6" id="tabs">
                <button onclick="switchTab('daftar-tab', 'form-tab')" id="btn-daftar" class="border-b-2 border-pink-500 text-pink-600 pb-4 px-1 font-bold text-lg focus:outline-none">
                    📋 Daftar Laporan
                </button>
                <button onclick="switchTab('form-tab', 'daftar-tab')" id="btn-tambah" class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 pb-4 px-1 font-semibold text-lg focus:outline-none">
                    ➕ Tambah Laporan Baru
                </button>
            </nav>
        </div>

        <!-- Tab 1: Daftar Laporan -->
        <div id="daftar-tab" class="space-y-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50 text-pink-700 font-semibold text-sm">
                            <th class="p-4 rounded-l-xl w-12">No</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Nama Siswa</th>
                            <th class="p-4">Kelas</th>
                            <th class="p-4">Guru</th>
                            <th class="p-4">Perkembangan</th>
                            <th class="p-4">Catatan</th>
                            <th class="p-4 rounded-r-xl text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($laporan as $index => $item)
                            <tr class="hover:bg-pink-50/50 transition align-top">
                                <td class="p-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                <td class="p-4 font-semibold text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}
                                </td>
                                <td class="p-4 font-semibold text-gray-700">{{ $item->siswa->nama }}</td>
                                <td class="p-4 text-gray-600">{{ $item->siswa->kelas ?? '-' }}</td>
                                <td class="p-4 text-gray-750 font-bold">
                                    @if($item->guru)
                                        🧑‍🏫 {{ $item->guru->nama }}
                                    @else
                                        <span class="text-gray-400 italic">Sekolah/Admin</span>
                                    @endif
                                </td>
                                 <td class="p-4 text-gray-600 text-sm max-w-xs">
                                     <div class="whitespace-pre-line">{{ $item->perkembangan }}</div>
                                     @if($item->siswa && $item->siswa->kelas === 'Baby Class' && $item->foto)
                                         <div class="mt-2">
                                             <a href="{{ asset($item->foto) }}" target="_blank">
                                                 <img src="{{ asset($item->foto) }}" class="w-16 h-16 object-cover rounded-xl shadow-sm hover:scale-105 transition border border-gray-200">
                                             </a>
                                         </div>
                                     @elseif($item->siswa && ($item->siswa->kelas === 'Toddler' || $item->siswa->kelas === 'Nursery') && ($item->kognitif || $item->motorik || $item->bahasa || $item->sosial_emosional || $item->agama_moral))
                                         <div class="mt-2 flex flex-wrap gap-1.5 text-[10px]">
                                             @if($item->kognitif)<span class="bg-pink-100 text-pink-700 font-bold px-2 py-0.5 rounded">Kog: {{ $item->kognitif }}{{ getCategoryScore($item->kognitif) }}</span>@endif
                                             @if($item->motorik)<span class="bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded">Mot: {{ $item->motorik }}{{ getCategoryScore($item->motorik) }}</span>@endif
                                             @if($item->bahasa)<span class="bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded">Bah: {{ $item->bahasa }}{{ getCategoryScore($item->bahasa) }}</span>@endif
                                             @if($item->sosial_emosional)<span class="bg-purple-100 text-purple-700 font-bold px-2 py-0.5 rounded">Sos: {{ $item->sosial_emosional }}{{ getCategoryScore($item->sosial_emosional) }}</span>@endif
                                             @if($item->agama_moral)<span class="bg-yellow-100 text-yellow-800 font-bold px-2 py-0.5 rounded">Rel: {{ $item->agama_moral }}{{ getCategoryScore($item->agama_moral) }}</span>@endif
                                         </div>
                                     @endif
                                 </td>
                                <td class="p-4 text-gray-500 text-sm max-w-xs whitespace-pre-line">{{ $item->catatan ?? '-' }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('guru.perkembangan.edit', $item->id) }}" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.perkembangan.destroy', $item->id) }}" method="POST" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan perkembangan ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-gray-400">Belum ada laporan perkembangan anak yang dicatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 2: Form Tambah -->
        <div id="form-tab" class="hidden max-w-2xl">
            <form method="POST" action="{{ route('guru.perkembangan.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Siswa</label>
                    <select name="siswa_id" id="siswa-select" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                        <option value="" disabled selected>-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}" data-kelas="{{ $s->kelas }}">{{ $s->nama }} (Kelas: {{ $s->kelas ?? '-' }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Section Nilai (Toddler & Nursery) -->
                <div id="scores-section" class="hidden bg-pink-50/50 p-6 rounded-2xl border border-pink-100/50 space-y-4">
                    <h3 class="font-bold text-pink-700 text-sm mb-2">⭐ Nilai Kriteria Perkembangan (Toddler & Nursery)</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['kognitif' => 'Kognitif', 'motorik' => 'Motorik', 'bahasa' => 'Bahasa', 'sosial_emosional' => 'Sosial Emosional', 'agama_moral' => 'Agama & Moral'] as $name => $label)
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">{{ $label }}</label>
                                <input type="number" name="{{ $name }}" min="0" max="100" placeholder="Skor (0-100)" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section Foto (Baby Class) -->
                <div id="photo-section" class="hidden bg-purple-50/50 p-6 rounded-2xl border border-purple-100/50 space-y-2">
                    <h3 class="font-bold text-purple-700 text-sm mb-2">📷 Foto Kegiatan Harian (Baby Class)</h3>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Unggah Foto Anak</label>
                    <input type="file" name="foto" id="foto-input" accept="image/*" class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:ring-purple-500 focus:border-purple-500">
                    <p class="text-[10px] text-gray-500">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Laporan</label>
                    <input type="date" name="tanggal" value="{{ today()->toDateString() }}" required 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Catatan / Laporan Perkembangan</label>
                    <textarea name="catatan" required rows="4" placeholder="Tuliskan catatan perkembangan, keahlian baru, atau pencapaian belajar anak didik..." 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-500 hover:opacity-90 text-white font-bold px-8 py-3 rounded-xl shadow-md transition duration-200">
                        💾 Simpan Laporan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function switchTab(showId, hideId) {
        document.getElementById(showId).classList.remove('hidden');
        document.getElementById(hideId).classList.add('hidden');

        if (showId === 'daftar-tab') {
            document.getElementById('btn-daftar').classList.add('border-pink-500', 'text-pink-600');
            document.getElementById('btn-daftar').classList.remove('border-transparent', 'text-gray-500');
            document.getElementById('btn-tambah').classList.add('border-transparent', 'text-gray-500');
            document.getElementById('btn-tambah').classList.remove('border-pink-500', 'text-pink-600', 'font-bold');
        } else {
            document.getElementById('btn-tambah').classList.add('border-pink-500', 'text-pink-600', 'font-bold');
            document.getElementById('btn-tambah').classList.remove('border-transparent', 'text-gray-500');
            document.getElementById('btn-daftar').classList.add('border-transparent', 'text-gray-500');
            document.getElementById('btn-daftar').classList.remove('border-pink-500', 'text-pink-600', 'font-bold');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const siswaSelect = document.getElementById('siswa-select');
        const scoresSection = document.getElementById('scores-section');
        const photoSection = document.getElementById('photo-section');
        const fotoInput = document.getElementById('foto-input');

        if (siswaSelect) {
            siswaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const kelas = selectedOption.getAttribute('data-kelas');

                if (kelas === 'Toddler' || kelas === 'Nursery') {
                    scoresSection.classList.remove('hidden');
                    scoresSection.querySelectorAll('input').forEach(el => el.removeAttribute('disabled'));
                    photoSection.classList.add('hidden');
                    fotoInput.setAttribute('disabled', 'true');
                    fotoInput.value = '';
                } else if (kelas === 'Baby Class') {
                    photoSection.classList.remove('hidden');
                    fotoInput.removeAttribute('disabled');
                    scoresSection.classList.add('hidden');
                    scoresSection.querySelectorAll('input').forEach(el => {
                        el.setAttribute('disabled', 'true');
                        el.value = '';
                    });
                } else {
                    scoresSection.classList.add('hidden');
                    scoresSection.querySelectorAll('input').forEach(el => el.setAttribute('disabled', 'true'));
                    photoSection.classList.add('hidden');
                    fotoInput.setAttribute('disabled', 'true');
                }
            });
        }
    });
</script>
@endsection