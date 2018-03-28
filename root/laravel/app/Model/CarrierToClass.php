<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarrierToClass extends Model
{
    use softDeletes;
    protected $table = 'carrier_to_classes';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = CarrierToClass::where('carrier_id', $unique_id)->get();

        return $datas;
    }

}
