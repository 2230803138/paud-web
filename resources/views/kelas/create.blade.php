@extends('layouts.app')

@section('title', 'Tambah Data Kelas')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow-xl p-8">

        <div class="mb-8">

            <h2 class="text-3xl font-bold text-pink-600">
                Tambah Data Kelas
            </h2>

            <p class="text-gray-500 mt-2">
                Silakan pilih siswa dan kelas yang akan ditempatkan.
            </p>

        </div>

        @if ($errors->any())

            <div class="bg-red-100 text-red-700 rounded-xl p-4 mb-6">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('kelas.store') }}" method="POST">

            @csrf

            <!-- Nama Siswa -->
            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Nama Siswa
                </label>

                <select
                    name="siswa_id"
                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-pink-400"
                    required>

                    <option value="">-- Pilih Siswa --</option>

                    @foreach($siswa as $item)

                        <option value="{{ $item->id }}">

                            {{ $item->nama }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- Jenis Kelas -->
            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Jenis Kelas
                </label>

                <select
                    name="jenis_kelas"
                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-pink-400"
                    required>

                    <option value="">-- Pilih Kelas --</option>

                    <option value="Baby Class">Baby Class</option>

                    <option value="Toddler">Toddler</option>

                    <option value="Nursery">Nursery</option>

                </select>

            </div>

            <div class="flex justify-between mt-8">

                <a href="{{ route('kelas.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                    ← Kembali

                </a>

                <button
                    type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-xl shadow-lg">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection