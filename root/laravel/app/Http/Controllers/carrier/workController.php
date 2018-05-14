<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Order;
/*
//use App\Model\MyUser;
//use App\Model\Owner;
use App\Model\CarrierClass;
//use App\Model\UserToAddress;
//use App\Model\Address;
use App\Model\Pref;
use App\Model\Cargo;
use App\Model\OrderToCargo;
use App\Model\CargoName;
use App\Model\CargoForm;
use App\Model\OrderRequest;
use App\Model\OrderRequestOption;
use App\Model\Estimate;
*/
use App\Model\Pagemeta;
use App\Model\Log;

class workController extends carrierController
{
    public function showList(Request $request){
        Log::saveData( 'carrier\workController@showList');
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('CR-RQS-01');

        if( $request->session()->has('estimate.create.'.$me->hashed_id) ) {
            $request->session()->forget('estimate.create.'.$me->hashed_id);
        }

        $datas = Order::getEstimatableDatas();

        return view('carrier.request.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($order_id, Request $request){
        Log::saveData( 'carrier\workController@showDetail', 'order_id', $order_id, true);
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('CR-RQS-02');
        $data = Order::getOrderData($order_id);

        return view('carrier.request.detail', compact('data', 'pagemeta'));
    }

}
