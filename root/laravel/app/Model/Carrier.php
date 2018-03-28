<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrier extends Model
{
    use softDeletes;
    protected $table = 'carriers';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CRR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Carrier::where('carrier_id', $unique_id)->first();

        return $data;
    }

}
