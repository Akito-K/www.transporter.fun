<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargoValue extends Model
{
    use softDeletes;
    protected $table = 'cargo_values';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = CargoValue::where('cargo_id', $unique_id)->get();

        return $datas;
    }
}
