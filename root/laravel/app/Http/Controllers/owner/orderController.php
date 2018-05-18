<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;
use App\Http\Requests\MyOrderRequest as MyRequest;

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
use App\Model\Status;

use App\Model\Pagemeta;
use App\Model\Log;

class orderController extends ownerController
{

    public function showList( Request $request ){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-01');
        $datas = Order::getDatas($request['me']->owner_id);
        $status = Status::getNames();

        return view('owner.order.list', compact('pagemeta', 'datas', 'status'));
    }

    public function showDetail($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-02');
        $data = Order::getOrderData($order_id);

        return view('owner.order.detail', compact('data', 'pagemeta'));
    }

    public function create(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-03');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $addresses = Address::getNames( \Auth::user()->user_id );
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

        return view('owner.order.create', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function confirm(MyRequest $request){
        Log::saveData( __METHOD__ );
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

        $request->flash();
        $action = 'create';

        return view('owner.order.confirm', compact('action', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function insert( Request $request ){
        Log::saveData( __METHOD__ );

        $order_id = Order::getNewId();
        $request_data = $request->all();
        Order::saveData($request_data, $order_id);
        OrderRequest::saveData($request_data, $order_id);
        Cargo::saveData($request_data, $order_id);

        return redirect('owner/order');
    }

    public function edit( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-06');

        $carrier_classes = CarrierClass::getNames();
        \Func::array_append($carrier_classes, [ 0 => '---' ], true);
        $addresses = Address::getNames(\Auth::user()->user_id);
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

        $data = Order::getData($order_id);
        $data->hide_send_at = \Func::dateFormat($data->send_at, 'Y/n/j');
        $data->hide_arrive_at = \Func::dateFormat($data->arrive_at, 'Y/n/j');
        $data->send_at_str = \Func::dateFormat($data->send_at, 'Y/n/j(wday)');
        $data->arrive_at_str = \Func::dateFormat($data->arrive_at, 'Y/n/j(wday)');
        Cargo::addData($data, $order_id);
        OrderRequest::addData($data, $order_id);

        return view('owner.order.edit', compact('data', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }

    public function confirmUpdate(MyRequest $request){
        Log::saveData( __METHOD__ );

        $order_id = $request['order_id'];
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

        $request->flash();
        $action = 'edit';

        return view('owner.order.confirm', compact('action', 'pagemeta', 'carrier_classes', 'addresses', 'prefs', 'timezones', 'hide_owners', 'cargo_names', 'cargo_forms', 'option_car_names', 'option_equipments', 'option_other_names', 'umu'));
    }
    public function update(Request $request){
        Log::saveData( __METHOD__ );

        $request_data = $request->all();
        $order_id = $request['order_id'];

        Order::updateData($request_data);
        OrderRequest::where('order_id', $order_id)->delete();
        OrderRequest::saveData($request_data, $order_id);
        Cargo::updateData($request_data);

        return redirect('owner/order');
    }

    public function delete($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        Order::where('order_id', $order_id)->delete();

        return redirect('owner/order');
    }

    public function duplicate($old_order_id){
        Log::saveData( __METHOD__ , 'order_id', $old_order_id, true);
        $new_order_id = Order::getNewId();
        Order::duplicateData($old_order_id, $new_order_id);
        OrderRequest::duplicateData($old_order_id, $new_order_id);
        Cargo::duplicateData($old_order_id, $new_order_id);

        return redirect('owner/order');
    }
}
