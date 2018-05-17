<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Order;
use App\Model\Pagemeta;
use App\Model\Log;

class requestController extends carrierController
{
    public function showList(Request $request){
        Log::saveData( __METHOD__ );
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('CR-RQS-01');

        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.create.'.$me->hashed_id);
        }
        if( $request->session()->has('estimate.edit.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.edit.'.$me->hashed_id);
        }
        $datas = Order::getEstimatableDatas();

        return view('carrier.request.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($order_id, Request $request){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('CR-RQS-02');
        $data = Order::getOrderData($order_id);

        return view('carrier.request.detail', compact('data', 'pagemeta'));
    }

}
