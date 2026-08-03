@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-8">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                Informasi Sekolah
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola seluruh informasi dan pengumuman sekolah.
            </p>
        </div>

        <a href="{{ route('informasi.create') }}"
            class="bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:scale-105 duration-200">

            + Tambah Informasi

        </a>

    </div>

    @if(session('success'))

    <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-xl">

        {{ session('success') }}

    </div>

    @endif

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-pink-50">

                <tr>

                    <th class="p-4 text-left">No</th>

                    <th class="p-4 text-left">Judul Informasi</th>

                    <th class="p-4 text-left">Tanggal</th>

                    <th class="p-4 text-left">Status</th>

                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($informasi as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4">
                        {{ $item->judul }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>

                    <td class="p-4">

                        @if($item->status == 'Dipublikasikan')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                            Dipublikasikan

                        </span>

                        @else

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                            Draft

                        </span>

                        @endif

                    </td>

                    <td class="p-4 text-center">

                        <a href="{{ route('informasi.edit',$item->id) }}"
                            class="bg-blue-500 text-white px-3 py-2 rounded-lg">

                            Edit

                        </a>

                        <form action="{{ route('informasi.destroy',$item->id) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin ingin menghapus informasi ini?')"
                                class="bg-red-500 text-white px-3 py-2 rounded-lg">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-8 text-gray-500">

                        Belum ada informasi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection