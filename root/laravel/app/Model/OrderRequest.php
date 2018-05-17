<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
