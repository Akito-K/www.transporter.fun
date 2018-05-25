<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusLog extends Model
{
    use softDeletes;
    protected $table = 'status_logs';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = StatusLog::where('order_id', $unique_id)->orderBy('id', 'DESC')->get();

        return $datas;
    }

    public static function saveData($id_name, $unique_id, $status_id, $method, $user_id=NULL){
        $user_id = $user_id?: \Auth::user()->user_id;
        $data = new StatusLog;
        $data->id_name   = $id_name;
        $data->unique_id = $unique_id;
        $data->status_id = $status_id;
        $data->method    = $method;
        $data->user_id   = $user_id;
        $data->save();
    }
}
