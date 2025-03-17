<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'home'
        ]);
        $this->middleware('auth')->only('logout', 'home');
        $this->middleware('verified')->only('home');
    }

    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('auth.register', ['pageConfigs' => $pageConfigs]);
    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:191', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:191']
        ]);

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('notice');
    }
}
