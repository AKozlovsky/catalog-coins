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
}
