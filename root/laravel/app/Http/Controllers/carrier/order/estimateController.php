<?php
namespace App\Http\Controllers\carrier\order;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

//use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;

use App\Model\CarrierClass;
//use App\Model\UserToAddress;
use App\Model\Pref;
use App\Model\Cargo;
use App\Model\OrderToCargo;
use App\Model\CargoName;
use App\Model\CargoForm;
use App\Model\OrderRequest;
use App\Model\OrderRequestOption;
use App\Model\Estimate;
use App\Model\Item;
//use App\Model\OrderStatus;

use App\Model\Pagemeta;
use App\Model\Log;

class estimateController extends carrierController
{
    public function create($order_id, Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-MRQ-01');

        $carrier_classes = CarrierClass::getNames();
        $timezones = Order::getTimezones();
        $hide_owners = Order::getHideOwners();
        $prefs = Pref::getNames();
        $cargo_names = CargoName::getNames();
        $cargo_forms = CargoForm::getNames();
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNamesNest($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $umu = OrderRequestOption::getUmu();
        $items = Item::getDatas($me->carrier_id);

        $data = $this->getData($order_id, $option_equipments, $option_other_names);
        $order_request_results = Order::getOrderRequestResults($data, $option_car_names, $option_equipments, $option_other_names);

        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $estimate_data = $request->session()->get('estimate.create.'.$me->hashed_id);
        }else{
            $estimate_data = $this->makeEmptyData();
        }

        Log::saveData( 'carrier\order\requestController@create', 'order_id', $order_id, true);

        return view('carrier.order.estimate.create', compact('data', 'pagemeta', 'carrier_classes', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'items', 'order_request_results', 'estimate_data'));
    }


    public function validation($request){
        $validates = [
            'estimate_number' => 'required',
            'hide_estimated_at' => 'required|date|after:yesterday',
            'hide_limit_at' => 'required|date|after:tommorow',
            'total' => 'required|number',
        ];

        $this->validate($request, $validates);
    }

    public function makeData($request){
        $keys = [
            'estimate_number',
            'estimated_at',
            'hide_estimated_at',
            'limit_at',
            'hide_limit_at',
            'total',
            'notes',
        ];

        $data = new \stdClass();;
        foreach($keys as $key){
            $data->$key = $request[$key];
        }

        return $data;
    }

    public function makeEmptyData(){
        $keys = [
            'estimate_number',
            'estimated_at',
            'hide_estimated_at',
            'limit_at',
            'hide_limit_at',
            'total',
            'notes',
        ];

        $data = new \stdClass();
        foreach($keys as $key){
            $data->$key = '';
        }

        $keys = [
            'code',
            'name',
            'amount',
            'count',
            'subtotal',
        ];
        $obj = new \stdClass();
        foreach($keys as $key){
            $obj->$key = '';
        }
        $data->items = [$obj];

        return $data;
    }

    public function getData($order_id, $option_equipments, $option_other_names ){
        $data = new \stdClass();
        $order = Order::getData($order_id);
        $keys = [
            'order_id',
            'owner_id',
            'name',
            'class_id',
            'send_at',
            'hide_send_at',
            'send_timezone',
            'arrive_at',
            'hide_arrive_at',
            'arrive_timezone',
            'send_sei',
            'send_mei',
            'send_zip1',
            'send_zip2',
            'send_pref_code',
            'send_city',
            'send_address',
            'send_tel',
            'arrive_sei',
            'arrive_mei',
            'arrive_zip1',
            'arrive_zip2',
            'arrive_pref_code',
            'arrive_city',
            'arrive_address',
            'arrive_tel',
            'notes',
            'amount_hope_min',
            'amount_hope_max',
            'flag_hide_owner',
        ];
        foreach($keys as $key){
            $data->$key = $order[$key];
        }
        $data->send_tels = \Func::telFormatDecode($data->send_tel);
        $data->arrive_tels = \Func::telFormatDecode($data->arrive_tel);

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

        $data->owner = Owner::getData($data->owner_id);
        $data->user = Owner::getUser($data->owner_id);
        $data->estimate_count = Estimate::getCount($data->order_id);

        return $data;
    }

}
