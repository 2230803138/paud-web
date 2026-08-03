@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-8">

            Edit Informasi

        </h1>

        <form action="{{ route('informasi.update',$informasi->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="font-semibold block mb-2">

                    Judul Informasi

                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul',$informasi->judul) }}"
                    class="w-full border rounded-xl px-4 py-3"
                    required>

            </div>

            <div class="mb-5">

                <label class="font-semibold block mb-2">

                    Isi Informasi

                </label>

                <textarea
                    name="isi"
                    rows="6"
                    class="w-full border rounded-xl px-4 py-3"
                    required>{{ old('isi',$informasi->isi) }}</textarea>

            </div>

            <div class="grid grid-cols-2 gap-5">

                <div>

                    <label class="font-semibold block mb-2">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal',$informasi->tanggal) }}"
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

                        <option value="Dipublikasikan"
                            {{ $informasi->status=='Dipublikasikan' ? 'selected' : '' }}>
                            Dipublikasikan
                        </option>

                        <option value="Draft"
                            {{ $informasi->status=='Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl">

                    Update

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