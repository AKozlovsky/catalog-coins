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
        return $this->hasMany('App\Models\Collection');
    }

    public function currencies()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function numerical_values()
    {
        return $this->belongsTo('App\Models\NumericalValue');
    }

    public function other_criteria()
    {
        return $this->belongsTo('App\Models\OtherCriteria');
    }

    public static function getCount()
    {
        return Item::select()->count();
    }

    public static function getTotalThisWeek()
    {
        $actualWeek = Common::getActualWeek();
        $result = Item::select()->whereBetween("created_at", $actualWeek)->count();

        return $result;
    }

    public static function getItem($id)
    {
        return Item::select()->where("id", $id)->get()[0];
    }
}
