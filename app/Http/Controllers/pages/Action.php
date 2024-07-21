<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Continent;

class Action extends Controller
{
    public function add()
    {
        $continents = Continent::getContinents();

        return view("pages.action.add", ["continents" => $continents]);
    }
}
