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
}
