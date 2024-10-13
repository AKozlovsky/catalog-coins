<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currencies';
    protected $primaryKey = 'id';

    public function items()
    {
        return $this->hasMany('App\Models\Items');
    }

    public static function getData($columns = [])
    {
        $result = Currency::select(
            "currencies.*",
            "continents.continent_name AS continent",
            "countries.country_name AS country",
            "numerical_values.value AS value"
        )
            ->when($columns, function ($query, $columns) {
                if (!empty($columns)) {
                    return $query->orderBy($columns[0], "asc");
                }
            })
            ->join("items", "items.currency", "=", "currencies.code")
            ->join("collections", "collections.item", "=", "items.id")
            ->join("continents", "continents.code", "=", "collections.continent")
            ->join("countries", "countries.code", "=", "collections.country")
            ->join("numerical_values", "numerical_values.id", "=", "items.numerical_value")
            ->get();

        return $result;
    }

    public static function getCurrencyName($code)
    {
        return Currency::select("name")->where("code", $code)->get()[0]->name;
    }
}
