<?php
namespace App\Http\Controllers\owner;
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

use App\Model\Pagemeta;
use App\Model\Log;

class orderController extends ownerController
{

    public function showList(Request $request){
        $me = $request['me'];

        if( $request->session()->has('order.create.'.$me->hashed_id) ) {
            $request->session()->forget('order.create.'.$me->hashed_id);
        }
        if( $request->session()->has('order.edit.'.$me->hashed_id) ) {
            $request->session()->forget('order.edit.'.$me->hashed_id);
        }
        if( $request->session()->has('request.create.'.$me->hashed_id) ) {
            $request->session()->forget('request.create.'.$me->hashed_id);
        }

        $pagemeta = Pagemeta::getPagemeta('OW-ORD-01');
        $datas = Order::getDatas($me->owner_id);
        $status = OrderStatus::getNames();
        Log::saveData( 'owner\orderController@showList');

        return view('owner.order.list', compact('pagemeta', 'datas', 'status'));
    }

    public function showDetail($order_id, Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-02');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $addresses = Address::getNames($me->user_id);
        $timezones = Order::getTimezones();
        $hide_owners = Order::getHideOwners();
        $prefs = Pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        $cargo_names = CargoName::getNames();
        \Func::array_append($cargo_names, [ 0 => '---' ], true);
        $cargo_forms = CargoForm::getNames();
        \Func::array_append($cargo_forms, [ 0 => '---' ], true);
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNamesNest($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $umu = OrderRequestOption::getUmu();

        $data = $this->getData($order_id, $option_equipments, $option_other_names);
//        \Func::var_dump($data);exit;

        Log::saveData( 'owner\orderController@showDetail', 'order_id', $order_id, true);

        return view('owner.order.detail', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function create(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-03');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $addresses = Address::getNames($me->user_id);
        $timezones = Order::getTimezones();
        $hide_owners = Order::getHideOwners();
        $prefs = Pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        $cargo_names = CargoName::getNames();
        \Func::array_append($cargo_names, [ 0 => '---' ], true);
        $cargo_forms = CargoForm::getNames();
        \Func::array_append($cargo_forms, [ 0 => '---' ], true);
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNamesNest($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $umu = OrderRequestOption::getUmu();

        if( $request->session()->has('order.create.'.$me->hashed_id) ) {
            $data = $request->session()->get('order.create.'.$me->hashed_id);
        }else{
            $data = $this->makeEmptyData( $option_equipments, $option_other_names );
        }

        Log::saveData( 'owner\orderController@create');

        return view('owner.order.create', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function confirm(Request $request){
        // Validation
        $this->validation($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-04');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $timezones = Order::getTimezones();
        $hide_owners = Order::getHideOwners();
        $prefs = Pref::getNames();
        $cargo_names = CargoName::getNames();
        \Func::array_append($cargo_names, [ 0 => '---' ], true);
        $cargo_forms = CargoForm::getNames();
        \Func::array_append($cargo_forms, [ 0 => '---' ], true);
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNames($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $umu = OrderRequestOption::getUmu();

        $data = $this->makeData($request, $option_equipments, $option_other_names );
        $request->session()->forget('order.create.'.$me->hashed_id);
        $request->session()->put('order.create.'.$me->hashed_id, $data);

        Log::saveData( 'owner\orderController@confirm');

        return view('owner.order.confirm', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function insert(Request $request){
        $me = $request['me'];
        $data = $request->session()->get('order.create.'.$me->hashed_id);
        $request->session()->forget('order.create.'.$me->hashed_id);

        $this->insertData( $data );

        Log::saveData( 'owner\orderController@insert');

        return redirect('owner/order');
    }

    public function edit($order_id, Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-06');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $addresses = Address::getNames($me->user_id);
        $timezones = Order::getTimezones();
        $hide_owners = Order::getHideOwners();
        $prefs = Pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        $cargo_names = CargoName::getNames();
        \Func::array_append($cargo_names, [ 0 => '---' ], true);
        $cargo_forms = CargoForm::getNames();
        \Func::array_append($cargo_forms, [ 0 => '---' ], true);
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNamesNest($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $umu = OrderRequestOption::getUmu();

        if( $request->session()->has('order.edit.'.$me->hashed_id) ) {
            $data = $request->session()->get('order.edit.'.$me->hashed_id);
//            \Func::var_dump($data);exit;
        }else{
            $data = $this->getData($order_id, $option_equipments, $option_other_names);
        }
//        \Func::var_dump($data);exit;

        Log::saveData( 'owner\orderController@edit', 'order_id', $order_id, true);

        return view('owner.order.edit', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function confirmUpdate(Request $request){
        // Validation
        $this->validation($request);

        $order_id = $request['order_id'];
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-07');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $timezones = Order::getTimezones();
        $hide_owners = Order::getHideOwners();
        $prefs = Pref::getNames();
        $cargo_names = CargoName::getNames();
        \Func::array_append($cargo_names, [ 0 => '---' ], true);
        $cargo_forms = CargoForm::getNames();
        \Func::array_append($cargo_forms, [ 0 => '---' ], true);
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNames($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $umu = OrderRequestOption::getUmu();

        $data = $this->makeData($request, $option_equipments, $option_other_names );
        $data->order_id = $order_id;
        //\Func::var_dump($data);exit;
        $request->session()->forget('order.edit.'.$me->hashed_id);
        $request->session()->put('order.edit.'.$me->hashed_id, $data);

        Log::saveData( 'owner\orderController@confirmUpdate');

        return view('owner.order.confirm_update', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }
    public function update(Request $request){
        $me = $request['me'];
        $data = $request->session()->get('order.edit.'.$me->hashed_id);
        $request->session()->forget('order.edit.'.$me->hashed_id);

        $this->updateData( $data );

        Log::saveData( 'owner\orderController@update');

        return redirect('owner/order');
    }

    public function delete($order_id, Request $request){
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

    public function duplicate($order_id, Request $request){
        Log::saveData( 'owner\orderController@duplicate', 'order_id', $order_id, true);

        $option_datas = OrderRequestOption::getDatas();
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);
        $data = $this->getData($order_id, $option_equipments, $option_other_names);
        $this->insertData( $data );

        return redirect('owner/order');
    }


    public function validation($request){
        $validates = [
            'name' => 'sometimes|required',

            'send_zip1' => 'required|digits:3',
            'send_zip2' => 'required|digits:4',
            'send_zip_code' => 'requires|numeric',
            'send_city' => 'required',
            'send_address' => 'required',

            'arrive_zip1' => 'required|digits:3',
            'arrive_zip2' => 'required|digits:4',
            'arrive_zip_code' => 'requires|numeric',
            'arrive_city' => 'required',
            'arrive_address' => 'required',
        ];

        $this->validate($request, $validates);
    }

    public function makeData($request, $option_equipments, $option_other_names ){
        $keys = [
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
            'send_tels',
            'arrive_sei',
            'arrive_mei',
            'arrive_zip1',
            'arrive_zip2',
            'arrive_pref_code',
            'arrive_city',
            'arrive_address',
            'arrive_tels',
            'cargo_name',
            'cargo_size_L',
            'cargo_size_W',
            'cargo_size_H',
            'cargo_count',
            'cargo_weight',
            'total_weight',
            'cargo_form',
            'option_car',
            'notes',
            'amount_hope_min',
            'amount_hope_max',
        ];
        $data = new \stdClass();;
        foreach($keys as $key){
            if( is_array($request[$key]) ){
                $ary = [];
                foreach($request[$key] as $k => $v){
                    $ary[$k] = $v;
                }
                $data->$key = $ary;
            }else{
                $data->$key = $request[$key];
            }
        }

        $data->flag_hide_owner = $request['flag_hide_owner']?: 0;

        $ary = [];
        foreach($option_equipments as $key => $equipments){
            if($equipments->unit === NULL){
                $ary[$key] = isset($request['option_equipments'][$key])? (int) $request['option_equipments'][$key]: 0;
            }else{
                $ary[$key] = isset($request['option_equipments'][$key])? (int) $request['option_equipments'][$key]: '';
            }
        }
        $data->option_equipments = $ary;

        $ary = [];
        foreach($option_other_names as $key => $name){
            $ary[$key] = isset($request['option_others'][$key])? (int) $request['option_others'][$key]: 0;
        }
        $data->option_others = $ary;

        $data->send_tel = \Func::telFormat( $request->send_tels );
        $data->arrive_tel = \Func::telFormat( $request->arrive_tels );

        return $data;
    }

    public function makeEmptyData( $option_equipments, $option_other_names ){
        $keys = [
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
            'arrive_sei',
            'arrive_mei',
            'arrive_zip1',
            'arrive_zip2',
            'arrive_pref_code',
            'arrive_city',
            'arrive_address',
            'cargo_name',
            'cargo_size_L',
            'cargo_size_W',
            'cargo_size_H',
            'cargo_count',
            'cargo_weight',
            'total_weight',
            'cargo_form',
            'option_car',
            'notes',
            'amount_hope_min',
            'amount_hope_max',
            'send_tel',
            'arrive_tel',
        ];

        $data = new \stdClass();;
        foreach($keys as $key){
            $data->$key = '';
        }
        $data->flag_hide_owner = 0;

        $tels = [1 => '', 2 => '', 3 => ''];
        $data->send_tels = $tels;
        $data->arrive_tels = $tels;

        $ary = [];
        foreach($option_equipments as $key => $equipments){
            if($equipments->unit === NULL){
                $ary[$key] = 0;
            }else{
                $ary[$key] = '';
            }
        }
        $data->option_equipments = $ary;

        $ary = [];
        foreach($option_other_names as $key => $name){
            $ary[$key] = 0;
        }
        $data->option_others = $ary;

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

    public function insertData( $request_data ){
        $date_at = new \Datetime();
        $order_id = Order::getNewId();

        $carrier_classes = CarrierClass::getNames();
        $timezones = Order::getTimezones();
        $prefs = Pref::getNames();
        $cargo_names = CargoName::getNames();
        $cargo_forms = CargoForm::getNames();
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNames($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);

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

            'status_id' => 'ORD-STS-01',
            'notes' => $request_data->notes,
            'amount_hope_min' => $request_data->amount_hope_min?: 0,
            'amount_hope_max' => $request_data->amount_hope_max?: 0,

            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Order::insert($data);

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
            'weight' => $request_data->cargo_size_W,
            'height' => $request_data->cargo_size_H,
            'count' => $request_data->cargo_count,
            'weight' => $request_data->cargo_weight,
            'form_id' => $request_data->cargo_form,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Cargo::insert($data);

        // CargoValue
        //   none
    }

    public function updateData( $request_data ){
        $date_at = new \Datetime();

        $carrier_classes = CarrierClass::getNames();
        $timezones = Order::getTimezones();
        $prefs = Pref::getNames();
        $cargo_names = CargoName::getNames();
        $cargo_forms = CargoForm::getNames();
        $option_datas = OrderRequestOption::getDatas();
        $option_car_names = OrderRequestOption::getCarNames($option_datas);
        $option_equipments = OrderRequestOption::getEquipments($option_datas);
        $option_other_names = OrderRequestOption::getOtherNames($option_datas);

        $order_id = $request_data->order_id;

        // Order
        $data = Order::where('order_id', $order_id)->first();

        $data->name = $request_data->name;
        $data->flag_hide_owner = $request_data->flag_hide_owner;
        $data->class_id = $request_data->class_id;
        $data->send_at = $request_data->hide_send_at;
        $data->send_timezone = $request_data->send_timezone? $timezones[ $request_data->send_timezone ]: '';
        $data->arrive_at = $request_data->hide_arrive_at;
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

        $data->notes = $request_data->notes;
        $data->amount_hope_min = $request_data->amount_hope_min?: 0;
        $data->amount_hope_max = $request_data->amount_hope_max?: 0;

        $data->updated_at = $date_at;
        $data->save();

        // OrderRequest
        OrderRequest::where('order_id', $order_id)->forceDelete();

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

        // Cargo
        $cargo = OrderToCargo::where('order_id', $order_id)->first();

        $data = Cargo::where('cargo_id', $cargo->cargo_id)->first();
        $data->name_id = $request_data->cargo_name;
        $data->length = $request_data->cargo_size_L;
        $data->weight = $request_data->cargo_size_W;
        $data->height = $request_data->cargo_size_H;
        $data->count = $request_data->cargo_count;
        $data->weight = $request_data->cargo_weight;
        $data->form_id = $request_data->cargo_form;
        $data->updated_at = $date_at;
        $data->save();
    }

}
