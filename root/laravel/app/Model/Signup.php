<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $table = 'signups';
    protected $dates = ['created_at', 'limit_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getNewKey(){
        return \Func::getRandStr("Aa0", 64);
    }

    public static function getData($key){
        $data = Signup::where('key', $key)->first();
        if($data){
            $data->mobiles = \Func::telFormatDecode($data->mobile);
            $data->tels = \Func::telFormatDecode($data->tel);
        }

        return $data;
    }
}
