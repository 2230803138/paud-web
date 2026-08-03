@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">
        <h1 class="text-4xl font-bold">Edit Laporan Perkembangan</h1>
        <p class="mt-3 text-pink-100">Perbarui catatan perkembangan anak didik Anda.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6 max-w-2xl">
        @if($errors->any())
            <div class="bg-red-100 border border-red-350 text-red-700 px-5 py-4 rounded-2xl mb-4">
                <ul class="list-disc pl-5 space-y-1 text-sm font-semibold">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('guru.perkembangan.update', $laporan->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Siswa</label>
                <select name="siswa_id" id="siswa-select" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 bg-gray-50 focus:ring-pink-500 focus:border-pink-500">
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}" {{ $laporan->siswa_id == $s->id ? 'selected' : '' }} data-kelas="{{ $s->kelas }}">
                            {{ $s->nama }} (Kelas: {{ $s->kelas ?? '-' }})
                        </option>
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
                            <input type="number" name="{{ $name }}" min="0" max="100" placeholder="Skor (0-100)" value="{{ $laporan->$name }}" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-pink-500 focus:border-pink-500">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Foto (Baby Class) -->
            <div id="photo-section" class="hidden bg-purple-50/50 p-6 rounded-2xl border border-purple-100/50 space-y-2">
                <h3 class="font-bold text-purple-700 text-sm mb-2">📷 Foto Kegiatan Harian (Baby Class)</h3>
                @if($laporan->foto)
                    <div class="mb-3">
                        <p class="text-xs font-bold text-gray-500 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset($laporan->foto) }}" class="w-32 h-32 object-cover rounded-2xl border border-gray-250 shadow-sm">
                    </div>
                @endif
                <label class="block text-xs font-bold text-gray-600 mb-1">Pilih Foto Baru (Lewati jika tidak ingin mengganti)</label>
                <input type="file" name="foto" id="foto-input" accept="image/*" class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:ring-purple-500 focus:border-purple-500">
                <p class="text-[10px] text-gray-500">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Laporan</label>
                <input type="date" name="tanggal" value="{{ $laporan->tanggal }}" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Catatan / Laporan Perkembangan</label>
                <textarea name="catatan" required rows="5" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500">{{ $laporan->catatan }}</textarea>
            </div>

            <div class="pt-2 flex gap-3">
                <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-500 hover:opacity-90 text-white font-bold px-8 py-3 rounded-xl shadow-md transition duration-200">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('guru.perkembangan') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-6 py-3 rounded-xl transition duration-200 flex items-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const siswaSelect = document.getElementById('siswa-select');
        const scoresSection = document.getElementById('scores-section');
        const photoSection = document.getElementById('photo-section');
        const fotoInput = document.getElementById('foto-input');

        function updateFormVisibility() {
            if (!siswaSelect) return;
            const selectedOption = siswaSelect.options[siswaSelect.selectedIndex];
            const kelas = selectedOption.getAttribute('data-kelas');

            if (kelas === 'Toddler' || kelas === 'Nursery') {
                scoresSection.classList.remove('hidden');
                scoresSection.querySelectorAll('input').forEach(el => el.removeAttribute('disabled'));
                photoSection.classList.add('hidden');
                if (fotoInput) fotoInput.setAttribute('disabled', 'true');
            } else if (kelas === 'Baby Class') {
                photoSection.classList.remove('hidden');
                if (fotoInput) fotoInput.removeAttribute('disabled');
                scoresSection.classList.add('hidden');
                scoresSection.querySelectorAll('input').forEach(el => el.setAttribute('disabled', 'true'));
            } else {
                scoresSection.classList.add('hidden');
                scoresSection.querySelectorAll('input').forEach(el => el.setAttribute('disabled', 'true'));
                photoSection.classList.add('hidden');
                if (fotoInput) fotoInput.setAttribute('disabled', 'true');
            }
        }

        if (siswaSelect) {
            siswaSelect.addEventListener('change', function() {
                updateFormVisibility();
                // Clear inputs on change
                const selectedOption = this.options[this.selectedIndex];
                const kelas = selectedOption.getAttribute('data-kelas');
                if (kelas === 'Toddler' || kelas === 'Nursery') {
                    if (fotoInput) fotoInput.value = '';
                } else if (kelas === 'Baby Class') {
                    scoresSection.querySelectorAll('input').forEach(el => el.value = '');
                }
            });
            // Initial call
            updateFormVisibility();
        }
    });
</script>
@endsection
