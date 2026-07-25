<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback dari Google
     */
    public function callback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            // Cek apakah email sudah ada
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {

                // Jika belum ada, buat akun otomatis
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(16)),
                    'role' => 'customer',
                ]);
            } else {

                // Update data Google jika akun sudah ada
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user);

            return redirect()->route('home')
                ->with('success', 'Login Google berhasil.');
        } catch (\Exception $e) {

            return redirect()->route('login')
                ->with('error', 'Login Google gagal.');
        }
    }
}
