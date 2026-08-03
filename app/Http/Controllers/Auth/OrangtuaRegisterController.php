<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class OrangtuaRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-orangtua');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'no_hp'    => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat akun orang tua
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'role'     => 'orangtua',
        ]);

        // Hubungkan akun dengan data siswa berdasarkan nomor HP
        $siswa = Siswa::where('no_hp', $request->no_hp)
                      ->whereNull('user_id')
                      ->first();

        if ($siswa) {
            $siswa->update([
                'user_id' => $user->id,
            ]);
            $user->update([
                'cabang_id' => $siswa->cabang_id,
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard.orangtua')
            ->with('success', 'Akun berhasil dibuat.');
    }
}