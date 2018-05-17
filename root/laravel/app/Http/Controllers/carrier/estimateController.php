<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

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
    public function showList (Request $request){
        Log::saveData( __METHOD__ );

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-01');
        $datas = Estimate::getEstimates();
        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.create.'.$me->hashed_id);
        }
        if( $request->session()->has('estimate.edit.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.edit.'.$me->hashed_id);
        }

        return view('carrier.estimate.list', compact('pagemeta', 'datas'));
    }

    public function showOrderList ($order_id, Request $request){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-01');
        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.create.'.$me->hashed_id);
        }
        if( $request->session()->has('estimate.edit.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.edit.'.$me->hashed_id);
        }
        $datas = Estimate::getOrderEstimates($order_id);

        return view('carrier.estimate.list', compact('pagemeta', 'datas'));
    }

    public function showDetail ($estimate_id, Request $request){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-02');
        $estimate_data = Estimate::getEstimate($estimate_id);
        $data = Order::getOrderData($estimate_data->order_id);
        $carrier = Carrier::getData($me->carrier_id);

        return view('carrier.estimate.detail', compact('data', 'pagemeta', 'estimate_data', 'carrier', 'me'));
    }

    public function create($order_id, Request $request){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-03');
        $data = Order::getOrderData($order_id);
        $items = Item::getNames($me->carrier_id);
        \Func::array_append($items, [ 0 => '---' ], true);
        $select_orders_names = Order::getEstimatableDatasNames();
        $default_estimated_at = new \DatetimeImmutable();
        $default_limit_at = new \DatetimeImmutable('+1 month -1 day');

        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $estimate_data = $request->session()->get('estimate.create.'.$me->hashed_id);
        }else{
            $estimate_data = $this->makeEmptyData();
        }

        return view('carrier.estimate.create', compact('select_orders_names', 'data', 'pagemeta', 'items', 'estimate_data', 'default_estimated_at', 'default_limit_at'));
    }

    public function confirm(Request $request){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        // Validation
        $this->validationInsert($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-ESM-04');
        $data = Order::getOrderData($order_id);
        $carrier = Carrier::getData($me->carrier_id);

        $estimate_data = $this->makeData($request);
        $request->session()->forget('estimate.create.'.$me->hashed_id);
        $request->session()->put('estimate.create.'.$me->hashed_id, $estimate_data);

        return view('carrier.estimate.confirm', compact('data', 'pagemeta', 'estimate_data', 'carrier', 'me'));
    }

    public function insert(Request $request){
        $me = $request['me'];
        $data = $request->session()->get('estimate.create.'.$me->hashed_id);
        $request->session()->forget('estimate.create.'.$me->hashed_id);

        $this->insertData( $data );

        Log::saveData( __METHOD__ , 'order_id', $data->order_id, true);

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


    public function validationInsert($request){
        $validates = [
            'hide_estimated_at' => 'required|date|after:yesterday',
            'hide_limit_at' => 'required|date|after:tommorow',
        ];

        $this->validate($request, $validates);
    }

    public function validationUpdate($request){
        $validates = [
            'hide_estimated_at' => 'required|date',
            'hide_limit_at' => 'required|date|after:tommorow',
        ];

        $this->validate($request, $validates);
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

    public function insertData( $request_data ){
        $date_at = new \Datetime();
        $estimate_id = Estimate::getNewId();
        $order = Order::getData($request_data->order_id);

        // Estimate
        $data = [
            'estimate_id' => $estimate_id,
            'order_id' => $request_data->order_id,
            'carrier_id' => \Auth::user()->carrier_id,
            'order_name' => $order->name,
            'estimate_number' => $request_data->number,
            'estimated_at' => $request_data->hide_estimated_at,
            'limit_at' => $request_data->hide_limit_at,
            'notes' => $request_data->notes,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Estimate::insert($data);

        if(!empty($request_data->items)){
            foreach($request_data->items as $num => $item){
                $data = [
                    'estimate_id' => $estimate_id,
                    'code' => $item->code,
                    'name' => $item->name?: '',
                    'amount' => $item->amount?: 0,
                    'count' => $item->count?: 0,
                    'created_at' => $date_at,
                    'updated_at' => $date_at,
                ];
                EstimateItem::insert($data);
            }
        }

        // Work
        $work_id = Work::getNewId();
        $data = [
            'work_id' => $work_id,
            'order_id' => $request_data->order_id,
            'estimate_id' => $estimate_id,
            'carrier_id' => \Auth::user()->carrier_id,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Work::insert($data);
    }

}
