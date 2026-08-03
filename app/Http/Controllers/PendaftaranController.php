<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // ==========================
    // FORM PENDAFTARAN
    // ==========================
    public function create()
    {
        return view('pendaftaran.create');
    }

    // ==========================
    // SIMPAN PENDAFTARAN
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_anak'      => 'required',
            'jenis_kelamin'  => 'required',
            'nama_ortu'      => 'required',
            'alamat'         => 'required',
            'no_hp'          => 'required',
            'tgl_lahir'      => 'required|date',
            'cabang_id'      => 'required|exists:cabangs,id',
        ]);

        Pendaftaran::create([
            'nama_anak'      => $request->nama_anak,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'nama_ortu'      => $request->nama_ortu,
            'alamat'         => $request->alamat,
            'no_hp'          => $request->no_hp,
            'tgl_lahir'      => $request->tgl_lahir,
            'status'         => 'menunggu',
            'cabang_id'      => $request->cabang_id,
        ]);

        return redirect()->back()
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    // ==========================
    // TAMPIL DATA PENDAFTARAN
    // ==========================
    public function index()
    {
        $data = Pendaftaran::latest()->get();

        return view('pendaftaran.index', compact('data'));
    }

    // ==========================
    // UPDATE STATUS
    // ==========================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'kelas'  => 'nullable',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        // Simpan status
        $pendaftaran->status = $request->status;

        // Jika diterima maka kelas wajib dipilih
        if ($request->status == 'diterima') {

            if (empty($request->kelas)) {
                return redirect()->back()
                    ->with('error', 'Silakan pilih kelas terlebih dahulu.');
            }

            $pendaftaran->kelas = $request->kelas;
        }

        $pendaftaran->save();

        // Jika diterima maka otomatis menjadi siswa
        if ($request->status == 'diterima') {

            // Cari akun orang tua berdasarkan nomor HP
            $user = User::where('role', 'orangtua')
                        ->where('no_hp', $pendaftaran->no_hp)
                        ->first();

            // Cek apakah siswa sudah ada
            $siswa = Siswa::where('nama', $pendaftaran->nama_anak)->first();

            if (!$siswa) {

                Siswa::create([
                    'nama'           => $pendaftaran->nama_anak,
                    'jenis_kelamin'  => $pendaftaran->jenis_kelamin,
                    'tanggal_lahir'  => $pendaftaran->tgl_lahir,
                    'kelas'          => $pendaftaran->kelas,
                    'alamat'         => $pendaftaran->alamat,
                    'nama_orangtua'  => $pendaftaran->nama_ortu,
                    'no_hp'          => $pendaftaran->no_hp,
                    'user_id'        => $user ? $user->id : null,
                    'cabang_id'      => $pendaftaran->cabang_id,
                ]);

            } else {

                $siswa->update([
                    'jenis_kelamin'  => $pendaftaran->jenis_kelamin,
                    'tanggal_lahir'  => $pendaftaran->tgl_lahir,
                    'kelas'          => $pendaftaran->kelas,
                    'alamat'         => $pendaftaran->alamat,
                    'nama_orangtua'  => $pendaftaran->nama_ortu,
                    'no_hp'          => $pendaftaran->no_hp,
                    'user_id'        => $user ? $user->id : $siswa->user_id,
                    'cabang_id'      => $pendaftaran->cabang_id,
                ]);

            }
        }

        return redirect()->back()
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

        // ==========================
    // FORM CEK STATUS
    // ==========================
    public function cekForm()
    {
        return view('pendaftaran.cek');
    }

    // ==========================
    // PROSES CEK STATUS
    // ==========================
    public function cekStatus(Request $request)
    {
        $data = Pendaftaran::where('nama_anak', $request->nama_anak)
            ->where('no_hp', $request->no_hp)
            ->first();

        return view('pendaftaran.cek', compact('data'));
    }

    // ==========================
    // HAPUS PENDAFTARAN
    // ==========================
    public function destroy(Pendaftaran $pendaftaran)
    {
        // Jika data siswa sudah dibuat dari pendaftaran ini,
        // hapus juga data siswanya (opsional)
        Siswa::where('nama', $pendaftaran->nama_anak)->delete();

        // Hapus data pendaftaran
        $pendaftaran->delete();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}