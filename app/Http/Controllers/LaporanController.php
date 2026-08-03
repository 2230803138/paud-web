<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    // TAMPIL DATA
    public function index()
    {
        $laporan = Laporan::with('siswa')->latest()->get();

        return view('laporan.index', compact('laporan'));
    }

    // FORM TAMBAH
    public function create()
    {
        $siswa = Siswa::all();

        return view('laporan.create', compact('siswa'));
    }

    // SIMPAN
    public function store(Request $request)
    {
        Laporan::create([
            'siswa_id' => $request->siswa_id,
            'perkembangan' => $request->perkembangan,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/laporan')
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    // LAPORAN UNTUK ORANG TUA
    public function laporanOrtu()
    {
        $laporans = Laporan::with('siswa')
            ->latest()
            ->get();

        return view('orangtua.laporan', compact('laporans'));
    }

    // FORM EDIT
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $siswa = Siswa::all();

        return view('laporan.edit', compact('laporan', 'siswa'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required',
            'perkembangan' => 'required',
            'catatan' => 'required',
            'tanggal' => 'required|date',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'siswa_id' => $request->siswa_id,
            'perkembangan' => $request->perkembangan,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/laporan')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    // HAPUS
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect('/laporan')
            ->with('success', 'Laporan berhasil dihapus');
    }
}