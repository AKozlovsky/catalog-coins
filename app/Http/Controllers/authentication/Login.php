<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'home']);
        $this->middleware('auth')->only('logout', 'home');
        $this->middleware('verified')->only('home');
    }

    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('auth.login', ['pageConfigs' => $pageConfigs]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email-username' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(
            [
                "name" => $credentials['email-username'],
                "email" => $credentials['email-username'],
                "password" => $credentials['password'],
            ]
        )) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email-username' => 'The provided credentials do not match our records.',
        ])->onlyInput('email-username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withSuccess('You have logged out successfully!');
    }
}
