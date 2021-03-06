<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $dates = ['created_at'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function saveData ( $controller, $target=NULL, $value=NULL, $result=true ){
        $user_id = \Auth::check()? \Auth::user()->user_id: \Request::ip();
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
