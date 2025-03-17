<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('auth.forgot-password', ['pageConfigs' => $pageConfigs]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        dump($status);
        exit;
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)])->middleware('guest')->name('password.email');
    }

    public function sendPassword(Request $request)
    {
        dump($request);
        exit;
    }
}
