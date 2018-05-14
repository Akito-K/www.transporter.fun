<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use softDeletes;
    protected $table = 'items';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ITM-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($carrier_id){
        $datas = Item::where('carrier_id', $carrier_id)->orderBy('id', 'DESC')->get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = Item::where('item_id', $unique_id)->first();

        return $data;
    }

    public static function getNames($carrier_id){
        $datas = Item::where('carrier_id', $carrier_id)->orderBy('id', 'DESC')->pluck('name', 'item_id')->toArray();

        return $datas;
    }


}
