<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargoForm extends Model
{
    use softDeletes;
    protected $table = 'cargo_forms';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CGF-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = CargoForm::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = CargoForm::where('form_id', $unique_id)->first();

        return $data;
    }
}
