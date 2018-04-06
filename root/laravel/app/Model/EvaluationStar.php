<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationStar extends Model
{
    use softDeletes;
    protected $table = 'evaluation_stars';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'EVS-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($unique_id){
        $datas = EvaluationStar::where('evaluation_id', $unique_id)->get();

        return $datas;
    }
}
