<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Currency;

class Action extends Controller
{
    public function add()
    {
        $continents = Continent::getContinents();
        $currencies = Currency::getData();

        return view("pages.action.add", ["continents" => $continents, "currencies" => $currencies]);
    }
}
