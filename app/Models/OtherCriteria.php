<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCriteria extends Model
{
    use HasFactory;

    protected $table = 'other_criteria';
    protected $primaryKey = 'id';
    protected $fillable = ["monarch", "reign_period_from", "reign_period_to", "mintage_year", "avers", "revers", "coin_edge", "century", "metal", "quality", "price_by_krause"];

    public function items()
    {
        return $this->hasMany('App\Models\Items');
    }

    public static function getData($columns)
    {
        $result = OtherCriteria::select("*")
            ->when($columns, function ($query, $columns) {
                if (!empty($columns)) {
                    return $query->where($columns[0], "!=", "")->orderBy($columns[0], "asc");
                }
            })
            ->get();
        //     ->toSql();
        // dump($result);
        // exit;
        return $result;
    }

    public static function getColumns()
    {
        return ["monarch", "reign_period_from", "reign_period_to", "mintage_year", "avers", "revers", "coin_edge", "century", "metal", "quality", "price_by_krause"];
    }
}
