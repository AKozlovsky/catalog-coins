<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class Index extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard.index');
    }
    public function continents()
    {
        $data = json_decode(File::get('assets/json/continents.json'));
        return view('pages.continents.index', ["data" => $data]);
    }
}
