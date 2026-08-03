@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8">

    <h1 class="text-3xl font-bold text-pink-600 mb-6">
        Edit Laporan Anak
    </h1>

    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="font-semibold">
                Nama Anak
            </label>

            <select name="siswa_id"
                class="w-full border rounded-lg px-4 py-2 mt-2">

                @foreach($siswa as $item)

                <option value="{{ $item->id }}" {{ $laporan->siswa_id == $item->id ? 'selected' : '' }}>
                    {{ $item->nama }}
                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="font-semibold">
                Tanggal
            </label>

            <input type="date"
                name="tanggal"
                value="{{ $laporan->tanggal }}"
                class="w-full border rounded-lg px-4 py-2 mt-2">

        </div>

        <div class="mb-4">

            <label class="font-semibold">
                Perkembangan Anak
            </label>

            <textarea name="perkembangan"
                class="w-full border rounded-lg px-4 py-2 mt-2">{{ $laporan->perkembangan }}</textarea>

        </div>

        <div class="mb-6">

            <label class="font-semibold">
                Catatan Guru
            </label>

            <textarea name="catatan"
                class="w-full border rounded-lg px-4 py-2 mt-2">{{ $laporan->catatan }}</textarea>

        </div>

        <div class="flex gap-3">
            <a href="/laporan" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-300">
                Batal
            </a>
            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-xl">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection
