<?php

namespace App\Http\Controllers;

use App\Models\AbsensiGuru;
use App\Models\Guru;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $data = AbsensiGuru::with('guru')
                    ->latest()
                    ->get();

        return view('absensi_guru.index', compact('data'));
    }

    // Guru absen masuk
    public function masuk()
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();

        $cek = AbsensiGuru::where('guru_id', $guru->id)
                    ->whereDate('tanggal', today())
                    ->first();

        if ($cek) {
            return back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        AbsensiGuru::create([
            'guru_id'   => $guru->id,
            'tanggal'   => today(),
            'jam_masuk' => now()->format('H:i:s'),
            'status'    => 'Hadir',
        ]);

        return back()->with('success', 'Absen masuk berhasil.');
    }

    // Guru absen pulang
    public function pulang()
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();

        $absen = AbsensiGuru::where('guru_id', $guru->id)
                    ->whereDate('tanggal', today())
                    ->first();

        if (!$absen) {
            return back()->with('error', 'Silakan absen masuk terlebih dahulu.');
        }

        $absen->update([
            'jam_pulang' => now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Absen pulang berhasil.');
    }

    // Guru absen izin/sakit
    public function storeIzinSakit(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Izin,Sakit',
            'keterangan' => 'required|string',
        ]);

        $guru = Guru::where('user_id', auth()->id())->firstOrFail();

        $cek = AbsensiGuru::where('guru_id', $guru->id)
                    ->whereDate('tanggal', today())
                    ->first();

        if ($cek) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini.');
        }

        AbsensiGuru::create([
            'guru_id'   => $guru->id,
            'tanggal'   => today(),
            'status'    => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Absensi Izin/Sakit berhasil dikirim.');
    }
}