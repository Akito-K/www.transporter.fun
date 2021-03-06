<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;
use App\Http\Requests\MyPlaceRequest as MyRequest;

use App\Model\Owner;
use App\Model\MyUser;
use App\Model\Order;
use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Work;
use App\Model\StatusLog;

use App\Model\Pagemeta;
use App\Model\Log;

class placeController extends ownerController
{

    public function create($estimate_id){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-PL-020');
        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);

        return view('owner.place.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data'));
    }

    public function confirm( MyRequest $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );
        $pagemeta = Pagemeta::getPagemeta('OW-PL-030');

        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData($estimate_data->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);

        $request->flash();

        return view('owner.place.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data'));
    }

    public function execute( Request $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );

        $request_data = $request->all();

        $now_at = new \DatetimeImmutable();
        $estimate_data = Estimate::getData($estimate_id);
        $estimate_data->placed_at = $now_at;
        $estimate_data->place_message = $request_data['body'];
        $estimate_data->save();

        $work_data = Work::getDataByEstimateId($estimate_id);
        $work_data->status_id = 'W-20';
        $work_data->save();

        StatusLog::saveData( 'work_id', $work_data->work_id, 'W-20', __METHOD__ );

        $order_data = Order::getData($work_data->order_id);
        $order_data->status_id = 'O-20';
        $order_data->save();

        StatusLog::saveData( 'order_id', $estimate_data->order_id, 'O-20', __METHOD__ );

        // sendMail

        // 発注対象となる見積以外をお断りに
        Estimate::where('order_id', $estimate_data->order_id)
                ->whereNotNull('suggested_at')
                ->whereNull('placed_at')
                ->whereNull('rejected_at')
                ->update( ['rejected_at' => $now_at] );

        Estimate::where('order_id', $estimate_data->order_id)
                ->whereNull('suggested_at')
                ->delete();

        Work::where('order_id', $estimate_data->order_id)
                ->where('status_id', '<>', 'W-20')
                ->where('status_id', '<>', 'W-00')
                ->update( ['status_id' => 'W-00'] );

        Work::where('order_id', $estimate_data->order_id)
                ->whereNull('status_id')
                ->delete();

        // sendMail

        return redirect('owner/active_order');
    }
}
