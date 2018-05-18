<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;
use App\Http\Requests\MyEstimateRequest as MyRequest;

//use App\Model\MyUser;
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

        $pagemeta = Pagemeta::getPagemeta('OW-ESM-01');
        $datas = Estimate::getEstimates();

        return view('carrier.estimate.list', compact('pagemeta', 'datas'));
    }

    public function showOrderList ( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('OW-ESM-01');
        $datas = Estimate::getOrderEstimates($order_id);

        return view('carrier.estimate.list', compact('pagemeta', 'datas'));
    }

    public function showDetail ( $estimate_id ){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);

        $pagemeta = Pagemeta::getPagemeta('OW-ESM-02');
        $estimate_data = Estimate::getEstimate($estimate_id);
        $data = Order::getOrderData($estimate_data->order_id);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);

        return view('carrier.estimate.detail', compact('data', 'pagemeta', 'estimate_data', 'carrier'));
    }

    public function create( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('OW-ESM-03');
        $data = Order::getOrderData($order_id);
        $items = Item::getNames(\Auth::user()->carrier_id);
        \Func::array_append($items, [ 0 => '---' ], true);
        $select_orders_names = Order::getEstimatableDatasNames();

        return view('carrier.estimate.create', compact('select_orders_names', 'data', 'pagemeta', 'items'));
    }

    public function confirm( MyRequest $request ){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('OW-ESM-04');
        $data = Order::getOrderData($order_id);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);
        $request->flash();

        return view('carrier.estimate.confirm', compact('data', 'pagemeta', 'carrier'));
    }

    public function insert( Request $request ){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $estimate_id = Estimate::getNewId();
        $request_data = $request->all();
        Estimate::saveData($request_data, $estimate_id);
        EstimateItem::saveData($request_data, $estimate_id);
        Work::saveData($request_data, $estimate_id);

        return redirect('carrier/work');
    }

    public function edit ($estimate_id, Request $request){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-06');
        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $estimate_data = $request->session()->get('estimate.create.'.$me->hashed_id);
        }else{
            $estimate_data = Estimate::getEstimate($estimate_id);
        }

        $data = Order::getOrderData($estimate_data->order_id);
        $carrier = Carrier::getData($me->carrier_id);
        $select_orders_names = Order::getEstimatableDatasNames();
        $items = Item::getNames($me->carrier_id);
        \Func::array_append($items, [ 0 => '---' ], true);

        return view('carrier.estimate.edit', compact('select_orders_names', 'data', 'pagemeta', 'estimate_data', 'items', 'carrier', 'me'));
    }

    public function confirmUpdate(Request $request){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        // Validation
        $this->validationUpdate($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-04');
        $data = Order::getOrderData($order_id);
        $carrier = Carrier::getData($me->carrier_id);

        $estimate_data = $this->makeData($request);
        $estimate_data->estimate_id = $request['estimate_id'];
        $request->session()->forget('estimate.create.'.$me->hashed_id);
        $request->session()->put('estimate.create.'.$me->hashed_id, $estimate_data);

        return view('carrier.estimate.confirm_update', compact('data', 'pagemeta', 'estimate_data', 'carrier', 'me'));
    }


    public function makeData($request){
        $data = new \stdClass();;
        $keys = [
            'order_id',
            'number',
            'estimated_at',
            'hide_estimated_at',
            'limit_at',
            'hide_limit_at',
            'total',
            'notes',
        ];
        foreach($keys as $key){
            $data->$key = $request[$key];
        }

        $data->items = [];
        $keys = [
            'code',
            'name',
            'amount',
            'count',
            'notes',
        ];
        $total = 0;
        if(!empty($request['code'])){
            foreach($request['code'] as $num => $val){
                $item = new \stdClass();
                foreach($keys as $key){
                    $item->$key = $request[$key][$num];
                }
                $item->subtotal = $item->amount * $item->count;
                $data->items[$num] = $item;
                $total += $item->subtotal;
            }
        }
        $data->total = $total;

        return $data;
    }

    public function makeEmptyData(){
        $keys = [
            'number',
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
            'notes',
        ];
        $obj = new \stdClass();
        foreach($keys as $key){
            $obj->$key = '';
        }
        $data->items = [$obj];

        return $data;
    }

}
