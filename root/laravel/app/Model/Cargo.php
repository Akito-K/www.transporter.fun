<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\OrderToCargo;

class Cargo extends Model
{
    use softDeletes;
    protected $table = 'cargos';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CGO-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Cargo::where('cargo_id', $unique_id)->first();

        return $data;
    }







    public static function saveData( $request_data, $order_id ){
        $date_at = new \Datetime();
        $request_data = (object) $request_data;
        // OrderToCargo
        $cargo_id = Cargo::getNewId();
        $data = [
            'order_id' => $order_id,
            'cargo_id' => $cargo_id,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        OrderToCargo::insert($data);

        // Cargo
        $data = [
            'cargo_id' => $cargo_id,
            'name_id' => $request_data->cargo_name,
            'length' => $request_data->cargo_size_L,
            'width' => $request_data->cargo_size_W,
            'height' => $request_data->cargo_size_H,
            'count' => $request_data->cargo_count,
            'weight' => $request_data->cargo_weight,
            'form_id' => $request_data->cargo_form,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Cargo::insert($data);
    }

}
