<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\Order;
use App\Model\Pagemeta;
use App\Model\Log;

class requestController extends carrierController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $me = MyUser::getMe();
        $pagemeta = Pagemeta::getPagemeta('CR-RQ-000');
        $datas = Order::getEstimatableDatas();

        return view('carrier.request.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $me = MyUser::getMe();
        $pagemeta = Pagemeta::getPagemeta('CR-RQ-010');
        $data = Order::getOrderFromCarrierSide($order_id);

        return view('carrier.request.detail', compact('data', 'pagemeta'));
    }

}
