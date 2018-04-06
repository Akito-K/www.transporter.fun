<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargoName extends Model
{
    use softDeletes;
    protected $table = 'cargo_names';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CGN-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = CargoName::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = CargoName::where('name_id', $unique_id)->first();

        return $data;
    }
}
