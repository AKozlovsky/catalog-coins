<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;

class Continents extends Controller
{
    public function index()
    {
        return view('content.continents.index');
    }
}
