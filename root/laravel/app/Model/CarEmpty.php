<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarEmpty extends Model
{
    use softDeletes;
    protected $table = 'car_empties';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = CarEmpty::where('carrier_id', $unique_id)->get();

        return $datas;
    }

}
