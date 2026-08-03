@extends('layouts.orangtua')

@section('title', 'Ulasan Guru')

@section('content')

<div class="grid lg:grid-cols-12 gap-8">

    <!-- Form Kirim Ulasan (Left / Col-12 on Mobile, Col-5 on Desktop) -->
    <div class="lg:col-span-5 bg-white rounded-3xl shadow-xl p-8 h-fit">
        <h2 class="text-2xl font-bold text-pink-600 mb-6">
            Kirim Ulasan Guru
        </h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-2xl mb-6 text-sm font-bold">
                🎉 {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6 text-sm font-bold">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6 text-sm">
                <ul class="list-disc list-inside font-semibold">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orangtua.ulasan.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block font-bold text-gray-700 text-sm mb-2">
                    Pilih Guru / Miss
                </label>
                <select name="guru_id" required
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-700">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }} ({{ $guru->jabatan }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-gray-700 text-sm mb-2">
                    Tulis Ulasan / Masukan
                </label>
                <textarea name="ulasan" rows="5" required
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm text-gray-850 placeholder-gray-400"
                    placeholder="Tuliskan ulasan Anda mengenai guru ini (misal: Miss Syifa rajin mengajar dan sabar mendampingi anak...)"></textarea>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:opacity-95 text-white font-extrabold py-3.5 rounded-2xl shadow-lg shadow-pink-500/25 transition duration-200 text-sm tracking-wide">
                Kirim Ulasan
            </button>
        </form>
    </div>

    <!-- Riwayat Ulasan (Right / Col-12 on Mobile, Col-7 on Desktop) -->
    <div class="lg:col-span-7 bg-white rounded-3xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-pink-600 mb-6">
            Riwayat Ulasan Anda
        </h2>

        @if($ulasans->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-pink-100">
                        <tr>
                            <th class="p-4 rounded-l-2xl text-slate-700 text-sm font-extrabold text-center">No</th>
                            <th class="p-4 text-slate-700 text-sm font-extrabold text-left">Nama Guru</th>
                            <th class="p-4 text-slate-700 text-sm font-extrabold text-left">Tanggal</th>
                            <th class="p-4 rounded-r-2xl text-slate-700 text-sm font-extrabold text-left">Isi Ulasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ulasans as $item)
                            <tr class="border-b hover:bg-pink-50/50 transition">
                                <td class="p-4 text-center text-sm font-medium text-slate-650">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-4 text-sm font-bold text-slate-800">
                                    {{ $item->guru?->nama ?? 'Guru Tidak Ditemukan' }}
                                </td>
                                <td class="p-4 text-sm font-medium text-slate-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </td>
                                <td class="p-4 text-sm text-slate-600 leading-relaxed font-medium min-w-[200px]">
                                    {{ $item->ulasan }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-100 text-yellow-700 rounded-2xl p-5 text-sm font-medium">
                💡 Anda belum pernah mengirimkan ulasan untuk guru. Silakan isi form di samping untuk mengirimkan ulasan pertama Anda.
            </div>
        @endif
    </div>

</div>

@endsection
