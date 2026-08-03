@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">
        <h1 class="text-4xl font-bold">Profil Guru</h1>
        <p class="mt-3 text-pink-100">Kelola dan perbarui data profil Anda di Ebony Preschool.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Detail Profil -->
        <div class="bg-white rounded-3xl shadow-lg p-6 lg:col-span-1 flex flex-col items-center text-center">
            <!-- Profile Icon / Placeholder -->
            <div class="w-32 h-32 bg-pink-100 rounded-full flex items-center justify-center text-4xl mb-4 text-pink-500 font-bold border-4 border-pink-200">
                {{ substr($guru->nama ?? 'G', 0, 1) }}
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800">{{ $guru->nama ?? 'Guru Ebony' }}</h2>
            <p class="text-pink-600 font-semibold mt-1">{{ ucwords($guru->jabatan ?? 'Guru') }}</p>
            <span class="mt-3 bg-purple-50 text-purple-700 px-4 py-1.5 rounded-full font-bold text-sm">
                NIP: {{ $guru->nip ?? '-' }}
            </span>

            <div class="w-full border-t border-gray-100 my-6"></div>

            <div class="w-full text-left space-y-4">
                <div>
                    <span class="text-xs font-semibold text-gray-400 block uppercase">Jenis Kelamin</span>
                    <span class="text-gray-700 font-medium">{{ $guru->jenis_kelamin ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-gray-400 block uppercase">Email</span>
                    <span class="text-gray-700 font-medium">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>

        <!-- Form Update Data -->
        <div class="bg-white rounded-3xl shadow-lg p-6 lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Pembaruan Kontak & Alamat</h2>

            <form method="POST" action="{{ route('guru.profil.update') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nomor Handphone (WhatsApp)</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $guru->no_hp ?? '') }}" required 
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Contoh: 08123456789">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat Tinggal</label>
                    <textarea name="alamat" required rows="4" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-pink-500 focus:border-pink-500"
                        placeholder="Tuliskan alamat lengkap tinggal saat ini...">{{ old('alamat', $guru->alamat ?? '') }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6 flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-500 hover:opacity-90 text-white font-bold px-8 py-3 rounded-xl shadow-lg transition duration-200">
                        💾 Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection