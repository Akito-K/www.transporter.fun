<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarrierToCar extends Model
{
    use softDeletes;
    protected $table = 'carrier_to_cars';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = CarrierToCar::where('carrier_id', $unique_id)->get();

        return $datas;
    }

}
