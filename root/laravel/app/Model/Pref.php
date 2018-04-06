<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pref extends Model
{
    protected $table = 'prefs';
    protected $dates = ['created_at'];
    protected $guarded = ['id'];

    public static function getDatas(){
        $datas = Pref::get();

        return $datas;
    }

    public static function getData($code){
        $data = Pref::where('code', $code)->first();

        return $data;
    }

}
