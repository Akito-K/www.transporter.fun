<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Owner;
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

    public static function getDatas($owner_id){
        $ary = [];
        $datas = Order::where('owner_id', $owner_id)->orderBy('status_id', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Order::addMoreData($data);
/*
                $data->send = Order::getSendAddress($data);
                $data->arrive = Order::getArriveAddress($data);
                $data->send_tels = \Func::telFormatDecode($data->send_tel);
                $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
                $data->estimate_count = Estimate::getCount($data->order_id);
*/
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getData($unique_id){
        $data = Order::where('order_id', $unique_id)->first();
        Order::addMoreData($data);
/*
        $data->send = Order::getSendAddress($data);
        $data->arrive = Order::getArriveAddress($data);
        $data->send_tels = \Func::telFormatDecode($data->send_tel);
        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
*/
        return $data;
    }

    public static function getEstimatableDatas(){
        $ary = [];
        $datas = Order::where('status_id', 'O-01')->orderBy('estimate_close_at', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                Order::addMoreData($data);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function addMoreData(&$data){
        $data->send = Order::getSendAddress($data);
        $data->arrive = Order::getArriveAddress($data);
        $data->send_tels = \Func::telFormatDecode($data->send_tel);
        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
        $data->owner_with_star = Order::getOwnerNameWithStar($data);
        $data->send_timezone_str = $data->send_timezone;
        $data->arrive_timezone_str = $data->arrive_timezone;

        $data->estimate_count = Estimate::getCount($data->order_id);
        $data->my_estimate_count = Estimate::getMyCount($data->order_id);
        $my_estimate = Estimate::getMyEstimate($data->order_id);
        $data->my_estimated_at = $my_estimate? $my_estimate->estimated_at: '-';
    }

    public static function getEstimatableDatasNames(){
        $ary = [];
        $datas = Order::where('status_id', 'O-01')->orderBy('estimate_close_at', 'ASC')->get();
        if(!empty($datas)){
            foreach($datas as $data){
                $data->owner = Owner::getData($data->owner_id);
                $val = $data->name.'／';
                $val .= $data->flag_hide_owner? '***（非公開）': $data->owner->company.$data->owner->sei.$data->owner->mei;
                $ary[ $data->order_id ] = $val.'様';
            }
        }

        return $ary;
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
        $data->send_tels = \Func::telFormatDecode($data->send_tel);
        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);
        $data->send_timezone_str = $data->send_timezone;
        $data->arrive_timezone_str = $data->arrive_timezone;

        $owner = Owner::getData($data->owner_id);
        $data->owner = Order::getOwnerName($data, $owner);
        $data->owner_with_star = Order::getOwnerNameWithStar($data, $owner);
        $data->hide_owner = $hide_owners[$data->flag_hide_owner];

        return $data;
    }

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

    public static function addOrderCargo(&$data, $order_id){
        $cargo_id = OrderToCargo::getCargoId($order_id);
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

    public static function addOrderRequest(&$data, $order_id, $option_equipments, $option_other_names ){
        $data->option_car = OrderRequest::where('order_id', $order_id)->where('type', 'car')->orderBy('id', 'DESC')->value('option_id');

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

        $ary = [];
        $request_others = OrderRequest::where('order_id', $order_id)->where('type', 'other')->orderBy('id', 'ASC')->pluck('count', 'option_id')->toArray();
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

}
