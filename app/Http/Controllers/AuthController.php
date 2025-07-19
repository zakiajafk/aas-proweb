<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
// Login handler
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.customers');
        }

        return redirect()->route('home')->with('success', 'Login berhasil!');
    }

    return back()
        ->withErrors(['email' => 'Email atau password salah.'])
        ->withInput()
        ->with('showLogin', true); // Tambah flag untuk buka modal login
}

// Register handler
public function register(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);

    return redirect()->route('home')->with('success', 'Registrasi berhasil!');
}

    // Logout handler
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
