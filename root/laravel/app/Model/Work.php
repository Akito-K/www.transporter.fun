<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Order;
use App\Model\Status;
use App\Model\Estimate;

class Work extends Model
{
    use softDeletes;
    protected $table = 'works';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'WRK-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($carrier_id){
        $ary = [];
        $datas = Work::where('carrier_id', $carrier_id)->orderBy('id', 'DESC')->get();
        $status = Status::getNames();
        if(!empty($datas)){
            foreach($datas as $data){
                $data->order = Order::getOrderData($data->order_id);
                $data->status = Status::getStatus( $data->status_id, $status );
                $data->estimate = Estimate::getEstimate($data->estimate_id);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getData($unique_id){
        $data = Work::where('work_id', $unique_id)->first();
        $data->order = Order::getOrderData($data->order_id);
        $data->status = Status::getStatus( $data->status_id );
        $data->estimate = Estimate::getEstimate($data->estimate_id);

        return $data;
    }
}
