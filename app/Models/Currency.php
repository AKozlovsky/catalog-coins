<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currencies';
    protected $primaryKey = 'id';

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public static function getData($columns = [])
    {
        $result = Currency::select(
            "currencies.id AS id",
            "currencies.name AS currency",
            "currencies.symbol AS symbol",
            "continents.continent_name AS continent",
            "countries.country_name AS country",
            "numerical_values.value AS numerical_value",
            DB::raw('IFNULL(other_criteria.monarch, "") as monarch'),
            DB::raw('IFNULL(other_criteria.reign_period_from, "") as reign_period_from'),
            DB::raw('IFNULL(other_criteria.reign_period_to, "") as reign_period_to'),
            DB::raw('IFNULL(other_criteria.mintage_year, "") as mintage_year'),
            DB::raw('IFNULL(other_criteria.avers, "") as avers'),
            DB::raw('IFNULL(other_criteria.revers, "") as revers'),
            DB::raw('IFNULL(other_criteria.coin_edge, "") as coin_edge'),
            DB::raw('IFNULL(other_criteria.century, "") as century'),
            DB::raw('IFNULL(other_criteria.metal, "") as metal'),
            DB::raw('IFNULL(other_criteria.quality, "") as quality'),
            DB::raw('IFNULL(other_criteria.price_by_krause, "") as price_by_krause')
        )
            ->when($columns, function ($query, $columns) {
                if (!empty($columns)) {
                    return $query->where($columns[0], "!=", "")->orderBy($columns[0], "asc");
                }
            })
            ->join("items", "items.currency", "=", "currencies.code")
            ->join("collections", "collections.item", "=", "items.id")
            ->join("continents", "continents.code", "=", "collections.continent")
            ->join("countries", "countries.code", "=", "collections.country")
            ->join("numerical_values", "numerical_values.id", "=", "items.numerical_value")
            ->join("other_criteria", "other_criteria.id", "=", "items.other_criteria")
            ->get();

        return $result;
    }

    public static function getCurrencyName($code)
    {
        return Currency::select("name")->where("code", $code)->get()[0]->name;
    }
}
