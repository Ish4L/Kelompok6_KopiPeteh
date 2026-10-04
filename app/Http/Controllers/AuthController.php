<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request) {
        if (empty($request->username) && empty($request->password)) {
        return back()->withErrors([
            'error' => 'Username dan password wajib diisi!',
        ]);
    }

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'error' => 'Username atau password tidak sesuai.',
        ])->onlyInput('username');
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
