@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-3xl p-10 mt-10">

    <h1 class="text-4xl font-bold text-pink-600 mb-8 text-center">
        Form Data Siswa PAUD
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">

        @csrf

        <!-- NAMA -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Nama Anak
            </label>

            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>
        </div>

        <!-- JENIS KELAMIN -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Jenis Kelamin
            </label>

            <select
                name="jenis_kelamin"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>

                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>

            </select>
        </div>

        <!-- TANGGAL LAHIR -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Tanggal Lahir
            </label>

            <input
                type="date"
                name="tanggal_lahir"
                value="{{ old('tanggal_lahir') }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>
        </div>

        <!-- KELAS -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Kelas
            </label>

            <select
                name="kelas"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>

                <option value="">-- Pilih Kelas --</option>
                <option value="Baby Class">Baby Class</option>
                <option value="Toddler">Toddler</option>
                <option value="Nursery">Nursery</option>

            </select>
        </div>

        <!-- ALAMAT -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="4"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>{{ old('alamat') }}</textarea>
        </div>

        <!-- NAMA ORANG TUA -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Nama Orang Tua
            </label>

            <input
                type="text"
                name="nama_orangtua"
                value="{{ old('nama_orangtua') }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>
        </div>

        <!-- NO HP -->
        <div class="mb-5">
            <label class="block mb-2 font-semibold text-gray-700">
                Nomor HP
            </label>

            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>
        </div>

        <!-- AKUN ORANG TUA -->
        <div class="mb-8">
            <label class="block mb-2 font-semibold text-gray-700">
                Akun Orang Tua
            </label>

            <select
                name="user_id"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                required>

                <option value="">-- Pilih Akun Orang Tua --</option>

                @foreach($orangtua as $ortu)
                    <option value="{{ $ortu->id }}">
                        {{ $ortu->name }} ({{ $ortu->email }})
                    </option>
                @endforeach

            </select>
        </div>

        <button
            type="submit"
            class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-semibold shadow-lg transition duration-300">

            Simpan Data Siswa

        </button>

    </form>

</div>

@endsection