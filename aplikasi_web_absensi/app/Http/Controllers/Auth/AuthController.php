<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display login form
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Display registration form
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Handle login request
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')
                ->withSuccess('Berhasil login');
        }

        return redirect("login")
            ->withError('Email atau password salah')
            ->withInput();
    }

    /**
     * Handle registration request
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect("dashboard")
            ->withSuccess('Registrasi berhasil! Selamat datang');
    }

    /**
     * Display dashboard
     */
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Get recent absensi for dashboard
            $recentAbsensi = \App\Models\absensi::where('id_user', $user->id)
                ->latest()
                ->take(5)
                ->get();

            return view('auth.dashboard', compact('user', 'recentAbsensi'));
        }

        return redirect("login")
            ->withError('Silakan login terlebih dahulu');
    }

    /**
     * Create new user
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'mahasiswa', // default role
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')
            ->withSuccess('Berhasil logout');
    }
}
