<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use softDeletes;
    protected $table = 'logs';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas(){
        $datas = Log::all();

        return $datas;
    }

}
