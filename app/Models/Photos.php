<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    protected $table = 'photos';
    protected $primaryKey = 'id';

    public function items()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public static function getPhotos($item)
    {
        return Photos::select()->where("item", $item)->get();
    }
}