<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\OtherCriteria;
use App\Models\Currency;
use App\Models\Photos;
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
        $this->_getPhotos($data);

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
        $action = substr($action, strpos($action, "catalog/") + strlen("catalog/"));
        $pageTitle = ucfirst($action);
        $columns = $json->$action;
        $inputSelector = false;
        $data = $type = null;

        switch ($action) {
            case "continents":
                $title = "Continents";
                break;
            case "countries":
                $title = "Countries";
                break;
            case "monarchs":
                $title = "Monarchs";
                $inputSelector = true;
                $data = OtherCriteria::getData(["monarch"]);
                $this->_getPhotos($data);
                $type = "monarch";
                break;
            case "reign-periods":
                $title = "Reign Periods";
                $inputSelector = true;
                $data = OtherCriteria::getData(["reign_period_from"]);
                $this->_getPhotos($data);
                $type = "reign_period";
                break;
            case "mintage-years":
                $title = "Mintage Years";
                $inputSelector = true;
                $data = OtherCriteria::getData(["mintage_year"]);
                $type = "mintage_year";
                break;
            case "avers":
                $title = "Avers";
                $inputSelector = true;
                $data = OtherCriteria::getData(["avers"]);
                $type = "avers";
                break;
            case "revers":
                $title = "Revers";
                $inputSelector = true;
                $data = OtherCriteria::getData(["revers"]);
                $type = "revers";
                break;
            case "coin-edges":
                $title = "Coin Edges";
                $inputSelector = true;
                $data = OtherCriteria::getData(["coin_edge"]);
                $type = "coin_edge";
                break;
            case "currencies":
                $title = "Currencies";
                $inputSelector = true;
                $data = Currency::getData(["currency"]);
                $type = "currency";
                break;
            case "centuries":
                $title = "Centuries";
                $inputSelector = true;
                $data = OtherCriteria::getData(["century"]);
                $type = "century";
                break;
            case "metals":
                $title = "Metals";
                $inputSelector = true;
                $data = OtherCriteria::getData(["metal"]);
                $type = "metal";
                break;
            case "qualities":
                $title = "Qualities";
                $inputSelector = true;
                $data = OtherCriteria::getData(["quality"]);
                $type = "quality";
                break;
            case "prices-by-krause":
                $title = "Prices by Krause";
                $inputSelector = true;
                $data = OtherCriteria::getData(["price_by_krause"]);
                $type = "price_by_krause";
                break;
        }

        return view("pages.catalog.list", [
            "pageTitle" => $pageTitle,
            "title" => $title,
            "input" => ucwords(str_replace("-", " ", $value)),
            "columns" => $columns,
            "action" => $action,
            "inputSelector" => $inputSelector,
            "data" => $data,
            "type" => $type
        ]);
    }

    private function _getPhotos(&$data)
    {
        foreach ($data as $key => $row) {
            if (Photos::getPhotos($row["item"])->count()) {
                $data[$key]["photos"] = Photos::getPhotos($row["item"]);
            } else {
                $data[$key]["photos"] = "";
            }
        }
    }
}
