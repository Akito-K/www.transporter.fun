<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportTemp extends Model
{
    use softDeletes;
    protected $table = 'report_temps';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = ReportTemp::where('report_id', $unique_id)->get();

        return $datas;
    }

}
