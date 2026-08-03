<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    // ================= ORANG TUA =================

    // Halaman Ulasan Orang Tua
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->route('dashboard.orangtua')
                ->with('error', 'Akun orang tua belum terhubung dengan data siswa.');
        }

        // Ambil guru yang ada di cabang yang sama dengan anak
        $gurus = Guru::where('cabang_id', $siswa->cabang_id)->get();

        // Riwayat ulasan yang pernah dikirim oleh orang tua ini
        $ulasans = Ulasan::with('guru')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orangtua.ulasan.index', compact('siswa', 'gurus', 'ulasans'));
    }

    // Simpan Ulasan Orang Tua
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'ulasan' => 'required|string|min:5',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Gagal mengirim ulasan. Siswa tidak ditemukan.');
        }

        Ulasan::create([
            'user_id' => Auth::id(),
            'guru_id' => $request->guru_id,
            'cabang_id' => $siswa->cabang_id,
            'ulasan' => $request->ulasan,
            'tanggal' => now()->toDateString(),
        ]);

        return redirect()->route('orangtua.ulasan.index')
            ->with('success', 'Ulasan untuk guru berhasil dikirimkan.');
    }

    // ================= KEPALA YAYASAN =================

    // Laporan Ulasan Guru untuk Yayasan
    public function laporanYayasan(Request $request)
    {
        $cabangId = $request->input('cabang_id');

        $query = Ulasan::with(['user', 'guru']);

        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }

        $ulasans = $query->latest()->get();

        return view('yayasan.ulasan', compact('ulasans'));
    }
}
