@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <h1 class="text-3xl font-bold mb-6">
        Edit Jadwal
    </h1>

    <form action="{{ route('jadwal.update',$jadwal->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">
                    Kelas
                </label>

                <select
                    name="kelas"
                    class="w-full border rounded-xl p-3 mt-2">

                    <option value="Baby Class" {{ $jadwal->kelas=='Baby Class' ? 'selected' : '' }}>
                        Baby Class
                    </option>

                    <option value="Toddler" {{ $jadwal->kelas=='Toddler' ? 'selected' : '' }}>
                        Toddler
                    </option>

                    <option value="Nursery" {{ $jadwal->kelas=='Nursery' ? 'selected' : '' }}>
                        Nursery
                    </option>

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    Kegiatan
                </label>

                <input
                    type="text"
                    name="kegiatan"
                    value="{{ $jadwal->kegiatan }}"
                    class="w-full border rounded-xl p-3 mt-2">

            </div>

            <div>

                <label class="font-semibold">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ $jadwal->tanggal }}"
                    class="w-full border rounded-xl p-3 mt-2">

            </div>

            <div>

                <label class="font-semibold">
                    Jam
                </label>

                <input
                    type="time"
                    name="jam"
                    value="{{ $jadwal->jam }}"
                    class="w-full border rounded-xl p-3 mt-2">

            </div>

        </div>

        <div class="mt-6">

            <label class="font-semibold">
                Keterangan
            </label>

            <textarea
                name="keterangan"
                rows="4"
                class="w-full border rounded-xl p-3 mt-2">{{ $jadwal->keterangan }}</textarea>

        </div>

        <button
            class="mt-8 bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-xl">

            Update Jadwal

        </button>

    </form>

</div>

@endsection