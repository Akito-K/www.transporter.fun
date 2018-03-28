<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use softDeletes;
    protected $table = 'reports';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'RPT-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($order_id){
        $datas = Report::where('order_id', $order_id)->get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = Report::where('report_id', $unique_id)->first();

        return $data;
    }

}
