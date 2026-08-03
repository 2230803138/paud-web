@extends('layouts.app')

@section('title', 'Edit Data Kelas')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow-xl p-8">

        <div class="mb-8">

            <h2 class="text-3xl font-bold text-yellow-500">
                Edit Data Kelas
            </h2>

            <p class="text-gray-500 mt-2">
                Ubah data kelas siswa Ebony Preschool.
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

        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">

            @csrf
            @method('PUT')

            <!-- Nama Siswa -->
            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Nama Siswa
                </label>

                <select
                    name="siswa_id"
                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-pink-400"
                    required>

                    @foreach($siswa as $item)

                        <option value="{{ $item->id }}"
                            {{ $kelas->siswa_id == $item->id ? 'selected' : '' }}>

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
                    class="w-full border rounded-2xl px-5 py-3"
                    required>

                    <option value="Baby Class"
                        {{ $kelas->jenis_kelas == 'Baby Class' ? 'selected' : '' }}>
                        Baby Class
                    </option>

                    <option value="Toddler"
                        {{ $kelas->jenis_kelas == 'Toddler' ? 'selected' : '' }}>
                        Toddler
                    </option>

                    <option value="Nursery"
                        {{ $kelas->jenis_kelas == 'Nursery' ? 'selected' : '' }}>
                        Nursery
                    </option>

                </select>

            </div>

            <div class="flex justify-between mt-8">

                <a href="{{ route('kelas.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                    ← Kembali

                </a>

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-xl shadow-lg">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection