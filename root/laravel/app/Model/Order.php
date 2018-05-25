<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Carrier;
use App\Model\Estimate;

use App\Model\CarrierClass;
use App\Model\Cargo;
use App\Model\OrderToCargo;
use App\Model\CargoName;
use App\Model\CargoForm;
use App\Model\OrderRequest;
use App\Model\OrderRequestOption;

class Order extends Model
{
    use softDeletes;
    protected $table = 'orders';
    protected $dates = ['deleted_at', 'send_at', 'arrive_at', 'estimate_start_at', 'estimate_close_at'];
    protected $guarded = ['id'];


    private static $hide_owners = [
        0 => '公開する',
        1 => '公開しない',
    ];

    public static function getHideOwners(){
        return Order::$hide_owners;
    }

    private static $timezones = [
        0 => '未定',
        1 => '午前中',
        2 => '12～16時',
        3 => '16～20時',
        4 => '夜間',
    ];

    public static function getTimezones(){
        return Order::$timezones;
    }

    public static function getTimezoneKey($val){
        $timezones = Order::getTimezones();
        $keys = array_keys($timezones, $val);

        return !empty($keys)? $keys[0]: '';
    }

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ORD-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas( $owner_id ){
        $datas = Order::where('owner_id', $owner_id)->orderBy('status_id', 'ASC')->get();

        return $datas;
    }

    public static function getData( $order_id ){
        $data = Order::where('order_id', $order_id)->first();

        return $data;
    }

    public static function getEstimatableDatasNames(){
        $ary = [];
        $datas = Order::where('status_id', 'O-10')->orderBy('estimate_close_at', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                $owner = Owner::getData($data->owner_id);
                $val = $data->name.'／';
                $val .= $data->flag_hide_owner? '***（非公開）': $owner->company.' '.$owner->sei.$owner->mei;
                $val .= '様';
                $ary[ $data->order_id ] = $val;
            }
        }

