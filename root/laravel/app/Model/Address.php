<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use softDeletes;
    protected $table = 'addresses';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ADR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Address::where('address_id', $unique_id)->first();

        return $data;
    }

}
