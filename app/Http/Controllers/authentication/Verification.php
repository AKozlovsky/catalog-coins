<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class Verification extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function notice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('home');
        } else {
            $pageConfigs = ['myLayout' => 'blank'];

            return view('auth.verify-email', ['pageConfigs' => $pageConfigs]);
        }
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('home');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()
            ->withSuccess('A fresh verification link has been sent to your email address.');
    }
}
