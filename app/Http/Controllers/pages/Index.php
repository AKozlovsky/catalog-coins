<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Country;
use Illuminate\Support\Facades\File;

class Index extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard.index');
    }
    public function continents()
    {
        $continents = json_decode(File::get('assets/json/continents.json'));
        return view('pages.catalog.continents', ["data" => $continents]);
    }

    public function countries()
    {
        $collection = Collection::getCollections()->toArray();
        $code = array_unique(array_column($collection, "country_code"));
        $countries = Country::getCountriesByCode($code);
        $countriesJson = json_decode(File::get('assets/json/countries.json'));
        return view('pages.catalog.countries', ["data" => $countries, "countries" => $countriesJson]);
    }
}
