<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class Catalog extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $limit = $request->input('length');
        $start = $request->input('start');
        $columns = $request->input('columns');
        $order = $columns[$request->input('order.0.column')]["data"];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $totalData = Collection::getTotalCollections($input);
        $totalFiltered = Collection::getTotalCollections($input, $search, $columns);
        $data = Collection::getCollections($input, $limit, $start, $order, $dir, $search, $columns);

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

    public function list(Request $request, $value)
    {
        $json = json_decode(File::get('assets/json/columns.json'));

        if ($request->route()->named("continents")) {
            $windowTitle = "Continents";
            $title = "Continent";
            $columns = $json->continents;
        } elseif ($request->route()->named("countries")) {
            $windowTitle = "Countries";
            $title = "Country";
            $columns = $json->countries;
        }

        return view("pages.catalog.list", [
            "windowTitle" => $windowTitle,
            "title" => $title,
            "input" => ucwords(str_replace("-", " ", $value)),
            "columns" => $columns,
            "action" => Route::current()->action["as"]
        ]);
    }
}
