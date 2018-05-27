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

class workController extends carrierController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-WRK-01');
        $datas = Work::getActiveDatas(\Auth::user()->carrier_id);

        return view('carrier.work.list', compact('pagemeta', 'datas'));
    }

    public function showDetail( $work_id ){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-WRK-02');

        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier);

        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payed_data = Payment::getPayedData($estimate_data->order_id);
        $target = 'active';

//        return view('carrier.work.detail', compact('pagemeta', 'data', 'carrier'));
        return view('carrier.work.detail', compact( 'pagemeta', 'estimate_data', 'order_data', 'carrier', 'owner_data', 'report_data', 'payed_data', 'target'));
    }

}
