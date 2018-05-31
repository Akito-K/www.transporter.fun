<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Work;
use App\Model\Order;
use App\Model\StatusLog;
use App\Model\Log;

class confirmPaymentController extends carrierController
{

    public function execute( $work_id ){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true );

        $work_data = Work::getData($work_id);
        $work_data->status_id = 'W-40';
        $work_data->save();

        StatusLog::saveData( 'work_id', $work_id, 'W-40', __METHOD__ );

        $order_data = Order::getData($work_data->order_id);
        $order_data->status_id = 'O-40';
        $order_data->save();

        StatusLog::saveData( 'order_id', $work_data->order_id, 'O-40', __METHOD__ );

        // sendMail

        return redirect('carrier/closed_work');
    }
}
