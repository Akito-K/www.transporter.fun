<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProgress extends Model
{
    use softDeletes;
    protected $table = 'order_progresses';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = OrderProgress::where('order_id', $unique_id)->orderBy('id', 'DESC')->get();

        return $datas;
    }

}
