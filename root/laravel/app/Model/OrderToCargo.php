<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderToCargo extends Model
{
    use softDeletes;
    protected $table = 'order_to_cargos';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = OrderToCargo::where('order_id', $unique_id)->get();

        return $datas;
    }
}
