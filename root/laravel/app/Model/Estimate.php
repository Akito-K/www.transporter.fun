<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estimate extends Model
{
    use softDeletes;
    protected $table = 'estimates';
    protected $dates = ['estimated_at', 'limit_at', 'suggested_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ETM-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Estimate::where('estimate_id', $unique_id)->first();

        return $data;
    }

    public static function getCount($order_id){
        return Estimate::where('order_id', $order_id)->whereNotNull('suggested_at')->count();
    }

    public static function getMyEstimate($order_id, $carrier_id=NULL){
        $carrier_id = $carrier_id?: \Auth::user()->carrier_id;
        $data = Estimate::where('order_id', $order_id)
                            ->where('carrier_id', $carrier_id)
                            ->whereNotNull('suggested_at')
                            ->orderBy('id', 'DESC')
                            ->first();

        return $data;
    }

}
