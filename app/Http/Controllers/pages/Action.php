<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Country;
use App\Models\Item;
use App\Models\OtherCriteria;

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
        $otherCriteria = $this->setOtherCriteria($request);

        $item = [
            "currency" => $request->currency,
            "numerical_value" => $request->currencyValue
        ];

        if (!empty($otherCriteria)) {
            $id = OtherCriteria::create($otherCriteria);
            $item["other_criteria"] = $id;
        }

        $itemId = Item::create($item)->id;

        $data = [
            "continent" => Continent::getCode($request->continent),
            "country" => Country::getCode($request->country),
            "item" => $itemId
        ];

        Collection::create($data);
    }

    public function setOtherCriteria($request)
    {
        $result = [];

        if ($request->monarch != null) {
            $result["monarch"] = $request->monarch;
        }

        return $result;
    }
}
