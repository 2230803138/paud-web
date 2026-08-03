<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function index(Request $request)
{
    $query = Pembayaran::with('siswa');

    // Filter Bulan
    if ($request->filled('bulan')) {
        $query->where('bulan', $request->bulan);
    }

    // Filter Tahun
    if ($request->filled('tahun')) {
        $query->where('tahun', $request->tahun);
    }

    $pembayaran = $query->latest()->paginate(10);

$pembayaran->appends([
    'bulan' => $request->bulan,
    'tahun' => $request->tahun,
]);

    $totalPemasukan = (clone $query)
        ->where('status', 'Lunas')
        ->sum('nominal');

    $jumlahLunas = (clone $query)
        ->where('status', 'Lunas')
        ->count();

    $jumlahBelumLunas = (clone $query)
        ->where('status', 'Belum Lunas')
        ->count();

    return view('pembayaran.index', compact(
        'pembayaran',
        'totalPemasukan',
        'jumlahLunas',
        'jumlahBelumLunas'
    ));
}

    // ============================
    // DETAIL PEMBAYARAN
    // ============================
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function create()
    {
        $siswa = Siswa::orderBy('nama')->get();

        return view('pembayaran.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'nominal' => 'required|numeric',
            'status' => 'required',
            'tanggal_bayar' => 'nullable|date',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $siswa = Siswa::orderBy('nama')->get();

        return view('pembayaran.edit', compact(
            'pembayaran',
            'siswa'
        ));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'siswa_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'nominal' => 'required|numeric',
            'status' => 'required',
            'tanggal_bayar' => 'nullable|date',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data berhasil diubah.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    // ============================
    // EXPORT PDF (TESTING)
    // ============================
    public function exportPdf()
{
    $pembayaran = Pembayaran::with('siswa')
        ->orderBy('tahun')
        ->orderBy('bulan')
        ->get();

    $totalPemasukan = Pembayaran::where('status', 'Lunas')
        ->sum('nominal');

    $pdf = Pdf::loadView('pembayaran.pdf', compact(
        'pembayaran',
        'totalPemasukan'
    ));

    $pdf->setPaper('A4', 'landscape');

    return $pdf->download('Laporan-Pembayaran-Ebony-Preschool.pdf');
}
}