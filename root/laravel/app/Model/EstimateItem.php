<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateItem extends Model
{
    use softDeletes;
    protected $table = 'estimate_items';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = EstimateItem::where('estimate_id', $unique_id)->get();

        return $datas;
    }

}
