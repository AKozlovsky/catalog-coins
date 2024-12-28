<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $primaryKey = 'code';
    public $incrementing = false;

    public function collections()
    {
        return $this->hasMany('App\Models\Collection');
    }

    public static function getCountries($columns, $code = null, $continentCode = null, $countryName = null)
    {
        $select = Country::select($columns);

        if ($code != null) {
            $select = $select->whereIn("code", $code);
        }

        if ($continentCode != null) {
            $select = $select->where("continent_code", $continentCode);
        }

        if ($countryName != null) {
            $select = $select->where("country_name", $countryName);
        }

        $result = $select->get();

        return $result;
    }

    public static function getCode($country)
    {
        return Country::where("country_name", $country)->pluck("code")[0];
    }

    public static function getCountryName($code)
    {
        return Country::where("code", $code)->pluck("country_name")[0];
    }
}
