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


    private static $hide_owners = [
        0 => '公開する',
        1 => '公開しない',
    ];

    public static function getHideOwners(){
        return Order::$hide_owners;
    }

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
        $ary = [];
        $datas = Order::where('owner_id', $owner_id)->orderBy('status_id', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                $data->send = Order::getSendAddress($data);
                $data->arrive = Order::getArriveAddress($data);
                $data->send_tels = \Func::telFormatDecode($data->send_tel);
                $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getData($unique_id){
        $data = Order::where('order_id', $unique_id)->first();
        $data->send = Order::getSendAddress($data);
        $data->arrive = Order::getArriveAddress($data);
        $data->send_tels = \Func::telFormatDecode($data->send_tel);
        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);

        return $data;
    }

    public static function getSendAddress($data){
        $ary = [
            'sei' => $data->send_sei,
            'mei' => $data->send_mei,
            'zip1' => $data->send_zip1,
            'zip2' => $data->send_zip2,
            'pref_code' => $data->send_pref_code,
            'city' => $data->send_city,
            'address' => $data->send_address,
            'tel' => $data->send_tel,
        ];

        return (object) $ary;
    }

    public static function getArriveAddress($data){
        $ary = [
            'sei' => $data->arrive_sei,
            'mei' => $data->arrive_mei,
            'zip1' => $data->arrive_zip1,
            'zip2' => $data->arrive_zip2,
            'pref_code' => $data->arrive_pref_code,
            'city' => $data->arrive_city,
            'address' => $data->arrive_address,
            'tel' => $data->arrive_tel,
        ];

        return (object) $ary;
    }

}
