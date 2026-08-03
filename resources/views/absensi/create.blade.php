@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">


    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">
                Tambah Absensi
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola data kehadiran peserta didik Ebony Preschool.
            </p>

        </div>


    </div>



    <form action="{{ route('absensi.store') }}" method="POST">

        @csrf


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


            <div>

                <label class="block font-semibold mb-2">
                    Nama Siswa
                </label>


                <select
                    name="siswa_id"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400"
                    required>


                    <option value="">
                        -- Pilih Siswa --
                    </option>


                    @foreach($siswa as $item)

                    <option value="{{ $item->id }}">

                        {{ $item->nama }}

                    </option>

                    @endforeach


                </select>

            </div>




            <div>

                <label class="block font-semibold mb-2">
                    Tanggal
                </label>


                <input
                    type="date"
                    name="tanggal"
                    value="{{ date('Y-m-d') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400"
                    required>

            </div>



            <div>

                <label class="block font-semibold mb-2">
                    Status Kehadiran
                </label>


                <select
                    name="status"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400"
                    required>


                    <option value="">
                        -- Pilih Status --
                    </option>


                    <option value="hadir">
                        Hadir
                    </option>


                    <option value="izin">
                        Izin
                    </option>


                    <option value="sakit">
                        Sakit
                    </option>


                    <option value="alfa">
                        Alfa
                    </option>


                </select>

            </div>


        </div>



        <div class="mt-8 flex gap-3">


            <button
                type="submit"
                class="bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:scale-105 duration-200">

                Simpan

            </button>



            <a href="{{ route('absensi.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold">

                Kembali

            </a>


        </div>



    </form>


</div>


@endsection