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
use App\Model\CargoName;
use App\Model\CargoForm;
use App\Model\OrderRequestOption;

use App\Model\Pagemeta;
use App\Model\Log;

class orderController extends ownerController
{

    public function showList(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-01');
        $datas = Order::getDatas($me->user_id);
        Log::saveData( 'owner\orderController@showList');

        return view('owner.order.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($order_id, Request $request){
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-02');
        $data = Address::getData($order_id);
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);

        Log::saveData( 'owner\orderController@showDetail', 'order_id', $order_id, true);

        return view('owner.order.detail', compact('pagemeta', 'data', 'prefs'));
    }

    public function create(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-03');
        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);

        $addresses = Address::getNames($me->user_id);
        $timezones = Order::getTimezones();
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

        Log::saveData( 'owner\orderController@create');

        return view('owner.order.create', compact('pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function confirm(Request $request){
        // Validation
        $this->validation($request);

        $me = $request['me'];
        $data = $this->makeData($request);

        $request->session()->forget('order.'.$me->hashed_id);
        $request->session()->put('order.'.$me->hashed_id, $data);

        $pagemeta = Pagemeta::getPagemeta('OW-ORD-04');
        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);

        $timezones = Order::getTimezones();
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

        Log::saveData( 'owner\orderController@confirm');

        return view('owner.order.confirm', compact('pagemeta', 'data', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function insert(Request $request){
        $me = $request['me'];
        $data = $request->session()->get('order.'.$me->hashed_id);
        $request->session()->forget('order.'.$me->hashed_id);
        $this->insertData($data);

        Log::saveData( 'owner\orderController@insert');

        return redirect('owner/order');
    }

    public function edit($order_id, Request $request){
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-06');
        $data = Address::getData($order_id);
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);

        Log::saveData( 'owner\orderController@edit', 'order_id', $order_id, true);

        return view('owner.order.edit', compact('pagemeta', 'data', 'prefs'));
    }

    public function update(Request $request){
        // Validation
        $this->validationUpdate($request);
        $this->updateData($request);

        Log::saveData( 'owner\orderController@update');

        return redirect('owner/order');
    }

    public function delete($order_id, Request $request){
        Log::saveData( 'owner\orderController@delete', 'order_id', $order_id, true);

        Address::where('order_id', $request['order_id'])
                ->delete();
        UserToAddress::where('order_id', $request['order_id'] )
                        ->where('user_id', $request['me']->user_id )
                        ->delete();

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

    public function makeData($request){
        $keys = [
            'name',
            'class_id',
            'send_at',
            'hide_send_at',
            'arrive_at',
            'hide_arrive_at',
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
            'cargo_form',
            'option_car',
            'option_equipments',
            'option_others',
            'notes',
            'amount_hope_min',
            'amount_hope_max',
        ];
        $data = [];
        foreach($keys as $key){
            if( is_array($request[$key]) ){
                foreach($request[$key] as $k => $v){
                    $data[$key][$k] = $v;
                }
            }else{
                $data[$key] = $request[$key];
            }
        }

        $data['send_tel'] = \Func::telFormat( $request['send_tels'] );
        $data['arrive_tel'] = \Func::telFormat( $request['arrive_tels'] );

        return $data;
    }
/*
    public function makeEmptyData(){
        return [
            'company' => '',
            'section' => '',
            'role' => '',
            'sei' => '',
            'mei' => '',
            'zip1' => '',
            'zip2' => '',
            'pref_code' => '',
            'city' => '',
            'address' => '',
            'tel' => '',
            'tels' => [
                1 => '',
                2 => '',
                3 => '',
            ],
        ];
    }
*/
    public function insertData(Request $request){
        $now_at = new \Datetime();
        $order_id = Address::getNewId();

        $data = [
            'order_id' => $order_id,
            'name' => $request['name'],
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
            'tel' => \Func::telFormat( $request['tels'] ),
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ];
        Address::create($data);

        $data = [
            'user_id' => $request['me']->user_id,
            'order_id' => $order_id,
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ];
        UserToAddress::create($data);
    }

    public function updateData(Request $request){
        $now_at = new \Datetime();
        $data = [
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
            'tel' => \Func::telFormat( $request['tels'] ),
            'updated_at' => $now_at,
        ];
        if( isset($request['name']) ){
            $data['name'] = $request['name'];
        }

        Address::where('order_id', $request['order_id'])
                ->update($data);
    }
}
