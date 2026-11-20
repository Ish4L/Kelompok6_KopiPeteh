<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validateWithBag('profile', [
            'name'     => 'required|string|max:50',
            'username' => ['required', 'string', 'max:50', Rule::unique('admins', 'username')->ignore($admin->id)],
            'email'    => 'required|string|max:100',
            'phone'    => 'required|string|max:20',
        ], [
            'name.required'     => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required'    => 'Email harus diisi',
            'phone.required'    => 'No. Telepon harus diisi',
        ]);

        $admin->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        return back()->with('success_profile', 'Data profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validateWithBag('password', [
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required'  => 'Password baru harus diisi',
            'password.min'       => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $admin = Auth::guard('admin')->user();

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success_password', 'Password berhasil diperbarui');
    }
}
