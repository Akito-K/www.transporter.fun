<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;
use App\Http\Requests\MySuggestRequest as MyRequest;

use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Work;
use App\Model\StatusLog;

use App\Model\Pagemeta;
use App\Model\Log;

class suggestController extends carrierController
{

    public function create($estimate_id){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-SG-020');
        $estimate_data = Estimate::getEstimateFromCarrierSide($estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData(\Auth::user()->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);

        return view('carrier.suggest.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data'));
    }

    public function confirm( Request $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );
        $pagemeta = Pagemeta::getPagemeta('CR-SG-030');

        $estimate_data = Estimate::getEstimateFromCarrierSide($estimate_id);
        $order_data = Order::getOrderFromCarrierSide($estimate_data->order_id);
        $owner_data = Owner::getData($order_data->owner_id);
        MyUser::addIconFilepathToOwnerData($owner_data);
        $carrier_data = Carrier::getData(\Auth::user()->carrier_id);
        MyUser::addIconFilepathToCarrierData($carrier_data);

        $request->flash();

        return view('carrier.suggest.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier_data', 'owner_data'));
    }

    public function execute( Request $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );

        $request_data = $request->all();

        $now_at = new \DatetimeImmutable();
        $estimate_data = Estimate::getData($estimate_id);
        $estimate_data->suggested_at = $now_at;
        $estimate_data->suggest_message = $request_data['body'];
        $estimate_data->save();

        $data = Work::getDataByEstimateId($estimate_id);
        $data->status_id = 'W-10';
        $data->save();

        StatusLog::saveData( 'order_id', $estimate_data->order_id, 'W-10', __METHOD__ );

        return redirect('carrier/work');
    }
}
