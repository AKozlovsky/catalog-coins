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

    public function edit($id)
    {
        $continents = Continent::getContinents();
        $currencies = Currency::getData();
        $collection = Collection::getCollection($id);
        $continentName = Continent::getContinentName($collection->continent);
        $countryName = Country::getCountryName($collection->country);
        $item = Item::getItem($collection->item);
        $currencyCode = $item->currency;
        $numericalValue = NumericalValue::getValue($item->numerical_value);
        $otherCriteria = OtherCriteria::getValues($item->other_criteria);

        return view("pages.action.edit", [
            "continents" => $continents,
            "currencies" => $currencies,
            "continentName" => $continentName,
            "countryName" => $countryName,
            "currencyCode" => $currencyCode,
            "numericalValue" => $numericalValue,
            "otherCriteria" => $otherCriteria,
            "collectionId" => $id
        ]);
    }

    public function addSubmit(Request $request)
    {
        $otherCriteria = $this->setOtherCriteria($request);
        $item = [
            "currency" => $request->currency,
            "numerical_value" => NumericalValue::create(["value" => $request->currencyValue])->id,
            "other_criteria" => OtherCriteria::create($otherCriteria)->id
        ];
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
            $result[$column] = $request->$column;
        }

        return $result;
    }

    public function editSubmit($id, Request $request)
    {
        $item = Item::getItem(Collection::getCollection($id)->item);
        $otherCriteriaData = $this->setOtherCriteria($request);
        $otherCriteria = OtherCriteria::updateData($item->other_criteria, $otherCriteriaData);

        if (!is_null($item)) {
            $numericalValue = NumericalValue::getData($item->numerical_value);
            $numericalValue->value = $request->currencyValue;
            $numericalValue->save();
            $item->currency = $request->currency;
            $item->other_criteria = $otherCriteria->id;
            $item->save();
        }

        $data = [
            "continent" => Continent::getCode($request->continent),
            "country" => Country::getCode($request->country),
            "item" => $item->id
        ];

        Collection::updateData($id, $data);
    }

    public function delete($id)
    {
        $item = Item::getItem(Collection::getCollection($id)->item);
        NumericalValue::deleteData($item->numerical_value);
        OtherCriteria::deleteData($item->other_criteria);
        Item::deleteData($item->id);
        Collection::deleteData($id);
    }
}
