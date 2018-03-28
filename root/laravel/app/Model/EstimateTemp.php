<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateTemp extends Model
{
    use softDeletes;
    protected $table = 'estimate_temps';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = EstimateTemp::where('estimate_id', $unique_id)->get();

        return $datas;
    }

}
