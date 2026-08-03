<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>

    <style>

        body{
            font-family: Arial;
            padding: 30px;
            background: #f4f4f4;
        }

        form{
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
        }

        input, textarea, select{
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        button{
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
        }

    </style>

</head>

<body>

    <h1>Edit Data Siswa</h1>

    <form action="/siswa/{{ $siswa->id }}" method="POST">

        @csrf
        @method('PUT')

        <input type="text" name="nama" value="{{ $siswa->nama }}">

        <select name="jenis_kelamin">

            <option value="Laki-laki"
            {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
            Laki-laki
            </option>

            <option value="Perempuan"
            {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
            Perempuan
            </option>

        </select>

        <input type="date" name="tanggal_lahir"
        value="{{ $siswa->tanggal_lahir }}">

        <textarea name="alamat">{{ $siswa->alamat }}</textarea>

        <input type="text" name="nama_orangtua"
        value="{{ $siswa->nama_orangtua }}">

        <input type="text" name="no_hp"
        value="{{ $siswa->no_hp }}">

        <button type="submit">Update</button>

    </form>

</body>
</html>