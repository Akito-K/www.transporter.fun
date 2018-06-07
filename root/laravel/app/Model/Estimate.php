<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\EstimateItem;
use App\Model\Order;

class Estimate extends Model
{
    use softDeletes;
    protected $table = 'estimates';
    protected $dates = ['estimated_at', 'limit_at', 'suggested_at', 'placed_at', 'rejected_at', 'received_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ETM-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getEstimatesFromCarrierSide( $carrier_id ){
        $ary = [];
        $datas = Estimate::where('carrier_id', $carrier_id)
                            ->orderBy('suggested_at', 'DESC')
                            ->orderBy('id', 'DESC')
                            ->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Estimate::addItemData($data);
                $data->order = Order::getData($data->order_id);
                Order::addOwnerData($data->order);
                //Estimate::addOwnerData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getEstimatesByOrderIdFromCarrierSide( $carrier_id, $order_id ){
        $ary = [];
        $datas = Estimate::where('carrier_id', $carrier_id)
                            ->where('order_id', $order_id)
                            ->orderBy('suggested_at', 'DESC')
                            ->orderBy('id', 'DESC')
                            ->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Estimate::addItemData($data);
                $data->order = Order::getData($data->order_id);
                Order::addOwnerData($data->order);
                //Estimate::addOwnerData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getEstimatesByOrderIdFromOwnerSide( $order_id ){
        $ary = [];
        $datas = Estimate::where('order_id', $order_id)
                            ->whereNotNull('suggested_at')
                            ->orderBy('suggested_at', 'ASC')
                            ->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Estimate::addItemData($data);
                Estimate::addCarrierData($data);
                $data->order = Order::getData($data->order_id);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getEstimateFromOwnerSide( $estimate_id ){
        $data = Estimate::where('estimate_id', $estimate_id)
                            ->first();
        Estimate::addItemData($data);
        Estimate::addCarrierData($data);
        $data->order = Order::getData($data->order_id);
        Order::addOrderRequests($data->order);
        Order::addCarrierClass($data->order);
        Order::addHideOwner($data->order);
        Order::addOwnerData($data->order);

        return $data;
    }

    public static function getPlacedEstimateByOrderIdFromOwnerSide( $order_id ){
        $data = Estimate::where('order_id', $order_id)
                            ->whereNotNull('placed_at')
                            ->first();
        Estimate::addItemData($data);
        //Estimate::addCarrierData($data);
        //$data->order = Order::getData($data->order_id);
        //Order::addOrderRequests($data->order);
        //Order::addCarrierClass($data->order);
        //Order::addHideOwner($data->order);
        //Order::addOwnerData($data->order);

        return $data;
    }

    public static function addPlacedEstimateByOrderIdFromOwnerSide( &$data ){
        $data->estimate_data = Estimate::getPlacedEstimateByOrderIdFromOwnerSide($data->order_id);
    }

/*
    public static function getOrderEstimates($order_id){
        $ary = [];
        $datas = Estimate::where('order_id', $order_id)->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Estimate::addMoreData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }
*/
    public static function getData($unique_id){
        $data = Estimate::where('estimate_id', $unique_id)->first();

        return $data;
    }

    public static function getCount($order_id){
        return Estimate::where('order_id', $order_id)->whereNotNull('suggested_at')->count();
    }

    public static function getMyCount($order_id, $carrier_id=NULL){
        $carrier_id = $carrier_id?: \Auth::user()->carrier_id;

        return Estimate::where('order_id', $order_id)
                            ->where('carrier_id', $carrier_id)
                            ->count();
    }

    public static function getMySuggestedData($order_id, $carrier_id=NULL){
        $carrier_id = $carrier_id?: \Auth::user()->carrier_id;
        $data = Estimate::where('order_id', $order_id)
                            ->where('carrier_id', $carrier_id)
                            ->whereNotNull('suggested_at')
                            ->orderBy('id', 'DESC')
                            ->first();

        return $data;
    }

    public static function getEstimateFromCarrierSide($estimate_id){
        $data = Estimate::getData($estimate_id);
        Estimate::addItemData($data);
        //Estimate::addCarrierData($data);

        return $data;
    }
/*
    public static function addMoreData(&$data){
        $items = EstimateItem::getDatas($data->estimate_id);
        $ary = [];
        $total = 0;
        if(!empty($items)){
            foreach($items as $item){
                $item->subtotal = $item->amount * $item->count;
                $ary[] = $item;
                $total += $item->subtotal;
            }
        }
        $data->items = $ary;
        $data->total = $total;
        $data->count = Estimate::getCount($data->order_id);
        $data->order = Order::getOrderData($data->order_id);
    }
*/
    public static function addItemData(&$data){
        $item_data = Estimate::getItemData( $data->estimate_id );
        $data->items = $item_data->items;
        $data->total = $item_data->total;
    }

    public static function getItemData($estimate_id){
        $items = EstimateItem::getDatas($estimate_id);
        $ary = [];
        $total = 0;
        if(!empty($items)){
            foreach($items as $item){
                $item->subtotal = $item->amount * $item->count;
                $ary[] = $item;
                $total += $item->subtotal;
            }
        }

        $data = new \stdClass();
        $data->items = $ary;
        $data->total = $total;

        return $data;
    }

    public static function addCarrierData(&$data, $carrier_data = NULL){
        $carrier_data = $carrier_data?: Carrier::getData($data->carrier_id);
        $data->carrier_name = Order::getCarrierName($data, $carrier_data);
        $data->carrier_name_with_star = Order::getCarrierNameWithStar($data, $carrier_data);
    }


    public static function getTotalTransactionAmount($work_datas){
        $total = 0;
        if(!empty($work_datas)){
            foreach($work_datas as $work_data){
                if( in_array($work_data->status_id, ['W-20', 'W-25', 'W-30', 'W-35', 'W-40']) ){
                    $item_data = Estimate::getItemData( $work_data->estimate_id );
                    $count += $item_data->total;
                }
            }
        }

        return $total;
    }








    public static function duplicateData($old_estimate_id, $new_estimate_id){
        $date_at = new \Datetime();
        $old_data = Estimate::where('estimate_id', $old_estimate_id)->first();
        $new_data = $old_data->replicate();
        $new_data->estimate_id = $new_estimate_id;
        $new_data->suggested_at = NULL;
        $new_data->suggest_message = NULL;
        $new_data->place_message = NULL;
        $new_data->save();
    }

    public static function saveData( $request_data, $estimate_id ){
        $request_data = (object) $request_data;
        $order = Order::where('order_id', $request_data->order_id)->first();

        $data = new Estimate;
        $data->estimate_id = $estimate_id;
        $data->order_id = $request_data->order_id;
        $data->carrier_id = \Auth::user()->carrier_id;
        $data->order_name = $order->name;
        $data->estimate_number = $request_data->number;
        $data->estimated_at = new \Datetime( $request_data->hide_estimated_at );
        $data->limit_at = new \Datetime( $request_data->hide_limit_at );
        $data->notes = $request_data->notes;
        $data->save();
    }

    public static function updateData( $request_data ){
        $request_data = (object) $request_data;
        $order = Order::where('order_id', $request_data->order_id)->first();

        $data = Estimate::getData($request_data->estimate_id);
        $data->order_id = $request_data->order_id;
        $data->order_name = $order->name;
        $data->estimate_number = $request_data->number;
        $data->estimated_at = new \Datetime( $request_data->hide_estimated_at );
        $data->limit_at = new \Datetime( $request_data->hide_limit_at );
        $data->notes = $request_data->notes;
        $data->save();
    }

}
