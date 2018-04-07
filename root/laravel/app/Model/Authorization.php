<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authorization extends Model
{
    use softDeletes;
    protected $table = 'authorizations';
    protected $dates = ['limit_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getNewCode(){
        return \Func::getRandStr("Aa0", 64);
    }

    public static function getData($code){
        $data = Authorization::where('code', $code)->first();

        return $data;
    }

}
