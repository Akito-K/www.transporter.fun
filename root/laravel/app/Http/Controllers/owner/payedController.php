<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;
use App\Http\Requests\MyPayedRequest as MyRequest;

use App\Model\Owner;
use App\Model\MyUser;
use App\Model\Order;
use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Work;
use App\Model\Report;
use App\Model\StatusLog;
use App\Model\Payment;

use App\Model\Pagemeta;
use App\Model\Log;

class payedController extends ownerController
{

    public function create($estimate_id){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-PLC-01');
        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);
        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payment_types = Payment::getTypes();

        return view('owner.payed.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payment_types'));
    }

    public function confirm( MyRequest $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );
        $pagemeta = Pagemeta::getPagemeta('OW-PLC-02');

        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);
        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payment_types = Payment::getTypes();

        $request->flash();

        return view('owner.payed.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payment_types'));
    }

    public function execute( Request $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );

        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);

        $request_data = $request->all();
        Payment::saveData( $estimate_data->order_id, $request_data );

        $work_data = Work::getDataByEstimateId($estimate_id);
        $work_data->status_id = 'W-35';
        $work_data->save();

        StatusLog::saveData( 'work_id', $work_data->work_id, 'W-35', __METHOD__ );

        $order_data = Order::getData($work_data->order_id);
        $order_data->status_id = 'O-35';
        $order_data->save();

        StatusLog::saveData( 'order_id', $estimate_data->order_id, 'O-35', __METHOD__ );

        // sendMail

        return redirect('owner/active_order');
    }
}
