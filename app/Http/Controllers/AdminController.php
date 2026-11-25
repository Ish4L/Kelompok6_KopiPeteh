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

        $request->validate([
            'name'     => 'required|string|max:50',
            'username' => ['required', 'string', 'max:50', Rule::unique('admins', 'username')->ignore($admin->id)],
            'email'    => 'required|email|max:100',
            'phone'    => 'required|string|max:20',
            'password' => 'nullable|required_with:password_confirmation|string|min:8|confirmed',
        ], [
            'name.required'          => 'Nama harus diisi',
            'username.required'      => 'Username harus diisi',
            'username.unique'        => 'Username sudah digunakan',
            'email.required'         => 'Email harus diisi',
            'email.email'            => 'Format email tidak valid',
            'phone.required'         => 'No. Telepon harus diisi',
            'password.required_with' => 'Isi password terlebih dahulu',
            'password.min'           => 'Password minimal 8 karakter',
            'password.confirmed'     => 'Konfirmasi password tidak cocok',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    // public function updatePassword(Request $request)
    // {
    //     $request->validateWithBag('password', [
    //         'password' => 'required|string|min:8|confirmed',
    //     ], [
    //         'password.required'  => 'Password baru harus diisi',
    //         'password.min'       => 'Password minimal 8 karakter',
    //         'password.confirmed' => 'Konfirmasi password tidak cocok',
    //     ]);

    //     $admin = Auth::guard('admin')->user();

    //     $admin->update([
    //     'password' => Hash::make($request->password),
    //     ]);

    //     return back()->with('success_password', 'Password berhasil diperbarui');
    // }
}
