<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use softDeletes;
    protected $table = 'cars';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CAR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getAllDatas(){
        $datas = Car::all();

        return $datas;
    }

    public static function getDatas($carrier_id){
        $datas = Car::where('carrier_id', $carrier_id)->get();

        return $datas;
    }

    public static function getAllCars(){
        $ary = [];
        $datas = Car::getAllDatas();
        if(!empty($datas)){
            foreach($datas as $data){
                $ary[ $data->car_id ] = $data;
            }
        }

        return $ary;
    }

    public static function getCars($carrier_id){
        $ary = [];
        $datas = Car::getDatas($carrier_id);
        if(!empty($datas)){
            foreach($datas as $data){
                $ary[ $data->car_id ] = $data;
            }
        }

        return $ary;
    }

    public static function getNames($carrier_id){
        $datas = Car::where('carrier_id', $carrier_id)->pluck('name', 'car_id');

        return $datas? $datas->toArray(): NULL;
    }

    public static function getData($unique_id){
        $data = Car::where('car_id', $unique_id)->first();

        return $data;
    }

    public static function getTotalCount($carrier_id){
        $datas = Car::getDatas($carrier_id);
        $count = 0;
        if(!empty($datas)){
            foreach($datas as $data){
                $count += $data->count;
            }
        }

        return $count;
    }

}
