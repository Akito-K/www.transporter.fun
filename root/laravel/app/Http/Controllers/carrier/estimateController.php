<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;
use App\Http\Requests\MyEstimateRequest as MyRequest;

use App\Model\MyUser;
//use App\Model\Owner;
use App\Model\Order;
use App\Model\Carrier;
use App\Model\Item;
use App\Model\Estimate;
use App\Model\EstimateItem;
use App\Model\Work;

use App\Model\Pagemeta;
use App\Model\Log;

class estimateController extends carrierController
{
    public function showList (){
        Log::saveData( __METHOD__ );

        $pagemeta = Pagemeta::getPagemeta('CR-EM-000');
        $datas = Estimate::getEstimatesFromCarrierSide(\Auth::user()->carrier_id);

        return view('carrier.estimate.list', compact('pagemeta', 'datas'));
    }

    public function showOrderList ( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('CR-EM-001');
        $datas = Estimate::getEstimatesByOrderIdFromCarrierSide( \Auth::user()->carrier_id, $order_id );

        return view('carrier.estimate.order_list', compact('pagemeta', 'datas'));
    }

    public function showDetail ( $estimate_id ){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);

        $pagemeta = Pagemeta::getPagemeta('CR-EM-010');
        $data = Estimate::getEstimateFromCarrierSide($estimate_id);
        $order_data = Order::getOrderFromCarrierSide($data->order_id);
        $carrier_data = Carrier::getData(\Auth::user()->carrier_id);

        return view('carrier.estimate.detail', compact('order_data', 'pagemeta', 'data', 'carrier_data'));
    }

    public function create( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('CR-EM-020');
        $order_data = Order::getOrderFromCarrierSide($order_id);
        $items = Item::getNames(\Auth::user()->carrier_id);
        \Func::array_append($items, [ 0 => '---' ], true);
        $select_orders_names = Order::getEstimatableDatasNames();

        return view('carrier.estimate.create', compact('select_orders_names', 'order_data', 'pagemeta', 'items'));
    }

    public function confirm( MyRequest $request ){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('CR-EM-030');
        $order_data = Order::getOrderFromCarrierSide($order_id);
        $carrier_data = Carrier::getData(\Auth::user()->carrier_id);
        $request->flash();
        $action = 'create';

        return view('carrier.estimate.confirm', compact('action', 'order_data', 'pagemeta', 'carrier_data'));
    }

    public function insert( Request $request ){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $estimate_id = Estimate::getNewId();
        $request_data = $request->all();
        Estimate::saveData($request_data, $estimate_id);
        EstimateItem::saveData($request_data, $estimate_id);
        Work::saveData($request_data, $estimate_id);

        return redirect('carrier/estimate');
    }

    public function edit ($estimate_id){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-EM-050');

        $data = Estimate::getEstimateFromCarrierSide($estimate_id);
        $order_data = Order::getOrderFromCarrierSide($data->order_id);
        $me = MyUser::getMe();
        $carrier_data = Carrier::getData($me->carrier_id);
        $select_orders_names = Order::getEstimatableDatasNames();
        $items = Item::getNames($me->carrier_id);
        \Func::array_append($items, [ 0 => '---' ], true);

        return view('carrier.estimate.edit', compact('select_orders_names', 'order_data', 'data', 'pagemeta', 'items', 'carrier_data'));
    }

    public function confirmUpdate( MyRequest $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $order_id = $request['order_id'];

        $pagemeta = Pagemeta::getPagemeta('CR-EM-060');
        $order_data = Order::getOrderFromCarrierSide($order_id);
        $carrier_data = Carrier::getData(\Auth::user()->carrier_id);

        $request->flash();
        $action = 'edit';

        return view('carrier.estimate.confirm', compact('action', 'order_data', 'pagemeta', 'carrier_data'));
    }

    public function update( Request $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);

        $request_data = $request->all();
        Estimate::updateData($request_data);
        EstimateItem::where('estimate_id', $estimate_id)->delete();
        EstimateItem::saveData($request_data, $estimate_id);
        Work::updateData($request_data);

        return redirect('carrier/estimate');
    }

    public function delete ($estimate_id){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $data = Estimate::getData($estimate_id);
        $data->delete();

        return redirect('carrier/estimate');
    }

    public function duplicate($old_estimate_id){
        Log::saveData( __METHOD__ , 'estimate_id', $old_estimate_id, true);
        $new_estimate_id = Estimate::getNewId();
        Estimate::duplicateData($old_estimate_id, $new_estimate_id);
        EstimateItem::duplicateData($old_estimate_id, $new_estimate_id);
        Work::duplicateData($old_estimate_id, $new_estimate_id);

        return redirect('carrier/estimate');
    }
}
