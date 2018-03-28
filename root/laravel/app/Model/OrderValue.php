<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderValue extends Model
{
    use softDeletes;
    protected $table = 'order_values';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = OrderValue::where('order_id', $unique_id)->get();

        return $datas;
    }

}
