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

    public static function getCollection($continent, $limit, $start, $order, $dir, $search = "", $columns = [])
    {
        $result = Collection::select(
            'collections.id',
            'countries.code AS country_code',
            'countries.country_name AS country',
            'currencies.name AS currency',
            'currencies.symbol AS symbol',
            'numerical_values.value as numerical_value'
        )
            ->join('continents', 'collections.continent', '=', 'continents.code')
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.id')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.id')
            ->where('continents.continent_name', '=', $continent)
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    return $query
                        ->orWhere('countries.country_name', 'LIKE', "%{$search}%")
                        ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                        ->orWhere('currencies.symbol', 'LIKE', "%{$search}%")
                        ->orWhere('numerical_values.value', 'LIKE', "%{$search}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[0]["search"]["value"])) {
                    return $query->where('countries.country_name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[1]["search"]["value"])) {
                    return $query->where('currencies.name', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[2]["search"]["value"])) {
                    return $query->where('currencies.symbol', 'LIKE', "%{$columns[2]["search"]["value"]}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[3]["search"]["value"])) {
                    return $query->where('numerical_values.value', 'LIKE', "%{$columns[3]["search"]["value"]}%");
                }
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        return $result;
    }

    public static function getTotalCollections($continent, $search = "", $columns = [])
    {
        $result = Collection::join('continents', 'collections.continent', '=', 'continents.code')
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.id')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.id')
            ->where('continents.continent_name', '=', $continent)
            ->where(function ($query) use ($search) {
                return $query
                    ->orWhere('countries.country_name', 'LIKE', "%{$search}%")
                    ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                    ->orWhere('currencies.symbol', 'LIKE', "%{$search}%")
                    ->orWhere('numerical_values.value', 'LIKE', "%{$search}%");
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[0]["search"]["value"])) {
                    return $query->where('countries.country_name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[1]["search"]["value"])) {
                    return $query->where('currencies.name', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[2]["search"]["value"])) {
                    return $query->where('currencies.symbol', 'LIKE', "%{$columns[2]["search"]["value"]}%");
                }
            })
            ->where(function ($query) use ($columns) {
                if (!empty($columns[3]["search"]["value"])) {
                    return $query->where('numerical_values.value', 'LIKE', "%{$columns[3]["search"]["value"]}%");
                }
            })
            ->count();

        return $result;
    }
}
