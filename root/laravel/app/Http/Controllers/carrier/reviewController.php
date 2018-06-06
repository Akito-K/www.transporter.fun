<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;
use App\Http\Requests\MyReviewRequest as MyRequest;

use App\Model\Work;
use App\Model\Carrier;
use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\Estimate;
use App\Model\Report;
use App\Model\Payment;
use App\Model\EvaluationItem;
use App\Model\Evaluation;

use App\Model\Pagemeta;
use App\Model\Log;

class carrierReviewController extends carrierController
{

    public function create( $work_id ){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-RVW-01');

        $work_data = Work::getData($work_id);
        $estimate_data = Estimate::getEstimateFromCarrierSide($work_data->estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData( \Auth::user()->carrier_id );
        MyUser::addIconFilepathToCarrierData($carrier_data);
        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payed_data = Payment::getPayedData($estimate_data->order_id);

        $evaluation_items = EvaluationItem::getActiveNames('owner');

        return view('carrier.review.create', compact('pagemeta', 'work_data', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payed_data', 'evaluation_items'));
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
        $carrier_data = Carrier::getData( \Auth::user()->carrier_id );
        MyUser::addIconFilepathToCarrierData($carrier_data);
        $report_data = Report::getData('order_id', $estimate_data->order_id);
        $payed_data = Payment::getPayedData($estimate_data->order_id);
        $evaluation_items = EvaluationItem::getActiveNames('owner');

        $request->flash();

        return view('carrier.review.confirm', compact('pagemeta', 'work_data', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payed_data', 'evaluation_items'));
    }

    public function execute( Request $request ){
        $work_id = $request['work_id'];
        Log::saveData( __METHOD__ , 'work_id', $work_id, true );

        $request_data = $request->all();
        $work_data = Work::getData($work_id);

        $target_user_id = MyUser::getOwnerUserIdByOrderId( $work_data->order_id );
        $my_user_id = \Auth::user()->user_id;
        Evaluation::saveData( 'owner', $target_user_id, $my_user_id, $work_data->order_id, $request_data );

        $now_at = new \DatetimeImmutable();
        $work_data->evaluated_at = $now_at;
        $work_data->save();
/*
        $order_data = Order::getData($work_data->order_id);
        $order_data->evaluated_at = $now_at;
        $order_data->save();
*/
        return redirect('carrier/closed_work');
    }
}
