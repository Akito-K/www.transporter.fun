<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

//use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\StatusLog;

use App\Model\Pagemeta;
use App\Model\Log;

class requestController extends ownerController
{

    public function create($order_id, Request $request){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-MRQ-01');
        $data = Order::getOrderData($order_id);

        if( $request->session()->has('request.create.'.$me->hashed_id) ) {
            $req_data = $request->session()->get('request.create.'.$me->hashed_id);
        }else{
            $req_data = $this->makeEmptyData();
        }

        return view('owner.request.create', compact('data', 'pagemeta', 'req_data'));
    }

    public function confirm(Request $request){
        Log::saveData( __METHOD__ );

        // Validation
        $this->validation($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('OW-MRQ-02');
        $order_id = $request['order_id'];
        $data = Order::getOrderData($order_id);

        $req_data = $this->makeData($request);
        $request->session()->forget('request.create.'.$me->hashed_id);
        $request->session()->put('request.create.'.$me->hashed_id, $req_data);

        return view('owner.request.confirm', compact('data', 'pagemeta', 'req_data'));
    }

    public function execute(Request $request){
        $me = $request['me'];
        $data = $request->session()->get('request.create.'.$me->hashed_id);
        $request->session()->forget('request.create.'.$me->hashed_id);
        $order_id = $request['order_id'];
        $order = Order::where('order_id', $order_id)->first();
        //$order->estimate_start_at = new DatetimeImmutable( $data->hide_estimate_start_at.' '.$data->estimate_start_at_hour.':'.$data->estimate_start_at_minutes.':00');
        $order->estimate_close_at = new \DatetimeImmutable( $data->hide_estimate_close_at.' '.$data->estimate_close_at_hour.':'.$data->estimate_close_at_minutes.':00');

        $now_at = new \DatetimeImmutable();
        // 期間内なら実行
        //if( $now_at >= $order->estimate_start_at && $now_at <= $order->estimate_close_at){
        if( $now_at < $order->estimate_close_at){
            $order->estimate_start_at = $now_at;
            $order->status_id = 'O-01';
            $order->updated_at = $now_at;
            $order->save();

            $progress = [
                'order_id' => $order_id,
                'status_id' => $order->status_id,
                'created_at' => $now_at,
                'updated_at' => $now_at,
            ];
            StatusLog::insert($progress);

            // sendMail
            // $data->body;
        }

        Log::saveData( __METHOD__ );

        return redirect('owner/order');
    }

    public function cancel($order_id, Request $request){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        Order::where('order_id', $order_id)->delete();

        return redirect('owner/order');
    }


    public function validation($request){
        $validates = [
            'estimate_close_at' => 'required',
            'hide_estimate_close_at' => 'required|date|after:today',
            'estimate_close_at_hour' => 'required',
            'estimate_close_at_minutes' => 'required',
        ];

        $this->validate($request, $validates);
    }

    public function makeData($request){
        $keys = [
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

}
