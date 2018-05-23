<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;
use App\Http\Requests\MyPlaceRequest as MyRequest;

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
        $pagemeta = Pagemeta::getPagemeta('OW-PLC-01');
        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $carrier = Carrier::getData($estimate_data->carrier_id);

        return view('owner.place.create', compact('pagemeta', 'estimate_data', 'order_data', 'carrier'));
    }

    public function confirm( MyRequest $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );
        $pagemeta = Pagemeta::getPagemeta('OW-PLC-02');

        $estimate_data = Estimate::getEstimateFromOwnerSide($estimate_id);
        $order_data = Order::getOrderFromOwnerSide($estimate_data->order_id);
        $carrier = Carrier::getData($estimate_data->carrier_id);
        $request->flash();

        return view('owner.place.confirm', compact('pagemeta', 'estimate_data', 'order_data', 'carrier'));
    }

    public function execute( Request $request ){
        $estimate_id = $request['estimate_id'];
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );

        $request_data = $request->all();

        // 開発中 2018.05.23 23:21 Akito
        $now_at = new \DatetimeImmutable();
        $estimate_data = Estimate::getData($estimate_id);
        $estimate_data->placed_at = $now_at;
        $estimate_data->place_message = $request_data['body'];
        $estimate_data->save();

        $data = Work::getDataByEstimateId($estimate_id);
        $data->status_id = 'W-10';
        $data->save();

        $progress = new StatusLog;
        $progress->order_id = $estimate_data->order_id;
        $progress->status_id = $data->status_id;
        $progress->save();

        return redirect('carrier/work');
    }
}
