<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarrierEquipmentValue extends Model
{
    use softDeletes;
    protected $table = 'carrier_equipment_values';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = CarrierEquipmentValue::where('carrier_id', $unique_id)->get();

        return $datas;
    }

}
