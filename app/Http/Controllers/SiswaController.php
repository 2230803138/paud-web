<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\User;

class SiswaController extends Controller
{
    // TAMPIL DATA SISWA
    public function index()
    {
        $siswa = Siswa::with('user')->get();

        return view('siswa.index', compact('siswa'));
    }

    // FORM TAMBAH
    public function create()
    {
        $orangtua = User::where('role', 'orangtua')->get();

        return view('siswa.create', compact('orangtua'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required',
            'jenis_kelamin'   => 'required',
            'tanggal_lahir'   => 'required',
            'kelas'           => 'required',
            'alamat'          => 'required',
            'nama_orangtua'   => 'required',
            'no_hp'           => 'required',
            'user_id'         => 'required|exists:users,id',
        ]);

        Siswa::create([
            'nama'            => $request->nama,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'kelas'           => $request->kelas,
            'alamat'          => $request->alamat,
            'nama_orangtua'   => $request->nama_orangtua,
            'no_hp'           => $request->no_hp,
            'user_id'         => $request->user_id,
        ]);

        return redirect('/siswa')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $orangtua = User::where('role', 'orangtua')->get();

        return view('siswa.edit', compact('siswa', 'orangtua'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'            => 'required',
            'jenis_kelamin'   => 'required',
            'tanggal_lahir'   => 'required',
            'kelas'           => 'required',
            'alamat'          => 'required',
            'nama_orangtua'   => 'required',
            'no_hp'           => 'required',
            'user_id'         => 'required|exists:users,id',
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'nama'            => $request->nama,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'kelas'           => $request->kelas,
            'alamat'          => $request->alamat,
            'nama_orangtua'   => $request->nama_orangtua,
            'no_hp'           => $request->no_hp,
            'user_id'         => $request->user_id,
        ]);

        return redirect('/siswa')
            ->with('success', 'Data siswa berhasil diupdate');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Hapus semua absensi siswa
        Absensi::where('siswa_id', $id)->delete();

        // Hapus siswa
        $siswa->delete();

        return redirect('/siswa')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}