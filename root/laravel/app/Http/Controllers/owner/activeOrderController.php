<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;

use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Status;
use App\Model\StatusLog;
use App\Model\Report;
use App\Model\Payment;

use App\Model\Pagemeta;
use App\Model\Log;

class activeOrderController extends ownerController
{

    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-01');
        $datas = Order::getActiveOrdersFromOwnerSide( \Auth::user()->owner_id );
        $status = Status::getNames();
        $target = 'active';

        return view('owner.active_order.list', compact('pagemeta', 'datas', 'status', 'target'));
    }

    public function showDetail($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-02');

        $estimate_data = Estimate::getPlacedEstimateByOrderIdFromOwnerSide($order_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier);
/*
        $data = Order::getOrderFromOwnerSide($order_id);
        Order::addOrderRequests($data);
        Order::addHideOwner($data);
        Order::addCarrierClass($data);
*/
        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payed_data = Payment::getPayedData($order_id);
        $target = 'active';

        return view('owner.active_order.detail', compact( 'pagemeta', 'estimate_data', 'order_data', 'carrier', 'owner_data', 'report_data', 'payed_data', 'target'));
    }


}
