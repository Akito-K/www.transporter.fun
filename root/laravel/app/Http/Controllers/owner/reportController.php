<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;
use App\Http\Requests\MyReportRequest as MyRequest;

use App\Model\Order;
use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Work;
use App\Model\StatusLog;
use App\Model\Report;

use App\Model\Pagemeta;
use App\Model\Log;

class reportController extends carrierController
{

    public function create($work_id){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-RCV-01');
        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);

        return view('carrier.report.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier', 'work_data'));
    }

    public function confirm( MyRequest $request ){
        $work_id = $request['work_id'];
        Log::saveData( __METHOD__ , 'work_id', $work_id, true );
        $pagemeta = Pagemeta::getPagemeta('OW-RCV-02');

        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);
        $request->flash();

        return view('carrier.report.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier', 'work_data'));
    }

    public function execute( Request $request ){
        $work_id = $request['work_id'];
        Log::saveData( __METHOD__ , 'work_id', $work_id, true );

        $request_data = $request->all();

        $work_data = Work::getData($work_id);
        $work_data->status_id = 'W-25';
        $work_data->save();

        $progress = new StatusLog;
        $progress->work_id = $work_id;
        $progress->status_id = $work_data->status_id;
        $progress->save();

        $order_data = Order::getData($work_data->order_id);
        $order_data->status_id = 'O-30';
        $order_data->save();

        $progress = new StatusLog;
        $progress->order_id = $work_data->order_id;
        $progress->status_id = $order_data->status_id;
        $progress->save();

        $data = new Report;
        $data->report_id = Report::getNewId();
        $data->work_id = $work_id;
        $data->order_id = $work_data->order_id;
        $data->carrier_id = $work_data->carrier_id;
        $data->arrived_at = new \Datetime( $request_data['hide_arrived_at'] .' '. $request_data['arrived_at_hour'].':00:00' );
        $data->completed_at = new \Datetime( $request_data['hide_completed_at'] .' '. $request_data['completed_at_hour'].':00:00' );
        $data->trouble = $request_data['trouble'];
        $data->comment = $request_data['comment'];
        $data->save();

        // 請求

        return redirect('carrier/work');
    }
}
