@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <h1 class="text-3xl font-bold mb-6">
        Tambah Jadwal
    </h1>

    <form action="{{ route('jadwal.store') }}" method="POST">

        @csrf

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold">Kelas</label>

                <select name="kelas"
                    class="w-full border rounded-xl p-3 mt-2"
                    required>

                    <option value="">-- Pilih Kelas --</option>
                    <option value="Baby Class">Baby Class</option>
                    <option value="Toddler">Toddler</option>
                    <option value="Nursery">Nursery</option>

                </select>
            </div>

            <div>
                <label class="font-semibold">Kegiatan</label>

                <input
                    type="text"
                    name="kegiatan"
                    class="w-full border rounded-xl p-3 mt-2"
                    required>
            </div>

            <div>
                <label class="font-semibold">Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    class="w-full border rounded-xl p-3 mt-2"
                    required>
            </div>

            <div>
                <label class="font-semibold">Jam</label>

                <input
                    type="time"
                    name="jam"
                    class="w-full border rounded-xl p-3 mt-2"
                    required>
            </div>

        </div>

        <div class="mt-6">

            <label class="font-semibold">
                Keterangan
            </label>

            <textarea
                name="keterangan"
                rows="4"
                class="w-full border rounded-xl p-3 mt-2"></textarea>

        </div>

        <button
            class="mt-8 bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-xl">

            Simpan Jadwal

        </button>

    </form>

</div>

@endsection