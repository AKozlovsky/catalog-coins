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
            "currencies.name AS name",
            "currencies.code AS code",
            "currencies.symbol AS symbol",
        )
            ->when($columns, function ($query, $columns) {
                if (!empty($columns)) {
                    return $query->where($columns[0], "!=", "")->orderBy($columns[0], "asc");
                }
            })
            ->get();

        return $result;
    }

    public static function getCurrencyName($code)
    {
        return Currency::select("name")->where("code", $code)->get()[0]->name;
    }
}
