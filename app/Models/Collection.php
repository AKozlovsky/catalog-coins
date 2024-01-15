<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $primaryKey = 'id';

    public function continents()
    {
        return $this->belongsTo(Continent::class, "continent");
    }

    public function countries()
    {
        return $this->belongsTo('App\Models\Countries');
    }

    public function items()
    {
        return $this->belongsTo('App\Models\Items');
    }

    public static function getCollection($continent)
    {
        $result = Collection::join('continents', 'collections.continent', '=', 'continents.code')
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.id')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.id')
            ->select('countries.code AS country_code', 'countries.country_name AS country', 'currencies.name AS currency', 'currencies.symbol', 'numerical_values.value')
            ->where('continents.continent_name', '=', $continent)
            ->get();

        return $result;
    }
}
