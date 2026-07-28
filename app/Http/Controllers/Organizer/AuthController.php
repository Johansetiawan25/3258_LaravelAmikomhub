<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('organizer.login');
    }

    public function showRegister()
    {
        return view('organizer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:organizers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Organizer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('organizer.login')
            ->with('success', 'Pendaftaran berhasil. Silakan tunggu persetujuan Admin.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (
            Auth::guard('organizer')->attempt(
                $credentials,
                $request->filled('remember')
            )
        ) {

            $organizer = Auth::guard('organizer')->user();

            if ($organizer->status != 'approved') {

                Auth::guard('organizer')->logout();

                return back()->withErrors([
                    'email' => 'Akun Organizer belum disetujui oleh Admin.'
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('organizer.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('organizer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('organizer.login');
    }
}