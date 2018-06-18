<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

//use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\Status;
use App\Model\Pagemeta;
use App\Model\Log;

class preOrderController extends ownerController
{

    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-OD-000');
        $datas = Order::getPreOrdersFromOwnerSide( \Auth::user()->owner_id );
        $status = Status::getNames();

        return view('owner.pre_order.list', compact('pagemeta', 'datas', 'status'));
    }

    public function showDetail($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id );
        $pagemeta = Pagemeta::getPagemeta('OW-ORD-010');
        $data = Order::getOrderFromOwnerSide($order_id);
        Order::addOrderRequests($data);
        Order::addHideOwner($data);
        Order::addCarrierClass($data);

        return view('owner.pre_order.detail', compact('data', 'pagemeta'));
    }

}
