<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargoCategory extends Model
{
    use softDeletes;
    protected $table = 'cargo_categories';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CGC-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas(){
        $datas = CargoCategory::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = CargoCategory::where('category_id', $unique_id)->first();

        return $data;
    }
}
