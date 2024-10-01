<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Item;
use Illuminate\Support\Facades\File;

class Base extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard.index', [
            "totalItems" => Item::getCount(),
            "itemsThisWeek" => Item::getTotalThisWeek(),
            "totalCountries" => Collection::getTotalCountries(),
            "countriesThisWeek" => Collection::getTotalCountriesThisWeek(),
            "totalCountriesWithMostItems" => Collection::getCountriesWithMostItems()
        ]);
    }

    public function continents()
    {
        $continents = Continent::getContinents();

        return view('pages.catalog.continents', ["continents" => $continents]);
    }

    public function countries()
    {
        $collection = Collection::getCollections()->toArray();
        $code = array_unique(array_column($collection, "country_code"));
        $countries = Country::getCountries(["code", "country_name", "full_name"], $code);
        $countriesJson = json_decode(File::get('assets/json/countries.json'));

        return view('pages.catalog.countries', ["data" => $countries, "countries" => $countriesJson]);
    }
}
