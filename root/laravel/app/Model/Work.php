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

    public static function getActiveDatas($carrier_id){
        $ary = [];
        $datas = Work::where('carrier_id', $carrier_id)
                        ->whereNotNull('status_id')
                        ->orderBy('id', 'DESC')
                        ->get();

        if(!empty($datas)){
            foreach($datas as $data){
                $data->order = Order::getData( $data->order_id );
                Order::addDeliveryData($data->order);
                Order::addOrderRequests($data->order);
                Order::addCarrierClass($data->order);
                Order::addOwnerData($data->order);
                $data->estimate = Estimate::getData( $data->estimate_id );
                Estimate::addItemData($data->estimate);
                $data->status = Status::getStatus( $data->status_id );
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getData($work_id){
        $data = Work::where('work_id', $work_id)->first();

        return $data;
    }

    public static function getDataByEstimateId($estimate_id){
        $data = Work::where('estimate_id', $estimate_id)->first();

        return $data;
    }

    public static function getWork($work_id){
        $data = Work::getData($work_id);
        $data->order = Order::getData( $data->order_id );
        Order::addDeliveryData($data->order);
        Order::addOrderRequests($data->order);
        Order::addCarrierClass($data->order);
        Order::addOwnerData($data->order);
        $data->estimate = Estimate::getData( $data->estimate_id );
        Estimate::addItemData($data->estimate);
        $data->status = Status::getStatus( $data->status_id );

        return $data;
    }
/*
    public static function addMoreData(&$data){
        $data->order = Order::getOrderData($data->order_id);
        $data->status = Status::getStatus( $data->status_id );
        $data->estimate = Estimate::getEstimate($data->estimate_id);
    }
*/


    public static function duplicateData($old_estimate_id, $new_estimate_id){
        $date_at = new \Datetime();
        $old_data = Work::where('estimate_id', $old_estimate_id)->first();
        $new_data = $old_data->replicate();
        $new_data->estimate_id = $new_estimate_id;
        $new_data->status_id = NULL;
        $new_data->save();
    }

    public static function saveData( $request_data, $estimate_id ){
        $request_data = (object) $request_data;
        $work_id = Work::getNewId();
        $data = new Work;
        $data->work_id = $work_id;
        $data->order_id = $request_data->order_id;
        $data->estimate_id = $estimate_id;
        $data->carrier_id = \Auth::user()->carrier_id;
        $data->save();
    }

    public static function updateData( $request_data ){
        $request_data = (object) $request_data;
        $data = Work::where('estimate_id', $request_data->estimate_id)->first();
        $data->order_id = $request_data->order_id;
        $data->save();
    }

}
