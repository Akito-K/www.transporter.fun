<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRequestOption extends Model
{
    use softDeletes;
    protected $table = 'order_request_options';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($type){
        $datas = OrderRequestOption::where('type', $type)->get();

        return $datas;
    }

}
