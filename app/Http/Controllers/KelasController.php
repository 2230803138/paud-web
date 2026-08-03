<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('siswa')->latest()->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $siswa = Siswa::orderBy('nama')->get();

        return view('kelas.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis_kelas' => 'required',
        ]);

        Kelas::create([
            'siswa_id' => $request->siswa_id,
            'jenis_kelas' => $request->jenis_kelas,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela)
    {
        $siswa = Siswa::orderBy('nama')->get();

        return view('kelas.edit', [
            'kelas' => $kela,
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis_kelas' => 'required',
        ]);

        $kela->update([
            'siswa_id' => $request->siswa_id,
            'jenis_kelas' => $request->jenis_kelas,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diupdate.');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}