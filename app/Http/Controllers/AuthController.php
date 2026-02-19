<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('daftar');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            // NAME
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',

            // EMAIL
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            // PASSWORD
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pemilik',
        ]);

        return redirect()->route('masuk')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }



    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('masuk');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.beranda');
            }

            if (Auth::user()->role === 'pemilik') {
                return redirect()->route('pemilik.beranda');
            }

            return redirect()->route('pelanggan.beranda');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pelanggan.beranda');
    }
}
