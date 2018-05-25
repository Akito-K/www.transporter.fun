<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;
use App\Http\Requests\MyReceiveRequest as MyRequest;

use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Work;
use App\Model\StatusLog;

use App\Model\Pagemeta;
use App\Model\Log;

class receiveController extends carrierController
{

    public function create($work_id){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-RCV-01');
        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier);

        return view('carrier.receive.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier', 'work_data', 'owner_data'));
    }

    public function confirm( MyRequest $request ){
        $work_id = $request['work_id'];
        Log::saveData( __METHOD__ , 'work_id', $work_id, true );
        $pagemeta = Pagemeta::getPagemeta('OW-RCV-02');

        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier);

        $request->flash();

        return view('carrier.receive.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier', 'work_data', 'owner_data'));
    }

    public function execute( Request $request ){
        $work_id = $request['work_id'];
        Log::saveData( __METHOD__ , 'work_id', $work_id, true );

        $request_data = $request->all();

        $now_at = new \DatetimeImmutable();
        $work_data = Work::getData($work_id);
        $work_data->status_id = 'W-25';
        $work_data->save();

        $estimate_data = Estimate::getData($work_data->estimate_id);
        $estimate_data->received_at = $now_at;
        $estimate_data->receive_message = $request_data['body'];
        $estimate_data->save();

        StatusLog::saveData( 'work_id', $work_id, 'W-25', __METHOD__ );

        $order_data = Order::getData($work_data->order_id);
        $order_data->status_id = 'O-25';
        $order_data->save();

        StatusLog::saveData( 'order_id', $work_data->order_id, 'O-25', __METHOD__ );

        return redirect('carrier/work');
    }
}
