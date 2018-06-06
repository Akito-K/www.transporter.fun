<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
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

class ownerReviewController extends ownerController
{

    public function create( $order_id ){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-RVW-01');

        $order_data = Order::getOrderFromOwnerSide($order_id);
        $estimate_data = Estimate::getPlacedEstimateByOrderIdFromOwnerSide( $order_id );
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);
        $report_data = Report::getData('order_id', $order_id);
        $payed_data = Payment::getPayedData($order_id);

        $evaluation_items = EvaluationItem::getActiveNames('carrier');

        return view('owner.review.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payed_data', 'evaluation_items'));
    }

    public function confirm( MyRequest $request ){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true );
        $pagemeta = Pagemeta::getPagemeta('OW-RCV-02');

        $order_data = Order::getOrderFromOwnerSide($order_id);
        $estimate_data = Estimate::getPlacedEstimateByOrderIdFromOwnerSide( $order_id );
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);
        $report_data = Report::getData('order_id', $order_id);
        $payed_data = Payment::getPayedData($order_id);

        $evaluation_items = EvaluationItem::getActiveNames('carrier');

        $request->flash();

        return view('owner.review.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data', 'report_data', 'payed_data', 'evaluation_items'));
    }

    public function execute( Request $request ){
        $order_id = $request['order_id'];
        Log::saveData( __METHOD__ , 'order_id', $order_id, true );

        $request_data = $request->all();

        $target_user_id = MyUser::getCarrierUserIdByOrderId( $order_id );
        $my_user_id = \Auth::user()->user_id;
        Evaluation::saveData( 'carrier', $target_user_id, $my_user_id, $order_id, $request_data );

        $now_at = new \DatetimeImmutable();
        $order_data = Order::getData($order_id);
        $order_data->evaluated_at = $now_at;
        $order_data->save();

        return redirect('owner/closed_order');
    }
}
