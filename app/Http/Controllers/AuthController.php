<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm(): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Anda sudah login.');
        }
        return view('auth.login');
    }

    /**
     * Tampilkan form registrasi.
     */
    public function showRegistrationForm(): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Anda sudah login.');
        }
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru.
     */
    public function register(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Anda sudah login.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Proses login user.
     */
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Anda sudah login.');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->Auth::user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout!');
    }
}