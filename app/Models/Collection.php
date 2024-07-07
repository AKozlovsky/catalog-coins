<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    const CONTINENTS = "continents",
        COUNTRIES = "countries",
        MONARCHS = "monarchs",
        REIGN_PERIODS = "reign-periods",
        MINTAGE_YEARS = "mintage_years",
        AVERS = "avers",
        REVERS = "revers",
        COIN_EDGES = "coin-edges",
        CURRENCIES = "currencies",
        CENTURIES = "centuries",
        METALS = "metals",
        QUALITIES = "qualities",
        PRICES_BY_KRAUSE = "prices_by_krause";

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
        } elseif (strpos($httpReferer, "monarchs")) {
            $type = self::MONARCHS;
        } elseif (strpos($httpReferer, "reign-periods")) {
            $type = self::REIGN_PERIODS;
        } elseif (strpos($httpReferer, "mintage-years")) {
            $type = self::MINTAGE_YEARS;
        } elseif (strpos($httpReferer, "avers")) {
            $type = self::AVERS;
        } elseif (strpos($httpReferer, "revers")) {
            $type = self::REVERS;
        } elseif (strpos($httpReferer, "coin-edges")) {
            $type = self::COIN_EDGES;
        } elseif (strpos($httpReferer, "currencies")) {
            $type = self::CURRENCIES;
        } elseif (strpos($httpReferer, "centuries")) {
            $type = self::CENTURIES;
        } elseif (strpos($httpReferer, "metals")) {
            $type = self::METALS;
        } elseif (strpos($httpReferer, "qualities")) {
            $type = self::QUALITIES;
        } elseif (strpos($httpReferer, "prices-by-krause")) {
            $type = self::PRICES_BY_KRAUSE;
        }

        $result = Collection::select(
            'collections.id AS id',
            'countries.code AS country_code',
            'countries.country_name AS country',
            'currencies.name AS currency',
            'currencies.code AS code',
            'currencies.symbol AS symbol',
            'numerical_values.value AS numerical_value',
            'other_criteria.monarch AS monarch',
            'other_criteria.reign_period_from AS reign_period_from',
            'other_criteria.reign_period_to AS reign_period_to',
            'other_criteria.mintage_year AS mintage_year',
            'other_criteria.avers AS avers',
            'other_criteria.revers AS revers',
            'other_criteria.coin_edge AS coin_edge',
            'other_criteria.century AS century',
            'other_criteria.metal AS metal',
            'other_criteria.quality AS quality',
            'other_criteria.price_by_krause AS price_by_krause'
        )
            ->when($type, function ($query, $type) {
                switch ($type) {
                    case self::CONTINENTS:
                        return $query->join('continents', 'collections.continent', '=', 'continents.code');
                }
            })
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.code')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.value')
            ->join('other_criteria', 'items.other_criteria', '=', 'other_criteria.item')
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
                        case self::MONARCHS:
                            return $query
                                ->orWhere('other_criteria.monarch', 'LIKE', "%{$search}%");
                        case self::REIGN_PERIODS:
                            return $query
                                ->orWhere('other_criteria.reign_period_from', 'LIKE', "%{$search}%")
                                ->orWhere('other_criteria.reign_period_to', 'LIKE', "%{$search}%");
                        case self::MINTAGE_YEARS:
                            return $query
                                ->orWhere('other_criteria.mintage_year', 'LIKE', "%{$search}%");
                        case self::AVERS:
                            return $query
                                ->orWhere('other_criteria.avers', 'LIKE', "%{$search}%");
                        case self::REVERS:
                            return $query
                                ->orWhere('other_criteria.revers', 'LIKE', "%{$search}%");
                        case self::COIN_EDGES:
                            return $query
                                ->orWhere('other_criteria.coin_edge', 'LIKE', "%{$search}%");
                        case self::CURRENCIES:
                            return $query
                                ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                                ->orWhere('currencies.code', 'LIKE', "%{$search}%")
                                ->orWhere('currencies.symbol', 'LIKE', "%{$search}%");
                        case self::CENTURIES:
                            return $query
                                ->orWhere('other_criteria.century', 'LIKE', "%{$search}%");
                        case self::METALS:
                            return $query
                                ->orWhere('other_criteria.metal', 'LIKE', "%{$search}%");
                        case self::QUALITIES:
                            return $query
                                ->orWhere('other_criteria.quality', 'LIKE', "%{$search}%");
                        case self::PRICES_BY_KRAUSE:
                            return $query
                                ->orWhere('price_by_krause.price_by_krause', 'LIKE', "%{$search}%");
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
                        case self::MONARCHS:
                            return $query->where('other_criteria.monarch', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::REIGN_PERIODS:
                            return $query->where('other_criteria.reign_period_from', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::MINTAGE_YEARS:
                            return $query->where('other_criteria.mintage_year', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::AVERS:
                            return $query->where('other_criteria.avers', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::REVERS:
                            return $query->where('other_criteria.revers', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::COIN_EDGES:
                            return $query->where('other_criteria.coin_edge', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::CURRENCIES:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::CENTURIES:
                            return $query->where('other_criteria.century', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::METALS:
                            return $query->where('other_criteria.metal', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::QUALITIES:
                            return $query->where('other_criteria.quality', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::PRICES_BY_KRAUSE:
                            return $query->where('other_criteria.price_by_krause', 'LIKE', "%{$columns[0]["search"]["value"]}%");
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
                        case self::REIGN_PERIODS:
                            return $query->where('other_criteria.reign_period_to', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                        case self::CURRENCIES:
                            return $query->where('currencies.code', 'LIKE', "%{$columns[1]["search"]["value"]}%");
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
                        case self::CURRENCIES:
                            return $query->where('currencies.symbol', 'LIKE', "%{$columns[2]["search"]["value"]}%");
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
        } elseif (strpos($httpReferer, "monarchs")) {
            $type = self::MONARCHS;
        } elseif (strpos($httpReferer, "reign-periods")) {
            $type = self::REIGN_PERIODS;
        } elseif (strpos($httpReferer, "mintage-years")) {
            $type = self::MINTAGE_YEARS;
        } elseif (strpos($httpReferer, "avers")) {
            $type = self::AVERS;
        } elseif (strpos($httpReferer, "revers")) {
            $type = self::REVERS;
        } elseif (strpos($httpReferer, "coin-edges")) {
            $type = self::COIN_EDGES;
        } elseif (strpos($httpReferer, "currencies")) {
            $type = self::CURRENCIES;
        } elseif (strpos($httpReferer, "centuries")) {
            $type = self::CENTURIES;
        } elseif (strpos($httpReferer, "metals")) {
            $type = self::METALS;
        } elseif (strpos($httpReferer, "qualities")) {
            $type = self::QUALITIES;
        } elseif (strpos($httpReferer, "prices-by-krause")) {
            $type = self::PRICES_BY_KRAUSE;
        }

        $result = Collection::when($type, function ($query, $type) {
            switch ($type) {
                case self::CONTINENTS:
                    return $query->join('continents', 'collections.continent', '=', 'continents.code');
            }
        })
            ->join('countries', 'collections.country', '=', 'countries.code')
            ->join('items', 'collections.item', '=', 'items.id')
            ->join('currencies', 'items.currency', '=', 'currencies.code')
            ->join('numerical_values', 'items.numerical_value', '=', 'numerical_values.value')
            ->join('other_criteria', 'items.other_criteria', '=', 'other_criteria.item')
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
                    case self::MONARCHS:
                        return $query
                            ->orWhere('other_criteria.monarch', 'LIKE', "%{$search}%");
                    case self::REIGN_PERIODS:
                        return $query
                            ->orWhere('other_criteria.reign_period_from', 'LIKE', "%{$search}%")
                            ->orWhere('other_criteria.reign_period_to', 'LIKE', "%{$search}%");
                    case self::MINTAGE_YEARS:
                        return $query
                            ->orWhere('other_criteria.mintage_year', 'LIKE', "%{$search}%");
                    case self::AVERS:
                        return $query
                            ->orWhere('other_criteria.avers', 'LIKE', "%{$search}%");
                    case self::REVERS:
                        return $query
                            ->orWhere('other_criteria.revers', 'LIKE', "%{$search}%");
                    case self::COIN_EDGES:
                        return $query
                            ->orWhere('other_criteria.coin_edge', 'LIKE', "%{$search}%");
                    case self::CURRENCIES:
                        return $query
                            ->orWhere('currencies.name', 'LIKE', "%{$search}%")
                            ->orWhere('currencies.code', 'LIKE', "%{$search}%")
                            ->orWhere('currencies.symbol', 'LIKE', "%{$search}%");
                    case self::CENTURIES:
                        return $query
                            ->orWhere('other_criteria.century', 'LIKE', "%{$search}%");
                    case self::METALS:
                        return $query
                            ->orWhere('other_criteria.metal', 'LIKE', "%{$search}%");
                    case self::QUALITIES:
                        return $query
                            ->orWhere('other_criteria.quality', 'LIKE', "%{$search}%");
                    case self::PRICES_BY_KRAUSE:
                        return $query
                            ->orWhere('other_criteria.price_by_krause', 'LIKE', "%{$search}%");
                }
            })
            ->where(function ($query) use ($type, $columns) {
                if (!empty($columns[0]["search"]["value"])) {
                    switch ($type) {
                        case self::CONTINENTS:
                            return $query->where('countries.country_name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::COUNTRIES:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::MONARCHS:
                            return $query->where('other_criteria.monarch', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::REIGN_PERIODS:
                            return $query->where('other_criteria.reign_period_from', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::MINTAGE_YEARS:
                            return $query->where('other_criteria.mintage_year', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::AVERS:
                            return $query->where('other_criteria.avers', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::REVERS:
                            return $query->where('other_criteria.revers', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::COIN_EDGES:
                            return $query->where('other_criteria.coin_edge', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::CURRENCIES:
                            return $query->where('currencies.name', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::CENTURIES:
                            return $query->where('other_criteria.century', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::METALS:
                            return $query->where('other_criteria.metal', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::QUALITIES:
                            return $query->where('other_criteria.quality', 'LIKE', "%{$columns[0]["search"]["value"]}%");
                        case self::PRICES_BY_KRAUSE:
                            return $query->where('other_criteria.price_by_krause', 'LIKE', "%{$columns[0]["search"]["value"]}%");
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
                        case self::REIGN_PERIODS:
                            return $query->where('other_criteria.reign_period_to', 'LIKE', "%{$columns[1]["search"]["value"]}%");
                        case self::CURRENCIES:
                            return $query->where('currencies.code', 'LIKE', "%{$columns[1]["search"]["value"]}%");
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
                        case self::CURRENCIES:
                            return $query->where('currencies.symbol', 'LIKE', "%{$columns[2]["search"]["value"]}%");
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
