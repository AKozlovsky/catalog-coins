<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    const CONTINENTS = "continents",
        COUNTRIES = "countries";

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

    public static function getCollections($input = null, $limit = 10, $start = 0, $order = "country_code", $dir = "asc", $search = "", $columns = [])
    {
        $httpReferer = $_SERVER["HTTP_REFERER"];
        $type = "";

        if (strpos($httpReferer, "continents")) {
            $type = self::CONTINENTS;
        } elseif (strpos($httpReferer, "countries")) {
            $type = self::COUNTRIES;
        }

        $result = Collection::select(
            'collections.id AS id',
            'countries.code AS country_code',
            'countries.country_name AS country',
            'currencies.name AS currency',
            'currencies.symbol AS symbol',
            'numerical_values.value AS numerical_value'
        )
            ->when($type, function ($query, $type) {
                switch ($type) {
                    case self::CONTINENTS:
                        return $query->join('continents', 'collections.continent', '=', 'continents.code');
                }
            })
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.id')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.id')
            ->where(function ($query) use ($type, $input) {
                if (!empty($input)) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('continents.continent_name', '=', $input);
                        case self::COUNTRIES:
                            return $query->where('countries.country_name', '=', $input);
                    }
                }
            })
            ->where(function ($query) use ($search, $type) {
                if (!empty($search)) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query
                                ->orWhere('countries.country_name', 'LIKE', "%{$search}%")
                                ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                                ->orWhere('currencies.symbol', 'LIKE', "%{$search}%")
                                ->orWhere('numerical_values.value', 'LIKE', "%{$search}%");
                        case self::COUNTRIES:
                            return $query
                                ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                                ->orWhere('currencies.symbol', 'LIKE', "%{$search}%")
                                ->orWhere('numerical_values.value', 'LIKE', "%{$search}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[0]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('countries.country_name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[1]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('currencies.symbol', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[2]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('currencies.symbol', 'LIKE', "%{$columns[2]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('numerical_values.value', 'LIKE', "%{$columns[2]["search"]["value"]}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[3]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('numerical_values.value', 'LIKE', "%{$columns[3]["search"]["value"]}%");
                    }
                }
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        return $result;
    }

    public static function getTotalCollections($input, $search = "", $columns = [])
    {
        $httpReferer = $_SERVER["HTTP_REFERER"];
        $type = "";

        if (strpos($httpReferer, "continents")) {
            $type = self::CONTINENTS;
        } elseif (strpos($httpReferer, "countries")) {
            $type = self::COUNTRIES;
        }

        $result = Collection::when($type, function ($query, $type) {
            switch ($type) {
                case self::CONTINENTS:
                    return $query->join('continents', 'collections.continent', '=', 'continents.code');
            }
        })
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.id')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.id')
            ->where(function ($query) use ($type, $input) {
                switch ($type) {
                    case self::CONTINENTS:
                        return $query->where('continents.continent_name', '=', $input);
                    case self::COUNTRIES:
                        return $query->where('countries.country_name', '=', $input);
                }
            })
            ->where(function ($query) use ($search, $type) {
                switch ($type) {
                    case self::CONTINENTS:
                        return $query
                            ->orWhere('countries.country_name', 'LIKE', "%{$search}%")
                            ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                            ->orWhere('currencies.symbol', 'LIKE', "%{$search}%")
                            ->orWhere('numerical_values.value', 'LIKE', "%{$search}%");
                    case self::COUNTRIES:
                        return $query
                            ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                            ->orWhere('currencies.symbol', 'LIKE', "%{$search}%")
                            ->orWhere('numerical_values.value', 'LIKE', "%{$search}%");
                }
            })
            ->where(function ($query) use ($type, $columns) {
                if (!empty($columns[0]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('countries.country_name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[1]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('currencies.symbol', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[2]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('currencies.symbol', 'LIKE', "%{$columns[2]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('numerical_values.value', 'LIKE', "%{$columns[2]["search"]["value"]}%");
                    }
                }
            })
            ->where(function ($query) use ($columns, $type) {
                if (!empty($columns[3]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('numerical_values.value', 'LIKE', "%{$columns[3]["search"]["value"]}%");
                    }
                }
            })
            ->count();

        return $result;
    }
}
