<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use softDeletes;
    protected $table = 'areas';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNames(){
        return Area::pluck('name', 'area_id')->toArray();
    }


}
