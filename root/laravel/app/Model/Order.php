<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use softDeletes;
    protected $table = 'orders';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    private static $timezones = [
        '0' => '未定',
        '1' => '午前中',
        '2' => '12～16時',
        '3' => '16～20時',
        '4' => '夜間',
    ];

    public static function getTimezones(){
        return Order::$timezones;
    }

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ORD-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($owner_id){
        $datas = Order::where('owner_id', $owner_id)->orderBy('status_code', 'ASC')->get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = Order::where('order_id', $unique_id)->first();

        return $data;
    }

}