        return $ary;
    }

    public static function getOrdersFromOwnerSide( $owner_id ){
        $ary = [];
        $datas = Order::getDatas( $owner_id );
        if(!empty($datas)){
            foreach($datas as $data){
                Order::addDeliveryData($data);
                Order::addEstimateCount($data);
                //Order::addOwnerData($data);
                //Order::addCarrierData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getActiveOrdersFromOwnerSide( $owner_id ){
        $ary = [];
        $datas = Order::where('owner_id', $owner_id)
                        ->where('status_id', 'O-20')
                        ->orWhere('status_id', 'O-25')
                        ->orWhere('status_id', 'O-30')
                        ->orWhere('status_id', 'O-35')
                        ->orderBy('status_id', 'ASC')
                        ->get();

        if(!empty($datas)){
            foreach($datas as $data){
                Order::addDeliveryData($data);
                Estimate::addReceivedEstimateByOrderIdFromOwnerSide( $data );
                //Order::addEstimateCount($data);
                //Order::addOwnerData($data);
                Estimate::addCarrierData($data->estimate_data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getOrderFromOwnerSide( $order_id ){
        $data = Order::getData( $order_id );
        Order::addDeliveryData($data);
        Order::addEstimateCount($data);
        Order::addOrderRequests($data);
        Order::addCarrierClass($data);
        Order::addOwnerData($data);
        //Order::addCarrierData($data);

        return $data;
    }
/*
    public static function getOrdersFromCarrierSide( $owner_id ){
        $ary = [];
        $datas = Order::getDatas( $owner_id );
        if(!empty($datas)){
            foreach($datas as $data){
                Order::addDeliveryData($data);
                Order::addEstimateData($data);
                Order::addOwnerData($data);
                //Order::addCarrierData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }
*/
    public static function getOrderFromCarrierSide( $order_id ){
        $data = Order::getData( $order_id );
        Order::addDeliveryData($data);
        Order::addOrderRequests($data);
        Order::addCarrierClass($data);
        Order::addOwnerData($data);
        //Order::addEstimateData($data);
        //Order::addCarrierData($data);

        return $data;
    }

/*
    public static function getDatas($owner_id){
        $ary = [];
        $datas = Order::where('owner_id', $owner_id)->orderBy('status_id', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Order::addMoreData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getData($order_id){
        $data = Order::where('order_id', $order_id)->first();
        Order::addMoreData($data);

        return $data;
    }
*/

    public static function getEstimatableDatas(){
        $ary = [];
        $datas = Order::where('status_id', 'O-10')->orderBy('estimate_close_at', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Order::addDeliveryData($data);
                Order::addOwnerData($data);
                Order::addEstimateCount($data);
                Order::addMyEstimateData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function addDeliveryData(&$data){
        $data->send = Order::getSendAddress($data);
        $data->arrive = Order::getArriveAddress($data);
        $data->send_tels = \Func::telFormatDecode($data->send_tel);
        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
        $data->send_timezone_str = $data->send_timezone;
        $data->arrive_timezone_str = $data->arrive_timezone;
    }

    public static function addOwnerData(&$data, $owner = NULL){
        $owner = $owner?: Owner::getData($data->owner_id);
        $data->owner_name = Order::getOwnerName($data, $owner);
        $data->owner_name_with_star = Order::getOwnerNameWithStar($data, $owner);
    }
/*
    public static function addCarrierData(&$data, $carrier = NULL){
        $carrier = $carrier?: Carrier::getData($data->carrier_id);
        $data->carrier_name = Order::getCarrierName($data, $carrier);
        $data->carrier_name_with_star = Order::getCarrierNameWithStar($data, $carrier);
    }
*/
    public static function addEstimateCount(&$data){
        $data->estimate_count = Estimate::getCount($data->order_id);
    }

    public static function addMyEstimateData(&$data){
        $data->my_estimate_data = Estimate::getMySuggestedData($data->order_id);
        $data->my_estimate_count = Estimate::getMyCount($data->order_id);
    }

    public static function addHideOwner(&$data){
        $hide_owners = Order::getHideOwners();
        $data->hide_owner_str = $hide_owners[$data->flag_hide_owner];
    }

    public static function addCarrierClass(&$data){
        $carrier_classes = CarrierClass::getNames();
        $data->carrier_class = isset($carrier_classes[$data->class_id])? $carrier_classes[$data->class_id]: '';
    }

    public static function addOrderRequests(&$data){
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNames($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);

        Order::addOrderCargo($data);
        Order::addOrderRequest($data, $option_equipments, $option_other_names);
        Order::addOrderRequestResults($data, $option_car_names, $option_equipments, $option_other_names);
    }


    public static function getSendAddress($data){
        $ary = [
            'sei' => $data->send_sei,
            'mei' => $data->send_mei,
            'zip1' => $data->send_zip1,
            'zip2' => $data->send_zip2,
            'pref_code' => $data->send_pref_code,
            'city' => $data->send_city,
            'address' => $data->send_address,
            'tel' => $data->send_tel,
        ];

        return (object) $ary;
    }

    public static function getArriveAddress($data){
        $ary = [
            'sei' => $data->arrive_sei,
            'mei' => $data->arrive_mei,
            'zip1' => $data->arrive_zip1,
            'zip2' => $data->arrive_zip2,
            'pref_code' => $data->arrive_pref_code,
            'city' => $data->arrive_city,
            'address' => $data->arrive_address,
            'tel' => $data->arrive_tel,
        ];

        return (object) $ary;
    }
/*
    public static function getOrderData($order_id){
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNames($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);

        $data = Order::getOrderBase($order_id);
        Order::addOrderCargo($data, $order_id);
        Order::addOrderRequest($data, $order_id, $option_equipments, $option_other_names);
        Order::addOrderRequestResults($data, $option_car_names, $option_equipments, $option_other_names);

        return $data;
    }

    public static function getOrderBase($order_id){
        $data = Order::getData($order_id);
        $hide_owners = Order::getHideOwners();
        $carrier_classes = CarrierClass::getNames();
        $data->carrier_class = isset($carrier_classes[$data->class_id])? $carrier_classes[$data->class_id]: '';
//        $data->send_tels = \Func::telFormatDecode($data->send_tel);
//        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
//        $data->send_timezone_str = $data->send_timezone;
//        $data->arrive_timezone_str = $data->arrive_timezone;

//        $owner = Owner::getData($data->owner_id);
//        $data->owner = Order::getOwnerName($data, $owner);
//        $data->owner_with_star = Order::getOwnerNameWithStar($data, $owner);
        $data->hide_owner = $hide_owners[$data->flag_hide_owner];

        return $data;
    }
*/
    public static function getOwnerName($data, $owner=NULL){
        if( $data->flag_hide_owner ){
            $name= '*** （非公開）';
        }else{
            $owner = $owner?: Owner::getData($data->owner_id);
            $name= $owner->company."\n".$owner->sei.' '.$owner->mei;
        }

        return $name;
    }

    public static function getOwnerNameWithStar($data, $owner=NULL){
        if( $data->flag_hide_owner ){
            $name = '*** （非公開）';
        }else{
            $owner = $owner?: Owner::getData($data->owner_id);
            $star = $owner->star;
            $name = '<a href="'.url('').'/mypage/owner/'.$data->owner_id.'/detail">'.$owner->sei.' '.$owner->mei.'</a>'."\n".
                                    view('include.star', compact('star'))->render();
        }

        return $name;
    }

    public static function getCarrierName($data, $carrier=NULL){
        $carrier = $carrier?: Carrier::getData($data->carrier_id);
        $name = $carrier->company."\n".$carrier->sei.' '.$carrier->mei;

        return $name;
    }

    public static function getCarrierNameWithStar($data, $carrier=NULL){
        $carrier = $carrier?: Carrier::getData($data->carrier_id);
        $star = $carrier->star;
        $name = '<a href="'.url('').'/mypage/carrier/'.$data->carrier_id.'/detail">'.$carrier->sei.' '.$carrier->mei.'</a>'."\n".
                                view('include.star', compact('star'))->render();

        return $name;
    }

    public static function addOrderCargo(&$data){
        $cargo_id = OrderToCargo::getCargoId($data->order_id);
        $cargo = Cargo::getData($cargo_id);
        $cargo_names = CargoName::getNames();
        $cargo_forms = CargoForm::getNames();
        $data->cargo_name   = isset($cargo_names[$cargo->name_id])? $cargo_names[$cargo->name_id]: '';
        $data->cargo_size_L = $cargo->length;
        $data->cargo_size_W = $cargo->width;
        $data->cargo_size_H = $cargo->height;
        $data->cargo_count  = $cargo->count;
        $data->cargo_weight = $cargo->weight;
        $data->total_weight = $cargo->count * $cargo->weight;
        $data->cargo_form   = isset($cargo_forms[$cargo->form_id])? $cargo_forms[$cargo->form_id]: '';
    }

    public static function addOrderRequest(&$data, $option_equipments, $option_other_names ){
        $data->option_car = OrderRequest::where('order_id', $data->order_id)->where('type', 'car')->orderBy('id', 'DESC')->value('option_id');

        $ary = [];
        $request_equipments = OrderRequest::where('order_id', $data->order_id)->where('type', 'equipment')->orderBy('id', 'ASC')->pluck('count', 'option_id')->toArray();
        foreach($option_equipments as $key => $equipments){
            if($equipments->unit === NULL){
                $ary[$key] = isset($request_equipments[$key])? $request_equipments[$key]: 0;
            }else{
                $ary[$key] = isset($request_equipments[$key])? $request_equipments[$key]: '';
            }
        }
        $data->option_equipments = $ary;

        $ary = [];
        $request_others = OrderRequest::where('order_id', $data->order_id)->where('type', 'other')->orderBy('id', 'ASC')->pluck('count', 'option_id')->toArray();
        foreach($option_other_names as $key => $name){
            $ary[$key] = isset($request_others[$key])? $request_others[$key]: 0;
        }
        $data->option_others = $ary;
    }

    public static function addOrderRequestResults(&$data, $option_car_names, $option_equipments, $option_other_names){
        $rst = new \stdClass();
        $rst->car = '';
        $rst->equipment = '';
        $rst->other = '';

        if( isset($option_car_names[ $data->option_car ]) ){
            $rst->car = $option_car_names[ $data->option_car ];
        }

        $ary = [];
        if(!empty($option_equipments)){
            foreach($option_equipments as $key => $equipment){
                if( isset($data->option_equipments[$key]) && $data->option_equipments[$key] > 0 ){
                    $str = $equipment->name.' x '.$data->option_equipments[$key];
                    $str .= $equipment->unit !== NULL ? $equipment->unit: '個';
                    $ary[] = $str;
                }
            }
        }
        if(!empty($ary)){
            $rst->equipment = implode(' / ', $ary);
        }

        $ary = [];
        if(!empty($option_other_names)){
            foreach($option_other_names as $key => $name){
                if( isset($data->option_others[$key]) && $data->option_others[$key] > 0 ){
                    $str = $name.' x 1個';
                    $ary[] = $str;
                }
            }
        }
        if(!empty($ary)){
            $rst->other = implode(' / ', $ary);
        }

        $data->order_request_results = $rst;
    }









    public static function duplicateData($old_order_id, $new_order_id){
        $date_at = new \Datetime();
        $old_data = Order::where('order_id', $old_order_id)->first();
        $new_data = $old_data->replicate();
        $new_data->name .= '_コピー';
        $new_data->order_id = $new_order_id;
        $new_data->status_id = 'O-05';
        $new_data->estimate_start_at = NULL;
        $new_data->estimate_close_at = NULL;

        $new_data->save();
    }

    public static function saveData( $request_data, $order_id ){
        $date_at = new \Datetime();
        $timezones = Order::getTimezones();
        $request_data = (object) $request_data;
        // Order
        $data = [
            'order_id' => $order_id,
            'owner_id' => \Auth::user()->owner_id,
            'name' => $request_data->name,
            'flag_hide_owner' => $request_data->flag_hide_owner,
            'class_id' => $request_data->class_id,
            'send_at' => $request_data->hide_send_at,
            'send_timezone' => $request_data->send_timezone? $timezones[ $request_data->send_timezone ]: '',
            'arrive_at' => $request_data->hide_arrive_at,
            'arrive_timezone' => $request_data->arrive_timezone? $timezones[ $request_data->arrive_timezone ]: '',

            'send_sei' => $request_data->send_sei,
            'send_mei' => $request_data->send_mei,
            'send_zip1' => $request_data->send_zip1,
            'send_zip2' => $request_data->send_zip2,
            'send_pref_code' => $request_data->send_pref_code,
            'send_city' => $request_data->send_city,
            'send_address' => $request_data->send_address,
            'send_tel' => \Func::telFormat( $request_data->send_tels ),

            'arrive_sei' => $request_data->arrive_sei,
            'arrive_mei' => $request_data->arrive_mei,
            'arrive_zip1' => $request_data->arrive_zip1,
            'arrive_zip2' => $request_data->arrive_zip2,
            'arrive_pref_code' => $request_data->arrive_pref_code,
            'arrive_city' => $request_data->arrive_city,
            'arrive_address' => $request_data->arrive_address,
            'arrive_tel' => \Func::telFormat( $request_data->arrive_tels ),

            'status_id' => 'O-05',
            'notes' => $request_data->notes,
            'amount_hope_min' => $request_data->amount_hope_min?: 0,
            'amount_hope_max' => $request_data->amount_hope_max?: 0,

            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Order::insert($data);
    }

    public static function updateData( $request_data ){
        $date_at = new \Datetime();
        $timezones = Order::getTimezones();
        $request_data = (object) $request_data;

        $order_id = $request_data->order_id;
        $data = Order::where('order_id', $order_id)->first();

        $data->name = $request_data->name;
        $data->flag_hide_owner = $request_data->flag_hide_owner;
        $data->class_id = $request_data->class_id;
        $data->send_at = $request_data->hide_send_at? new \Datetime($request_data->hide_send_at): NULL;
        $data->send_timezone = $request_data->send_timezone? $timezones[ $request_data->send_timezone ]: '';
        $data->arrive_at = $request_data->hide_arrive_at? new \Datetime($request_data->hide_arrive_at): NULL;
        $data->arrive_timezone = $request_data->arrive_timezone? $timezones[ $request_data->arrive_timezone ]: '';
        $data->send_sei = $request_data->send_sei;
        $data->send_mei = $request_data->send_mei;
        $data->send_zip1 = $request_data->send_zip1;
        $data->send_zip2 = $request_data->send_zip2;
        $data->send_pref_code = $request_data->send_pref_code;
        $data->send_city = $request_data->send_city;
        $data->send_address = $request_data->send_address;
        $data->send_tel = \Func::telFormat( $request_data->send_tels );

        $data->arrive_sei = $request_data->arrive_sei;
        $data->arrive_mei = $request_data->arrive_mei;
        $data->arrive_zip1 = $request_data->arrive_zip1;
        $data->arrive_zip2 = $request_data->arrive_zip2;
        $data->arrive_pref_code = $request_data->arrive_pref_code;
        $data->arrive_city = $request_data->arrive_city;
        $data->arrive_address = $request_data->arrive_address;
        $data->arrive_tel = \Func::telFormat( $request_data->arrive_tels );

        $data->status_id = 'O-05';
        $data->notes = $request_data->notes;
        $data->amount_hope_min = $request_data->amount_hope_min?: 0;
        $data->amount_hope_max = $request_data->amount_hope_max?: 0;
        $data->estimate_start_at = NULL;
        $data->estimate_close_at = NULL;

        $data->updated_at = $date_at;
        $data->save();
    }

}
