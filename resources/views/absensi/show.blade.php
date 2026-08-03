@extends('layouts.app')

@section('content')


<div class="max-w-3xl mx-auto">


<div class="bg-white rounded-3xl shadow-lg p-8">


<h1 class="text-3xl font-bold mb-8">
Detail Absensi
</h1>



<div class="space-y-5">


<div>
<p class="text-gray-500">
Nama Siswa
</p>

<p class="font-semibold text-lg">
{{ $absensi->siswa->nama }}
</p>
</div>



<div>
<p class="text-gray-500">
Kelas
</p>

<p class="font-semibold text-lg">
{{ $absensi->siswa->kelas }}
</p>
</div>



<div>
<p class="text-gray-500">
Tanggal
</p>

<p class="font-semibold text-lg">

{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}

</p>

</div>



<div>

<p class="text-gray-500">
Status Kehadiran
</p>


@if($absensi->status=='hadir')

<span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
Hadir
</span>


@elseif($absensi->status=='izin')

<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
Izin
</span>


@elseif($absensi->status=='sakit')

<span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
Sakit
</span>


@else

<span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">
Alfa
</span>


@endif


</div>


</div>



<div class="mt-8">

<a href="{{ route('absensi.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

Kembali

</a>

</div>



</div>


</div>


@endsection