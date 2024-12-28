<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Continent extends Model
{
    use HasFactory;
    protected $table = 'continents';
    protected $primaryKey = 'id';

    public function collections()
    {
        return $this->hasMany('App\Models\Collection');
    }

    public static function getCode($continent)
    {
        return Continent::where("continent_name", $continent)->pluck("code")[0];
    }

    public static function getContinents()
    {
        return json_decode(File::get('assets/json/continents.json'));
    }

    public static function getContinentName($code)
    {
        return Continent::where("code", $code)->pluck("continent_name")[0];
    }
}
