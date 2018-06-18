<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Work;
/*
use App\Model\Carrier;
use App\Model\MyUser;
use App\Model\Owner;
use App\Model\Order;
use App\Model\Estimate;
use App\Model\Report;
use App\Model\Payment;
*/
use App\Model\Pagemeta;
use App\Model\Log;

class activeWorkController extends carrierController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-WK-001');
        $datas = Work::getActiveWorksByCarrierId( \Auth::user()->carrier_id );
        $target = 'active';

        return view('carrier.work.list', compact('pagemeta', 'datas', 'target'));
    }
}
