<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumericalValue extends Model
{
    use HasFactory;
    protected $table = 'numerical_values';
    protected $primaryKey = 'id';
    protected $fillable = ["value"];

    public function items()
    {
        return $this->hasMany('App\Models\Items');
    }

    public static function getValue($id)
    {
        return NumericalValue::select("value")->where("id", $id)->get()[0];
    }
}
