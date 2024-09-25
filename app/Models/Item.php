<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = ["currency", "numerical_value", "photo", "other_criteria"];

    public function collections()
    {
        return $this->hasMany('App\Models\Collections');
    }

    public function currencies()
    {
        return $this->belongsTo('App\Models\Currencies');
    }

    public function numerical_values()
    {
        return $this->belongsTo('App\Models\NumericalValues');
    }

    public function other_criteria()
    {
        return $this->belongsTo('App\Models\OtherCriteria');
    }
}
