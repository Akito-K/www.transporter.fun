<?php
namespace App\Http\Controllers\owner\order;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

//use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;

use App\Model\CarrierClass;
use App\Model\UserToAddress;
use App\Model\Address;
use App\Model\Pref;
use App\Model\Cargo;
use App\Model\OrderToCargo;
use App\Model\CargoName;
use App\Model\CargoForm;
use App\Model\OrderRequest;
use App\Model\OrderRequestOption;
use App\Model\OrderStatus;
use App\Model\OrderProgress;

use App\Model\Pagemeta;
use App\Model\Log;

class requestController extends ownerController
{

    public function create($order_id, Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-MRQ-01');

        $carrier_classes = CarrierClass::getNames();
        $addresses = Address::getNames($me->user_id);
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

        $data = $this->getData($order_id, $option_equipments, $option_other_names);
        $order_request_results = Order::getOrderRequestResults($data, $option_car_names, $option_equipments, $option_other_names);

        if( $request->session()->has('request.create.'.$me->hashed_id) ) {
            $req_data = $request->session()->get('request.create.'.$me->hashed_id);
        }else{
            $req_data = $this->makeEmptyData();
        }

        Log::saveData( 'owner\order\requestController@create', 'order_id', $order_id, true);

        return view('owner.order.request.create', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'order_request_results', 'req_data'));
    }

    public function confirm(Request $request){
        // Validation
        $this->validation($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-MRQ-02');

        $carrier_classes = CarrierClass::getNames();
        $addresses = Address::getNames($me->user_id);
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

        $order_id = $request['order_id'];
        $data = $this->getData($order_id, $option_equipments, $option_other_names);
        $order_request_results = Order::getOrderRequestResults($data, $option_car_names, $option_equipments, $option_other_names);

        $req_data = $this->makeData($request);

        $request->session()->forget('request.create.'.$me->hashed_id);
        $request->session()->put('request.create.'.$me->hashed_id, $req_data);

        Log::saveData( 'owner\order\requestController@confirm');

        return view('owner.order.request.confirm', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'order_request_results', 'req_data'));
    }

    public function execute(Request $request){
        $me = $request['me'];
        $data = $request->session()->get('request.create.'.$me->hashed_id);
        $request->session()->forget('request.create.'.$me->hashed_id);
        $order_id = $request['order_id'];
        $order = Order::where('order_id', $order_id)->first();
//        $order->estimate_start_at = new DatetimeImmutable( $data->hide_estimate_start_at.' '.$data->estimate_start_at_hour.':'.$data->estimate_start_at_minutes.':00');
        $order->estimate_close_at = new \DatetimeImmutable( $data->hide_estimate_close_at.' '.$data->estimate_close_at_hour.':'.$data->estimate_close_at_minutes.':00');

        $now_at = new \DatetimeImmutable();
        // 期間内なら実行
//        if( $now_at >= $order->estimate_start_at && $now_at <= $order->estimate_close_at){
        if( $now_at < $order->estimate_close_at){
            $order->estimate_start_at = $now_at;
            $order->status_id = 'ORD-STS-06';
            $order->updated_at = $now_at;
            $order->save();

            $progress = [
                'order_id' => $order_id,
                'status_id' => $order->status_id,
                'applied_at' => $now_at,
                'created_at' => $now_at,
                'updated_at' => $now_at,
            ];
            OrderProgress::insert($progress);

            // sendMail
            // $data->body;
        }

        Log::saveData( 'owner\order\requestController@execute');

        return redirect('owner/order');
    }

    public function cancel($order_id, Request $request){
        Log::saveData( 'owner\orderController@delete', 'order_id', $order_id, true);

        Order::where('order_id', $order_id)->delete();
/*
        OrderRequest::where('order_id', $order_id)->forceDelete();
        $cargo_id = OrderToCargo::getCargoId($order_id);
        OrderToCargo::insert($data);
        Cargo::insert($data);
*/
        return redirect('owner/order');
    }


    public function validation($request){
        $validates = [
//            'estimate_start_at',
//            'hide_estimate_start_at',
//            'estimate_start_at_hour',
//            'estimate_start_at_minutes',
            'estimate_close_at' => 'required',
            'hide_estimate_close_at' => 'required|date|after:today',
            'estimate_close_at_hour' => 'required',
            'estimate_close_at_minutes' => 'required',
        ];

        $this->validate($request, $validates);
    }

    public function makeData($request){
        $keys = [
//            'estimate_start_at',
//            'hide_estimate_start_at',
//            'estimate_start_at_hour',
//            'estimate_start_at_minutes',
            'estimate_close_at',
            'hide_estimate_close_at',
            'estimate_close_at_hour',
            'estimate_close_at_minutes',
            'body',
        ];

        $data = new \stdClass();;
        foreach($keys as $key){
            $data->$key = $request[$key];
        }

        return $data;
    }

    public function makeEmptyData(){
        $keys = [
//            'estimate_start_at',
//            'hide_estimate_start_at',
//            'estimate_start_at_hour',
//            'estimate_start_at_minutes',
            'estimate_close_at',
            'hide_estimate_close_at',
            'estimate_close_at_hour',
            'estimate_close_at_minutes',
            'body',
        ];

        $data = new \stdClass();;
        foreach($keys as $key){
            $data->$key = '';
        }

        return $data;
    }

    public function getData($order_id, $option_equipments, $option_other_names ){
        $data = new \stdClass();
        $order = Order::getData($order_id);
        $keys = [
            'order_id',
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

        return $data;
    }

}
