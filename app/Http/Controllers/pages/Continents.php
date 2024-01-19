<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;

class Continents extends Controller
{
    public function index(Request $request)
    {
        $columns = ['country', 'currency', 'symbol', 'numerical_value'];
        $continent = $request->input('continent');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $data = Collection::getCollection($continent, $limit, $start, $order, $dir);
        }

        $totalData = Collection::getTotalCollections($continent, $limit, $start, $order, $dir);
        $totalFiltered = $totalData;

        if ($data) {
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => intval($totalData),
                'recordsFiltered' => intval($totalFiltered),
                'code' => 200,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => 'Internal Server Error',
                'code' => 500,
                'data' => [],
            ]);
        }
    }

    public function continent($continent)
    {
        $code = Continent::getCode($continent);
        $data = Country::getCountriesByContinent($code);
        $continent = ucwords(str_replace("-", " ", $continent));

        return view("content.continents.continent", ["data" => $data, "continent" => $continent]);
    }
}
