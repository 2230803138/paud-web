@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Pesan sukses --}}
    @if(session('success'))

    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">

        {{ session('success') }}

    </div>

    @endif

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-6 flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold text-white">

                    Data Guru

                </h1>

                <p class="text-pink-100 mt-2">

                    Kelola data guru Ebony Preschool

                </p>

            </div>

            <a href="{{ route('guru.create') }}"
                class="bg-white text-pink-500 px-5 py-3 rounded-xl font-bold shadow hover:bg-pink-50">

                + Tambah Guru

            </a>

        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

            <div class="bg-pink-500 rounded-2xl p-5 text-white shadow">

                <h2 class="text-lg">

                    Total Guru

                </h2>

                <h1 class="text-4xl font-bold mt-2">

                    {{ $guru->count() }}

                </h1>

            </div>

        </div>

        {{-- Tabel --}}
        <div class="p-6 overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-pink-100 text-pink-700">

                        <th class="p-4 text-center">No</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">NIP</th>
                        <th class="p-4 text-left">Jenis Kelamin</th>
                        <th class="p-4 text-left">Jabatan</th>
                        <th class="p-4 text-left">No HP</th>
                        <th class="p-4 text-left">Alamat</th>
                        <th class="p-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($guru as $item)

                    <tr class="border-b hover:bg-pink-50">

                        <td class="p-4 text-center">

                            {{ $loop->iteration }}

                        </td>

                        <td class="p-4 font-semibold">

                            {{ $item->nama }}

                        </td>

                        <td class="p-4">

                            {{ optional($item->user)->email ?? '-' }}

                        </td>

                        <td class="p-4">

                            {{ $item->nip }}

                        </td>

                        <td class="p-4">

                            {{ $item->jenis_kelamin }}

                        </td>

                        <td class="p-4">

                            {{ $item->jabatan }}

                        </td>

                        <td class="p-4">

                            {{ $item->no_hp }}

                        </td>

                        <td class="p-4">

                            {{ $item->alamat }}

                        </td>

                        <td class="p-4">

                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('guru.edit', $item->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                                    Edit

                                </a>

                                <form action="{{ route('guru.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="9" class="text-center py-10 text-gray-500">

                            Belum ada data guru.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection