<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Currency;
use App\Models\NumericalValue;
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
            "numerical_value" => NumericalValue::create(["value" => $request->currencyValue])->id
        ];

        if (!empty($otherCriteria)) {
            $item["other_criteria"] = OtherCriteria::create($otherCriteria)->id;
        }

        $data = [
            "continent" => Continent::getCode($request->continent),
            "country" => Country::getCode($request->country),
            "item" => Item::create($item)->id
        ];

        Collection::create($data);
    }

    public function setOtherCriteria($request)
    {
        $result = [];

        foreach (OtherCriteria::getColumns() as $column) {
            if ($request->$column != null) {
                $result[$column] = $request->$column;
            }
        }

        return $result;
    }
}
