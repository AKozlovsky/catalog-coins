<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Error extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view("errors.404", ['pageConfigs' => $pageConfigs]);
    }
}
