<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarValue extends Model
{
    use softDeletes;
    protected $table = 'car_values';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = CarValue::where('car_id', $unique_id)->get();

        return $datas;
    }

}
