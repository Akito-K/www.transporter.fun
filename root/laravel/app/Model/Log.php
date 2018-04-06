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

    public static function saveData ( $controller, $target=NULL, $value=NULL, $result=NULL ){
        $user_id = \Auth::user()->user_id;
        $data = [
            'user_id' => $user_id,
            'controller' => $controller,
            'target' => $target,
            'value' => $value,
            'result' => $result,
            'created_at' => new \Datetime(),
        ];

        Log::insert( $data );
    }

    public static function saveCronData ( $controller, $target=NULL, $value=NULL, $result=NULL ){
        $user_id = 'cron';
        $data = [
            'user_id' => $user_id,
            'controller' => $controller,
            'target' => $target,
            'value' => $value,
            'result' => $result,
            'created_at' => new \Datetime(),
        ];

        Log::insert( $data );
    }

    // データ取得
    public static function getCount(){
        return Log::count();
    }

    public static function getLogs($offset, $limit){
        $datas = Log::orderBy('created_at', 'DESC')->offset($offset)->limit($limit)->get();

        return $datas;
    }

}
