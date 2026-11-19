<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // TAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek apakah email ada
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Akun tidak terdaftar!');
        }

        // kalau email ada, cek password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Password salah!');
        }
        
        // kalau berhasil login
        if (auth()->user()->role == 'admin') {

            return redirect('/dashboard')
                ->with('success', 'Login berhasil!');

        }

        if (auth()->user()->role == 'kasir') {

            return redirect('/kasir')
                ->with('success', 'Login berhasil!');

        }

        if (auth()->user()->role == 'owner') {

            return redirect('/owner')
                ->with('success', 'Login berhasil!');

        }
    }
    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}