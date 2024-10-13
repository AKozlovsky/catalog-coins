<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OtherCriteria extends Model
{
    use HasFactory;

    protected $table = 'other_criteria';
    protected $primaryKey = 'id';
    protected $fillable = [
        "monarch",
        "reign_period_from",
        "reign_period_to",
        "mintage_year",
        "avers",
        "revers",
        "coin_edge",
        "century",
        "metal",
        "quality",
        "price_by_krause"
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Items');
    }

    public static function getData($columns)
    {
        $result = OtherCriteria::select(
            "collections.id AS id",
            "continents.continent_name AS continent",
            "countries.country_name AS country",
            "currencies.name AS currency",
            "currencies.symbol AS symbol",
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
            ->join("items", "items.other_criteria", "=", "other_criteria.id")
            ->join("collections", "collections.item", "=", "items.id")
            ->join("continents", "continents.code", "=", "collections.continent")
            ->join("countries", "countries.code", "=", "collections.country")
            ->join("currencies", "currencies.code", "=", "items.currency")
            ->join("numerical_values", "numerical_values.id", "=", "items.numerical_value")
            ->get();

        return $result;
    }

    public static function getColumns()
    {
        return [
            "monarch",
            "reign_period_from",
            "reign_period_to",
            "mintage_year",
            "avers",
            "revers",
            "coin_edge",
            "century",
            "metal",
            "quality",
            "price_by_krause"
        ];
    }
}
