<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

use App\Model\MyUser;
//use App\Model\Owner;
use App\Model\Order;
use App\Model\Carrier;
use App\Model\Item;
use App\Model\Estimate;
use App\Model\EstimateItem;

use App\Model\Pagemeta;
use App\Model\Log;

class estimateController extends ownerController
{
    public function showOrderList ( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);

        $pagemeta = Pagemeta::getPagemeta('OW-EM-000');
        $order_data = Order::getOrderFromOwnerSide($order_id);
        $datas = Estimate::getEstimatesByOrderIdFromOwnerSide($order_id);

        return view('owner.estimate.order_list', compact('pagemeta', 'order_data', 'datas'));
    }

    public function showDetail ( $estimate_id ){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);

        $pagemeta = Pagemeta::getPagemeta('OW-EM-010');
        $data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $owner = Carrier::getData(\Auth::user()->owner_id);
        $carrier_data = Carrier::getData( $data->carrier_id );
        MyUser::addIconFilepathToCarrierData($carrier_data);

        return view('owner.estimate.detail', compact('pagemeta', 'data', 'owner', 'carrier_data'));
    }

}
