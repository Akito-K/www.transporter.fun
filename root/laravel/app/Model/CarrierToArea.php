<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarrierToArea extends Model
{
    protected $table = 'carrier_to_areas';
    protected $dates = ['created_at'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function getDatas($unique_id){
        $datas = CarrierToArea::where('carrier_id', $unique_id)->get();

        return $datas;
    }
}
