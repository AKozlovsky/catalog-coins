<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Catalog extends Controller
{
    public function index(Request $request)
    {
        $columns = ['country', 'currency', 'symbol', 'numerical_value', "action"];
        $continent = $request->input('continent');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $columns = $request->input('columns');
        $totalData = Collection::getTotalCollections($continent);
        $totalFiltered = Collection::getTotalCollections($continent, $search, $columns);
        $data = Collection::getCollections($continent, $limit, $start, $order, $dir, $search, $columns);

        if (!$data) {
            return response()->json([
                'message' => 'Internal Server Error',
                'code' => 500,
                'data' => [],
            ]);
        } else {
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => intval($totalData),
                'recordsFiltered' => intval($totalFiltered),
                'code' => 200,
                'data' => $data,
            ]);
        }
    }

    public function continent($continent)
    {
        $continent = ucwords(str_replace("-", " ", $continent));
        $code = Continent::getCode($continent);
        $result = Country::getCountriesByContinent($code);
        $columns = json_decode(File::get('assets/json/columns.json'))->continents;
        return view("pages.catalog.list", ["data" => $result, "continent" => $continent, "columns" => $columns]);
    }
}
