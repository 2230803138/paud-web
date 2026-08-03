<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->latest()->get();

        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => 'guru',
            'cabang_id' => auth()->user()->cabang_id,
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('guru.index')
            ->with('success','Guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama'=>'required',
            'nip'=>'required',
            'jenis_kelamin'=>'required',
            'jabatan'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
        ]);

        $guru->update([
            'nama'=>$request->nama,
            'nip'=>$request->nip,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'jabatan'=>$request->jabatan,
            'no_hp'=>$request->no_hp,
            'alamat'=>$request->alamat,
        ]);

        if($guru->user){
            $guru->user->update([
                'name'=>$request->nama,
                'no_hp'=>$request->no_hp,
            ]);
        }

        return redirect()->route('guru.index')
            ->with('success','Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        if($guru->user){
            $guru->user->delete();
        }

        $guru->delete();

        return redirect()->route('guru.index')
            ->with('success','Guru berhasil dihapus.');
    }
}