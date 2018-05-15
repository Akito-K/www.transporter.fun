<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use softDeletes;
    protected $table = 'statuses';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas(){
        $datas = Status::get();

        return $datas;
    }

    public static function getNames(){
        return Status::pluck('name', 'status_id')->toArray();
    }

    public static function getData($unique_id){
        $data = Status::where('status_id', $unique_id)->first();

        return $data;
    }

    public static function getStatus($status_id, $status=NULL){
        $status = $status?: Status::getNames();

        return $status_id? $status[$status_id]: '見積り下書き';
    }
}
