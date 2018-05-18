<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\OrderRequestOption;

class OrderRequest extends Model
{
    use softDeletes;
    protected $table = 'order_requests';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ORR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($unique_id){
        $datas = OrderRequest::where('order_id', $unique_id)->get();

        return $datas;
    }

    public static function addData(&$data, $order_id){
        $option_datas = OrderRequestOption::getDatas();
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);

        OrderRequest::addCarData($data, $order_id);
        OrderRequest::addEquipmentDatas($data, $order_id, $option_equipments);
        OrderRequest::addOtherDatas($data, $order_id, $option_other_names);
    }

    public static function addCarData(&$data, $order_id){
        $data->option_car = OrderRequest::where('order_id', $order_id)->where('type', 'car')->orderBy('id', 'DESC')->value('option_id');
    }

    public static function addEquipmentDatas(&$data, $order_id, $option_equipments){
        $ary = [];
        $request_equipments = OrderRequest::where('order_id', $order_id)->where('type', 'equipment')->orderBy('id', 'ASC')->pluck('count', 'option_id')->toArray();
        foreach($option_equipments as $key => $equipments){
            if($equipments->unit === NULL){
                $ary[$key] = isset($request_equipments[$key])? $request_equipments[$key]: 0;
            }else{
                $ary[$key] = isset($request_equipments[$key])? $request_equipments[$key]: '';
            }
        }
        $data->option_equipments = $ary;
    }

    public static function addOtherDatas(&$data, $order_id, $option_other_names){
        $ary = [];
        $request_others = OrderRequest::where('order_id', $order_id)->where('type', 'other')->orderBy('id', 'ASC')->pluck('count', 'option_id')->toArray();
        foreach($option_other_names as $key => $name){
            $ary[$key] = isset($request_others[$key])? $request_others[$key]: 0;
        }
        $data->option_others = $ary;
    }



    public static function duplicateData($old_order_id, $new_order_id){
        $date_at = new \Datetime();
        $old_datas = OrderRequest::where('order_id', $old_order_id)->get();
        if($old_datas){
            foreach($old_datas as $old_data){
                $new_data = $old_data->replicate();
                $new_data->order_id = $new_order_id;
                $new_data->save();
            }
        }
    }

    public static function saveData( $request_data, $order_id ){
        $date_at = new \Datetime();
        $request_data = (object) $request_data;
        // OrderRequest
        $type = 'car';
        if($request_data->option_car){
            $data = [
                'order_id' => $order_id,
                'type' => $type,
                'option_id' => $request_data->option_car,
                'count' => 1,
                'created_at' => $date_at,
                'updated_at' => $date_at,
            ];
            OrderRequest::insert($data);
        }

        $type = 'equipment';
        if(!empty($request_data->option_equipments)){
            foreach($request_data->option_equipments as $option_id => $count){
                if($count > 0){
                    $data = [
                        'order_id' => $order_id,
                        'type' => $type,
                        'option_id' => $option_id,
                        'count' => $count,
                        'created_at' => $date_at,
                        'updated_at' => $date_at,
                    ];
                    OrderRequest::insert($data);
                }
            }
        }

        $type = 'other';
        if(!empty($request_data->option_others)){
            foreach($request_data->option_others as $option_id => $count){
                if($count > 0){
                    $data = [
                        'order_id' => $order_id,
                        'type' => $type,
                        'option_id' => $option_id,
                        'count' => $count,
                        'created_at' => $date_at,
                        'updated_at' => $date_at,
                    ];
                    OrderRequest::insert($data);
                }
            }
        }
    }

}
