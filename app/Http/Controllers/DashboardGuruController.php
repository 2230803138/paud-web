<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\AbsensiGuru;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
    public function index()
    {
        $guru = Guru::where('user_id', Auth::id())->first();

        $absensiHariIni = null;

        if ($guru) {
            $absensiHariIni = AbsensiGuru::where('guru_id', $guru->id)
                ->whereDate('tanggal', now()->toDateString())
                ->first();
        }

        return view('guru.dashboard', compact('guru', 'absensiHariIni'));
    }

    public function absensi()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.absensi', compact('guru', 'absensi'));
    }

    public function absensiAnak(Request $request)
    {
        $tanggal = $request->input('tanggal', today()->toDateString());
        $kelas = $request->input('kelas');

        $siswa = collect();
        if ($kelas) {
            $siswa = Siswa::where('kelas', $kelas)->orderBy('nama')->get();

            // Load existing absensi for these students on this date
            foreach ($siswa as $item) {
                $item->absensi_hari_ini = Absensi::where('siswa_id', $item->id)
                    ->whereDate('tanggal', $tanggal)
                    ->first();
            }
        }

        // Get class choices (e.g. from existing unique kelas or static types)
        $kelasOptions = ['Baby Class', 'Toddler', 'Nursery'];

        return view('guru.absensi-anak', compact('tanggal', 'kelas', 'siswa', 'kelasOptions'));
    }

    public function storeAbsensiAnak(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelas' => 'required|string',
            'statuses' => 'required|array',
            'statuses.*' => 'required|in:hadir,izin,sakit,alfa',
        ]);

        $tanggal = $request->tanggal;
        foreach ($request->statuses as $siswaId => $status) {
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'tanggal' => $tanggal,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi siswa berhasil disimpan untuk tanggal ' . \Carbon\Carbon::parse($tanggal)->format('d-m-Y'));
    }

    public function perkembangan()
    {
        $laporan = Laporan::with(['siswa', 'guru'])->latest()->get();
        $siswa = Siswa::orderBy('nama')->get();

        return view('guru.perkembangan', compact('laporan', 'siswa'));
    }

    public function storePerkembangan(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'kognitif' => 'nullable|integer|between:0,100',
            'motorik' => 'nullable|integer|between:0,100',
            'bahasa' => 'nullable|integer|between:0,100',
            'sosial_emosional' => 'nullable|integer|between:0,100',
            'agama_moral' => 'nullable|integer|between:0,100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $fotoPath = 'uploads/kegiatan/' . $filename;
        }

        $guru = Guru::where('user_id', Auth::id())->first();

        Laporan::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $guru ? $guru->id : null,
            'tanggal' => $request->tanggal,
            'perkembangan' => $request->catatan,
            'catatan' => $request->catatan,
            'kognitif' => $request->kognitif,
            'motorik' => $request->motorik,
            'bahasa' => $request->bahasa,
            'sosial_emosional' => $request->sosial_emosional,
            'agama_moral' => $request->agama_moral,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('guru.perkembangan')->with('success', 'Laporan perkembangan berhasil ditambahkan.');
    }

    public function editPerkembangan($id)
    {
        $laporan = Laporan::findOrFail($id);
        $siswa = Siswa::orderBy('nama')->get();

        return view('guru.perkembangan-edit', compact('laporan', 'siswa'));
    }

    public function updatePerkembangan(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'kognitif' => 'nullable|integer|between:0,100',
            'motorik' => 'nullable|integer|between:0,100',
            'bahasa' => 'nullable|integer|between:0,100',
            'sosial_emosional' => 'nullable|integer|between:0,100',
            'agama_moral' => 'nullable|integer|between:0,100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $laporan = Laporan::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->first();

        $data = [
            'siswa_id' => $request->siswa_id,
            'guru_id' => $guru ? $guru->id : null,
            'tanggal' => $request->tanggal,
            'perkembangan' => $request->catatan,
            'catatan' => $request->catatan,
            'kognitif' => $request->kognitif,
            'motorik' => $request->motorik,
            'bahasa' => $request->bahasa,
            'sosial_emosional' => $request->sosial_emosional,
            'agama_moral' => $request->agama_moral,
        ];

        if ($request->hasFile('foto')) {
            if ($laporan->foto && file_exists(public_path($laporan->foto))) {
                @unlink(public_path($laporan->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        $laporan->update($data);

        return redirect()->route('guru.perkembangan')->with('success', 'Laporan perkembangan berhasil diperbarui.');
    }

    public function destroyPerkembangan($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->foto && file_exists(public_path($laporan->foto))) {
            @unlink(public_path($laporan->foto));
        }
        $laporan->delete();

        return redirect()->route('guru.perkembangan')->with('success', 'Laporan perkembangan berhasil dihapus.');
    }

    public function profil()
    {
        $guru = Guru::where('user_id', Auth::id())->first();

        return view('guru.profil', compact('guru'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $guru->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}