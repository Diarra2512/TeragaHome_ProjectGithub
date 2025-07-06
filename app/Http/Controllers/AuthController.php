<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showLoginForm()  { return view('auth.login'); }

    public function login(Request $r)
    {
        $credentials = $r->only('email','password');
        if (Auth::attempt($credentials, $r->filled('remember'))) {
            $r->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors(['email'=>'Identifiants invalides'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Ou autre page de redirection après logout
    }
}
