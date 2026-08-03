<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // ==========================
    // TAMPIL DATA
    // ==========================
    public function index()
    {
        $jadwal = Jadwal::latest()->get();

        return view('jadwal.index', compact('jadwal'));
    }

    // ==========================
    // FORM TAMBAH
    // ==========================
    public function create()
    {
        return view('jadwal.create');
    }

    // ==========================
    // SIMPAN DATA
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'kegiatan' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'keterangan' => 'nullable',
        ]);

        Jadwal::create([
            'kelas' => $request->kelas,
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // ==========================
    // DETAIL
    // ==========================
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    // ==========================
    // FORM EDIT
    // ==========================
    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    // ==========================
    // UPDATE
    // ==========================
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'kelas' => 'required',
            'kegiatan' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'keterangan' => 'nullable',
        ]);

        $jadwal->update([
            'kelas' => $request->kelas,
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    // ==========================
    // HAPUS
    // ==========================
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}