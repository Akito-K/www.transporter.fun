<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use App\Http\Controllers\owner\activeOrderController;

use Illuminate\Http\Request;

use App\Model\Status;
use App\Model\Order;
use App\Model\Log;

use App\Model\Estimate;
use App\Model\Owner;
use App\Model\MyUser;
use App\Model\Carrier;
use App\Model\Report;
use App\Model\Payment;
/*
use App\Model\Work;
use App\Model\StatusLog;
*/
use App\Model\Pagemeta;

class closedOrderController extends ownerController
{

    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-01');
        $datas = Order::getClosedOrdersFromOwnerSide( \Auth::user()->owner_id );
        $status = Status::getNames();

        return view('owner.closed_order.list', compact('pagemeta', 'datas', 'status'));
    }

    public function showDetail($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-02');

        $estimate_data = Estimate::getPlacedEstimateByOrderIdFromOwnerSide($order_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);

        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payed_data = Payment::getPayedData($order_id);

        return view('owner.closed_order.detail', compact( 'pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payed_data'));
    }


}
