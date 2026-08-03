<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Menampilkan seluruh data informasi
     */
    public function index()
    {
        $informasi = Informasi::latest()->get();

        return view('informasi.index', compact('informasi'));
    }

    /**
     * Form tambah informasi
     */
    public function create()
    {
        return view('informasi.create');
    }

    /**
     * Simpan informasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:255',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'status'  => 'required',
        ]);

        Informasi::create($request->all());

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    /**
     * Detail informasi
     */
    public function show(Informasi $informasi)
    {
        return view('informasi.show', compact('informasi'));
    }

    /**
     * Form edit
     */
    public function edit(Informasi $informasi)
    {
        return view('informasi.edit', compact('informasi'));
    }

    /**
     * Update informasi
     */
    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'judul'   => 'required|max:255',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'status'  => 'required',
        ]);

        $informasi->update($request->all());

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Hapus informasi
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }
}