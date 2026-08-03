@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">
                Data Jadwal
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola jadwal kegiatan Ebony Preschool.
            </p>

        </div>

        <a href="{{ route('jadwal.create') }}"
            class="bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:scale-105 duration-200">

            + Tambah Jadwal

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>

    @endif

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-pink-50">

                <tr>

                    <th class="p-4">No</th>
                    <th class="p-4">Kelas</th>
                    <th class="p-4">Kegiatan</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Jam</th>
                    <th class="p-4">Keterangan</th>
                    <th class="p-4">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($jadwal as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4">
                        {{ $item->kelas }}
                    </td>

                    <td class="p-4">
                        {{ $item->kegiatan }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>

                    <td class="p-4">
                        {{ $item->jam }}
                    </td>

                    <td class="p-4">
                        {{ $item->keterangan }}
                    </td>

                    <td class="p-4">

                        <div class="flex gap-2">

                            <a href="{{ route('jadwal.edit',$item->id) }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg">

                                Edit

                            </a>

                            <form action="{{ route('jadwal.destroy',$item->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-8 text-gray-500">

                        Belum ada jadwal.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection