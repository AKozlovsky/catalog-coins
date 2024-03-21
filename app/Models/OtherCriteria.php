<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCriteria extends Model
{
    use HasFactory;

    protected $table = 'other_criteria';
    protected $primaryKey = 'id';

    public function items()
    {
        return $this->hasMany('App\Models\Items');
    }

    public static function getData($columns)
    {
        $result = OtherCriteria::select("*")
            ->when($columns, function ($query, $columns) {
                if (!empty($columns)) {
                    return $query->orderBy($columns[0], "asc");
                }
            })
            ->get();
        return $result;
    }
}
