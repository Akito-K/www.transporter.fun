<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;
use App\Http\Requests\MyRequestRequest as MyRequest;

//use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\StatusLog;

use App\Model\Pagemeta;
use App\Model\Log;

class nominateRequestController extends ownerController
{

    public function create($order_id){
        Log::saveData( __METHOD__ , 'order_id', $order_id, true);
        $pagemeta = Pagemeta::getPagemeta('OW-RQ-020');
        $data = Order::getOrderFromOwnerSide($order_id);
        Order::addOrderRequests($data);

        return view('owner.request.create', compact('data', 'pagemeta'));
    }

    public function confirm(MyRequest $request){
        Log::saveData( __METHOD__ );

        $request->flash();
        $action = 'create';

        $pagemeta = Pagemeta::getPagemeta('OW-RQ-030');
        $order_id = $request['order_id'];
        $data = Order::getOrderFromOwnerSide($order_id);
        Order::addOrderRequests($data);

        return view('owner.request.confirm', compact('data', 'pagemeta'));
    }

    public function execute(Request $request){
        Log::saveData( __METHOD__ );

        $request_data = $request->all();
        $order_id = $request_data['order_id'];

        $estimate_close_at = new \DatetimeImmutable( $request_data['hide_estimate_close_at'].' '.$request_data['estimate_close_at_hour'].':'.$request_data['estimate_close_at_minutes'].':00');
        // 期間内なら実行
        $now_at = new \DatetimeImmutable();
        if( $now_at < $estimate_close_at ){
            $order = Order::where('order_id', $order_id)->first();
            $order->estimate_start_at = $now_at;
            $order->estimate_close_at = $estimate_close_at;
            $order->status_id = 'O-10';
            $order->updated_at = $now_at;
            $order->save();

            StatusLog::saveData( 'order_id', $order_id, 'O-10', __METHOD__ );

            // sendMail
            // $data->body;
        }

        return redirect('owner/active_order');
    }


}
