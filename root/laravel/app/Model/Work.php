<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use softDeletes;
    protected $table = 'works';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'WRK-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($carrier_id){
        $datas = Work::where('carrier_id', $carrier_id)->orderBy('id', 'DESC')->get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = Work::where('work_id', $unique_id)->first();

        return $data;
    }
}
