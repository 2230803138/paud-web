<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // ==========================
    // TAMPILKAN DATA
    // ==========================
    public function index()
    {
        $data = Absensi::with('siswa')->latest()->get();

        return view('absensi.index', compact('data'));
    }

    // ==========================
    // FORM TAMBAH
    // ==========================
    public function create()
    {
        $siswa = Siswa::orderBy('nama')->get();

        return view('absensi.create', compact('siswa'));
    }

    // ==========================
    // SIMPAN
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|in:hadir,izin,sakit,alfa',
        ]);

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    // ==========================
    // DETAIL
    // ==========================
    public function show(Absensi $absensi)
    {
        return view('absensi.show', compact('absensi'));
    }

    // ==========================
    // FORM EDIT
    // ==========================
    public function edit(Absensi $absensi)
    {
        $siswa = Siswa::orderBy('nama')->get();

        return view('absensi.edit', compact('absensi', 'siswa'));
    }

    // ==========================
    // UPDATE
    // ==========================
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|in:hadir,izin,sakit,alfa',
        ]);

        $absensi->update([
            'siswa_id' => $request->siswa_id,
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Data absensi berhasil diperbarui.');
    }

    // ==========================
    // HAPUS
    // ==========================
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Data absensi berhasil dihapus.');
    }
}