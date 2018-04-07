<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SignupKey extends Model
{
    protected $table = 'signup_keys';
    protected $dates = ['created_at', 'limit_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getNewKey(){
        return \Func::getRandStr("Aa0", 64);
    }

    public static function getData($key){
        $data = SignupKey::where('key', $key)->first();

        return $data;
    }

}
