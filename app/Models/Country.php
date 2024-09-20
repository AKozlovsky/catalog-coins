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
        return $this->hasMany('App\Models\Collections');
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
        $result = Country::where("country_name", $country)->pluck("code");

        return $result[0];
    }
}
