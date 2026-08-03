@extends('layouts.app')

@section('title','Data Kelas')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-700">
                Data Kelas
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola data kelas siswa Ebony Preschool
            </p>
        </div>

        <a href="{{ route('kelas.create') }}"
            class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-3 rounded-xl shadow">

            + Tambah Kelas

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5">
            {{ session('success') }}
        </div>

    @endif

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-pink-500 text-white">

                <tr>

                    <th class="p-4">No</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelas</th>
                    <th>Tanggal Lahir</th>
                    <th>Nama Orang Tua</th>
                    <th>No HP</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($kelas as $item)

                <tr class="border-b hover:bg-pink-50">

                    <td class="p-4">{{ $loop->iteration }}</td>

                    <td>{{ $item->siswa->nama }}</td>

                    <td>

                        <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full">

                            {{ $item->jenis_kelas }}

                        </span>

                    </td>

                    <td>{{ $item->siswa->tanggal_lahir }}</td>

                    <td>{{ $item->siswa->nama_orangtua }}</td>

                    <td>{{ $item->siswa->no_hp }}</td>

                    <td>

                        <div class="flex gap-2">

                            <a href="{{ route('kelas.edit',$item->id) }}"
                                class="bg-yellow-400 px-3 py-2 rounded-lg text-white">

                                Edit

                            </a>

                            <form action="{{ route('kelas.destroy',$item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus data ini?')"
                                    class="bg-red-500 px-3 py-2 rounded-lg text-white">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-10 text-gray-500">

                        Belum ada data kelas

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection