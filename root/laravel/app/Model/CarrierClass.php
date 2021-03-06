<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarrierClass extends Model
{
    use softDeletes;
    protected $table = 'carrier_classes';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CCL-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = CarrierClass::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = CarrierClass::where('class_id', $unique_id)->first();

        return $data;
    }

    public static function getNames($flag_default=false){
        $ary = CarrierClass::pluck('name', 'class_id')->toArray();
        \Func::array_append($ary, [ 0 => '---' ], true);

        return $ary;
    }

    public static function getName($class_id){
        return CarrierClass::where('class_id', $class_id)->value('name');
    }

    public static function getClasses(){
        $ary = [];
        $datas = CarrierClass::orderBy('id', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                $data->img_num = str_replace('CLS-', '', $data->class_id);
                $ary[ $data->class_id ] = $data;
            }
        }

        return $ary;
    }


}
