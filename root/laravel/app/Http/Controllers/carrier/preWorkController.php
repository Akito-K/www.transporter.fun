<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Work;
use App\Model\Carrier;

use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\Estimate;
use App\Model\Report;
use App\Model\Payment;

use App\Model\Pagemeta;
use App\Model\Log;

class preWorkController extends carrierController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-WK-000');
        $datas = Work::getPreWorksByCarrierId( \Auth::user()->carrier_id );

        return view('carrier.pre_work.list', compact('pagemeta', 'datas'));
    }

    public function showDetail( $work_id ){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-WK-010');

        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($work_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData(\Auth::user()->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);

        return view('carrier.pre_work.detail', compact( 'pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'work_data'));
    }

}
