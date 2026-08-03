<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        if ($request->is('login-orangtua')) {
            return view('auth.login-orangtua');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
  public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->role == 'admin') {
        return redirect()->route('dashboard');
    }

    if ($user->role == 'guru') {
        return redirect()->route('dashboard.guru');
    }

    if ($user->role == 'orangtua') {
        return redirect()->route('dashboard.orangtua');
    }

    if ($user->role == 'yayasan') {
        return redirect()->route('dashboard.yayasan');
    }

    return redirect('/');
}
public function createGuru(): View
{
    return view('auth.login-guru');
}
public function createYayasan(): View
{
    return view('auth.login-yayasan');
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}