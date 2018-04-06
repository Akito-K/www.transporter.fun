<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use softDeletes;
    protected $table = 'order_statuses';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'OST-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = OrderStatus::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = OrderStatus::where('status_id', $unique_id)->first();

        return $data;
    }

}
