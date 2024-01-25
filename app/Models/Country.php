<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $primaryKey = 'code';

    public function collections()
    {
        return $this->hasMany('App\Models\Collections');
    }

    public static function getCountriesByContinent($continentCode)
    {
        $result = Country::select("code AS country_code", "country_name")
            ->where("continent_code", $continentCode)
            ->get();
        return $result;
    }

    public static function getCountriesByCode($code)
    {
        $result = Country::select("code", "country_name", "full_name")
            ->whereIn("code", $code)
            ->get();
        return $result;
    }
}
