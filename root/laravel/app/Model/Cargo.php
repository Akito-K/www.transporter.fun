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

    public static function addData(&$data, $order_id){
        $cargo_id = OrderToCargo::getCargoId($order_id);
        $cargo = Cargo::getData($cargo_id);
        $data->cargo_name   = $cargo->name_id;
        $data->cargo_size_L = $cargo->length;
        $data->cargo_size_W = $cargo->width;
        $data->cargo_size_H = $cargo->height;
        $data->cargo_count  = $cargo->count;
        $data->cargo_weight = $cargo->weight;
        $data->total_weight = $cargo->count * $cargo->weight;
        $data->cargo_form   = $cargo->form_id;
    }






    public static function duplicateData($old_order_id, $new_order_id){
        $date_at = new \Datetime();
        $old_relation_data = OrderToCargo::where('order_id', $old_order_id)->first();

        $old_cargo_id = $old_relation_data->cargo_id;
        $new_cargo_id = Cargo::getNewId();

        $old_cargo_data = Cargo::where('cargo_id', $old_cargo_id)->first();
        $new_cargo_data = $old_cargo_data->replicate();
        $new_cargo_data->cargo_id = $new_cargo_id;
        $new_cargo_data->save();

        $new_relation_data = $old_relation_data->replicate();
        $new_relation_data->order_id = $new_order_id;
        $new_relation_data->cargo_id = $new_cargo_id;
        $new_relation_data->save();
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

    public static function updateData( $request_data ){
        $date_at = new \Datetime();
        $request_data = (object) $request_data;
        $order_id = $request_data->order_id;

        $relation_data = OrderToCargo::where('order_id', $order_id)->first();
        $cargo_id = $relation_data->cargo_id;
        // Cargo
        $cargo_data = Cargo::where('cargo_id', $cargo_id)->first();
        $cargo_data->name_id = $request_data->cargo_name;
        $cargo_data->length = $request_data->cargo_size_L;
        $cargo_data->width = $request_data->cargo_size_W;
        $cargo_data->height = $request_data->cargo_size_H;
        $cargo_data->count = $request_data->cargo_count;
        $cargo_data->weight = $request_data->cargo_weight;
        $cargo_data->form_id = $request_data->cargo_form;
        $cargo_data->updated_at = $date_at;
        $cargo_data->save();
    }

}
