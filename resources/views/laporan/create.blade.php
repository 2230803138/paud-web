@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8">

    <h1 class="text-3xl font-bold text-pink-600 mb-6">
        Tambah Laporan Anak
    </h1>

    <form action="{{ route('laporan.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="font-semibold">
                Nama Anak
            </label>

            <select name="siswa_id"
                class="w-full border rounded-lg px-4 py-2 mt-2">

                @foreach($siswa as $item)

                <option value="{{ $item->id }}">
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
                class="w-full border rounded-lg px-4 py-2 mt-2">

        </div>

        <div class="mb-4">

            <label class="font-semibold">
                Perkembangan Anak
            </label>

            <textarea name="perkembangan"
                class="w-full border rounded-lg px-4 py-2 mt-2"></textarea>

        </div>

        <div class="mb-6">

            <label class="font-semibold">
                Catatan Guru
            </label>

            <textarea name="catatan"
                class="w-full border rounded-lg px-4 py-2 mt-2"></textarea>

        </div>

        <button type="submit"
            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-xl">

            Simpan

        </button>

    </form>

</div>

@endsection