<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\OtherCriteria;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function list(Request $request, $value = null)
    {
        $json = json_decode(File::get('assets/json/columns.json'));
        $action = $request->route()->action["as"];
        $windowTitle = ucfirst($action);
        $columns = $json->$action;
        $addSelectionInput = false;
        $data = $type = null;

        switch ($action) {
            case "continents":
                $title = "Continent";
                break;
            case "countries":
                $title = "Country";
                break;
            case "monarchs":
                $title = "Monarch";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["monarch"]);
                $type = "monarch";
                break;
            case "reign-periods":
                $title = "Reign Period";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["reign_period_from"]);
                $type = "reign_period";
                break;
            case "mintage-years":
                $title = "Mintage Year";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["mintage_year"]);
                $type = "mintage_year";
                break;
            case "avers":
                $title = "Avers";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["avers"]);
                $type = "avers";
                break;
            case "revers":
                $title = "Revers";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["revers"]);
                $type = "revers";
                break;
            case "coin-edges":
                $title = "Coin Edge";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["coin_edge"]);
                $type = "coin_edge";
                break;
            case "currencies":
                $title = "Currency";
                $addSelectionInput = true;
                $data = Currency::getData(["name"]);
                $type = "currency";
                break;
            case "centuries":
                $title = "Century";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["century"]);
                $type = "century";
                break;
            case "metals":
                $title = "Metal";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["metal"]);
                $type = "metal";
                break;
            case "qualities":
                $title = "Quality";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["quality"]);
                $type = "quality";
                break;
            case "prices-by-krause":
                $title = "Price by Krause";
                $addSelectionInput = true;
                $data = OtherCriteria::getData(["price_by_krause"]);
                $type = "price_by_krause";
                break;
        }

        return view("pages.catalog.list", [
            "windowTitle" => $windowTitle,
            "title" => $title,
            "input" => ucwords(str_replace("-", " ", $value)),
            "columns" => $columns,
            "action" => $action,
            "addSelectionInput" => $addSelectionInput,
            "data" => $data,
            "type" => $type
        ]);
    }
}
