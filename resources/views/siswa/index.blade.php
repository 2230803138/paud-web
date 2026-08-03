@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                Data Peserta Didik
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola seluruh data peserta didik Ebony Preschool.
            </p>
        </div>

        <a href="{{ route('siswa.create') }}"
            class="bg-gradient-to-r from-pink-500 to-purple-500 text-white px-6 py-3 rounded-xl font-semibold shadow hover:scale-105 duration-200">

            + Tambah Siswa

        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pencarian -->
    <div class="mb-6">
        <input
            type="text"
            id="searchInput"
            placeholder="Cari nama siswa..."
            class="w-full md:w-96 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-400 outline-none">
    </div>

    <div class="overflow-x-auto">

        <table class="w-full" id="tabelSiswa">

            <thead class="bg-pink-50">

                <tr>

                    <th class="p-4 text-center">No</th>
                    <th class="p-4 text-left">Nama Anak</th>
                    <th class="p-4 text-center">Kelas</th>
                    <th class="p-4 text-left">Nama Orang Tua</th>
                    <th class="p-4 text-left">Akun Orang Tua</th>
                    <th class="p-4 text-center">No HP</th>
                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($siswa as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4 nama">
                        {{ $item->nama }}
                    </td>

                    <td class="p-4 text-center">
                        {{ $item->kelas }}
                    </td>

                    <td class="p-4">
                        {{ $item->nama_orangtua }}
                    </td>

                    <td class="p-4">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    <td class="p-4 text-center">
                        {{ $item->no_hp }}
                    </td>

                    <td class="p-4 text-center">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('siswa.edit',$item->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">

                                Edit

                            </a>

                            <form action="{{ route('siswa.destroy',$item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-8 text-gray-500">

                        Belum ada data siswa.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();

    let rows = document.querySelectorAll('#tabelSiswa tbody tr');

    rows.forEach(function(row){

        let nama = row.querySelector('.nama');

        if(!nama) return;

        if(nama.innerText.toLowerCase().includes(keyword)){
            row.style.display = '';
        }else{
            row.style.display = 'none';
        }

    });

});
</script>

@endsection