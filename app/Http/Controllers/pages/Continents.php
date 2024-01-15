<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Support\Facades\File;

class Continents extends Controller
{
    public function index()
    {
        $data = json_decode(File::get('assets/json/continents.json'));

        return view('content.continents.index', ["data" => $data]);
    }

    public function continent($continent)
    {
        $data = Collection::getCollection($continent);
        $continent = ucwords(str_replace("-", " ", $continent));

        return view("content.continents.continent", ["data" => $data, "continent" => $continent]);
    }
}
