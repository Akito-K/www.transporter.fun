<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRequestOption extends Model
{
    use softDeletes;
    protected $table = 'order_request_options';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    private static $umu = [0 => '無', 1 => '有'];

    public static function getUmu(){
        return OrderRequestOption::$umu;
    }

    public static function getDatas(){
        $datas = OrderRequestOption::get();

        return $datas;
    }

    public static function getCarNamesNest($datas){
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if($data->type == 'car'){
                    $ary[ $data->class ][ $data->option_id ] = $data->name;
                }
            }
        }

        return $ary;
    }

    public static function getCarNames($datas){
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if($data->type == 'car'){
                    $ary[ $data->option_id ] = $data->name.'（'.$data->class.'）';
                }
            }
        }

        return $ary;
    }

    public static function getEquipments($datas){
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if($data->type == 'equipment'){
                    $ary[ $data->option_id ] = $data;
                }
            }
        }

        return $ary;
    }

    public static function getOtherNames($datas){
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if($data->type == 'other'){
                    $ary[ $data->option_id ] = $data->name;
                }
            }
        }

        return $ary;
    }

}
