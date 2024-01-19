<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;
    protected $table = 'continents';
    protected $primaryKey = 'id';

    public function collections()
    {
        return $this->hasMany('App\Models\Collections');
    }

    public static function getCode($continent)
    {
        $result = Continent::where("continent_name", $continent)->pluck("code");

        return $result[0];
    }
}
