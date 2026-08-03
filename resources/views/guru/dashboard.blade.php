@extends('layouts.guru')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-3xl p-8 shadow-xl text-white">

        <h1 class="text-4xl font-bold">
            Dashboard Guru
        </h1>

        <p class="mt-3 text-pink-100">
            Selamat datang,
            <strong>{{ Auth::user()->name }}</strong>
        </p>

        <p class="mt-2 text-pink-100">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>

    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Status -->
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h2 class="text-gray-500">
                Status Absensi Hari Ini
            </h2>

            <h1 class="text-3xl font-bold mt-3 {{ $absensiHariIni ? 'text-green-600' : 'text-red-500' }}">

                {{ $absensiHariIni->status ?? 'Belum Absen' }}

            </h1>

        </div>

        <!-- Jam Masuk -->
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h2 class="text-gray-500">
                Jam Masuk
            </h2>

            <h1 class="text-3xl font-bold mt-3 text-blue-600">

                {{ $absensiHariIni->jam_masuk ?? '-' }}

            </h1>

        </div>

        <!-- Jam Pulang -->
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h2 class="text-gray-500">
                Jam Pulang
            </h2>

            <h1 class="text-3xl font-bold mt-3 text-purple-600">

                {{ $absensiHariIni->jam_pulang ?? '-' }}

            </h1>

        </div>

    </div>

    <!-- Tombol Absensi -->
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6">
            Absensi Guru
        </h2>

        <div class="flex flex-wrap gap-4">

            {{-- Absen Masuk --}}
            @if(!$absensiHariIni)

                <form action="{{ route('guru.absen.masuk') }}" method="POST">
                    @csrf

                    <button
                        class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-xl font-bold">

                        ✅ Absen Masuk

                    </button>

                </form>

            @else

                <button
                    disabled
                    class="bg-gray-400 text-white px-8 py-3 rounded-xl cursor-not-allowed">

                    ✔ Sudah Absen Masuk

                </button>

            @endif


            {{-- Absen Pulang --}}
            @if($absensiHariIni && !$absensiHariIni->jam_pulang)

                <form action="{{ route('guru.absen.pulang') }}" method="POST">
                    @csrf

                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-xl font-bold">

                        🚪 Absen Pulang

                    </button>

                </form>

            @elseif($absensiHariIni && $absensiHariIni->jam_pulang)

                <button
                    disabled
                    class="bg-gray-400 text-white px-8 py-3 rounded-xl cursor-not-allowed">

                    ✔ Sudah Absen Pulang

                </button>

            @endif

        </div>

    </div>

</div>

@endsection