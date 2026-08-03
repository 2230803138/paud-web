@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

<div class="bg-white rounded-3xl shadow-lg p-8">


<h1 class="text-3xl font-bold mb-2">
    Edit Absensi
</h1>

<p class="text-gray-500 mb-8">
    Perbarui data kehadiran siswa.
</p>



<form action="{{ route('absensi.update',$absensi->id) }}" method="POST">

@csrf

@method('PUT')


<div class="mb-5">

<label class="block font-semibold mb-2">
Nama Siswa
</label>


<select name="siswa_id"
class="w-full border rounded-xl px-4 py-3"
required>


@foreach($siswa as $item)

<option value="{{ $item->id }}"
@if($item->id == $absensi->siswa_id)
selected
@endif>

{{ $item->nama }}

</option>

@endforeach


</select>

</div>



<div class="mb-5">

<label class="block font-semibold mb-2">
Tanggal
</label>


<input type="date"
name="tanggal"
value="{{ $absensi->tanggal }}"
class="w-full border rounded-xl px-4 py-3"
required>

</div>



<div class="mb-8">

<label class="block font-semibold mb-2">
Status
</label>


<select name="status"
class="w-full border rounded-xl px-4 py-3"
required>


<option value="hadir"
@if($absensi->status=='hadir') selected @endif>
Hadir
</option>


<option value="izin"
@if($absensi->status=='izin') selected @endif>
Izin
</option>


<option value="sakit"
@if($absensi->status=='sakit') selected @endif>
Sakit
</option>


<option value="alfa"
@if($absensi->status=='alfa') selected @endif>
Alfa
</option>


</select>


</div>



<div class="flex gap-3">


<button type="submit"
class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl">

Update

</button>



<a href="{{ route('absensi.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

Kembali

</a>


</div>


</form>


</div>

</div>

@endsection