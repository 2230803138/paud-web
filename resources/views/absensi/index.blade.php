@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                Data Absensi
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola data absensi siswa Ebony Preschool.
            </p>
        </div>

        <a href="{{ route('absensi.create') }}"
            class="bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:scale-105 duration-200">

            + Tambah Absensi

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

                    <th class="p-4 text-center">No</th>
                    <th class="p-4 text-left">Nama Siswa</th>
                    <th class="p-4 text-center">Kelas</th>
                    <th class="p-4 text-center">Tanggal</th>
                    <th class="p-4 text-center">Status</th>
                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4">
                        {{ $item->siswa->nama }}
                    </td>

                    <td class="p-4 text-center">
                        {{ $item->siswa->kelas }}
                    </td>

                    <td class="p-4 text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>

                   <td class="p-4 text-center">

                    @php
                        $status = strtolower($item->status);
                    @endphp

                    @if($status == 'hadir')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">
                            Hadir
                        </span>

                    @elseif($status == 'izin')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-semibold">
                            Izin
                        </span>

                    @elseif($status == 'sakit')

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">
                            Sakit
                        </span>

                    @elseif($status == 'alfa')

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-semibold">
                            Alfa
                        </span>

                    @else

                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full font-semibold">
                            {{ $item->status }}
                        </span>

                    @endif

                </td>
                                    <td class="p-4 text-center">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('absensi.show',$item->id) }}"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg">

                                                Lihat

                                            </a>

                            <a href="{{ route('absensi.edit',$item->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

                                Edit

                            </a>

                            <form action="{{ route('absensi.destroy',$item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-8 text-gray-500">

                        Belum ada data absensi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection