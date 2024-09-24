<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Country;
use App\Models\Item;

class Action extends Controller
{
    public function add()
    {
        $continents = Continent::getContinents();
        $currencies = Currency::getData();

        return view("pages.action.add", ["continents" => $continents, "currencies" => $currencies]);
    }

    public function submit(Request $request)
    {
        $item = [
            "currency" => $request->currency,
            "numerical_value" => $request->currencyValue
        ];

        $itemId = Item::create($item)->id;

        $data = [
            "continent" => Continent::getCode($request->continent),
            "country" => Country::getCode($request->country),
            "item" => $itemId
        ];

        Collection::create($data);
    }
}
