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

    public static function getCollection($continent, $limit = null, $start = 0, $order = null, $dir = "asc")
    {
        $result = Collection::select('countries.code AS country_code', 'countries.country_name AS country', 'currencies.name AS currency', 'currencies.symbol AS symbol', 'numerical_values.value as numerical_value')
            ->join('continents', 'collections.continent', '=', 'continents.code')
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.id')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.id')
            ->where('continents.continent_name', '=', $continent)
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        return $result;
    }

    public static function getTotalCollections($continent, $limit, $start, $order, $dir)
    {
        return Collection::getCollection($continent, $limit, $start, $order, $dir)->count();
    }
}
