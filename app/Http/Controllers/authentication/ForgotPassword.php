<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPassword extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('auth.forgot-password', ['pageConfigs' => $pageConfigs]);
    }
}
