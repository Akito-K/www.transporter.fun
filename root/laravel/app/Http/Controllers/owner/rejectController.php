<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;

use App\Model\Order;
use App\Model\Carrier;
use App\Model\Estimate;
use App\Model\Work;
use App\Model\StatusLog;
use App\Model\Log;

class rejectController extends ownerController
{

    public function execute( $estimate_id ){
        Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );

        $now_at = new \DatetimeImmutable();
        $estimate_data = Estimate::getData($estimate_id);
        $estimate_data->rejected_at = $now_at;
        $estimate_data->save();

        $work_data = Work::getDataByEstimateId($estimate_id);
        $work_data->status_id = 'W-00';
        $work_data->save();

        StatusLog::saveData( 'work_id', $work_data->work_id, 'W-00', __METHOD__ );

        // sendMail

        return redirect('owner/estimate/'.$estimate_data->order_id.'/list');
    }
}
