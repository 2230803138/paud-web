@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('guru.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-pink-600 transition">
            ← Kembali ke Daftar Guru
        </a>
    </div>

    <!-- Alert Error Validation -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-6 shadow-sm">
            <div class="flex items-center gap-2 mb-2 font-bold text-sm">
                ⚠️ Harap perbaiki kesalahan berikut:
            </div>
            <ul class="list-disc list-inside text-xs space-y-1 font-medium text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-soft border border-gray-100 overflow-hidden">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-8 text-white">
            <h3 class="text-xl font-bold">Formulir Tambah Guru Baru</h3>
            <p class="text-pink-100 text-sm mt-1">Lengkapi informasi di bawah ini untuk menambahkan guru baru ke dalam sistem.</p>
        </div>

        <form action="{{ route('guru.store') }}" method="POST" class="p-8 space-y-8">
            @csrf

            <!-- Section 1: Informasi Akun Login -->
            <div>
                <h4 class="text-sm font-bold text-pink-600 uppercase tracking-wider mb-4 pb-2 border-b border-pink-50">
                    🔐 Informasi Kredensial Login
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Email Login</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="nama.guru@gmail.com">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Password Login</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="Minimal 6 karakter">
                    </div>
                </div>
            </div>

            <!-- Section 2: Biodata Guru -->
            <div>
                <h4 class="text-sm font-bold text-pink-600 uppercase tracking-wider mb-4 pb-2 border-b border-pink-50">
                    👤 Informasi Profil & Biodata
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="Nama lengkap beserta gelar">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">NIP / Nomor Identitas Pegawai</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="Contoh: 19850312xxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Jabatan / Wali Kelas</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="Contoh: Wali Kelas Toddler">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Nomor HP (WhatsApp)</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="Contoh: 08xxxxxxxxxx">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Alamat Tempat Tinggal</label>
                        <textarea name="alamat" rows="3" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('guru.index') }}" 
                    class="px-6 py-3 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition text-sm font-bold">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold text-sm shadow-lg shadow-pink-500/25 hover:shadow-pink-500/35 transition">
                    Simpan Data Guru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection