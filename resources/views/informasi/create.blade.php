@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-8">
            Tambah Informasi
        </h1>

        <form action="{{ route('informasi.store') }}" method="POST">

            @csrf

            <div class="mb-5">
                <label class="font-semibold block mb-2">
                    Judul Informasi
                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400"
                    required>
            </div>

            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    Isi Informasi
                </label>

                <textarea
                    name="isi"
                    rows="6"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400"
                    required>{{ old('isi') }}</textarea>

            </div>

            <div class="grid grid-cols-2 gap-5">

                <div>

                    <label class="font-semibold block mb-2">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal') }}"
                        class="w-full border rounded-xl px-4 py-3"
                        required>

                </div>

                <div>

                    <label class="font-semibold block mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-xl px-4 py-3"
                        required>

                        <option value="">-- Pilih Status --</option>
                        <option value="Dipublikasikan">Dipublikasikan</option>
                        <option value="Draft">Draft</option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex gap-3">

                <button
                    type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-xl">

                    Simpan

                </button>

                <a
                    href="{{ route('informasi.index') }}"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-xl">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection