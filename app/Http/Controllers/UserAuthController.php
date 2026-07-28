<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // =========================
    // Login
    // =========================

    public function showLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role !== 'user') {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Silakan login melalui halaman yang sesuai.'
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

    // =========================
    // Register
    // =========================

    public function showRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {

        $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:8|confirmed',

        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role' => 'user',

        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    // =========================
    // Logout
    // =========================

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
