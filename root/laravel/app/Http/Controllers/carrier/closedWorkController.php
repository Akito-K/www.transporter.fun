<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Work;
use App\Model\Carrier;
use App\Model\Pagemeta;
use App\Model\Log;

class closedWorkController extends carrierController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-WK-002');
        //$datas = Work::getActiveDatas(\Auth::user()->carrier_id);
        $datas = Work::getClosedWorksByCarrierId( \Auth::user()->carrier_id );
        $target = 'closed';

        return view('carrier.work.list', compact('pagemeta', 'datas', 'target'));
    }
}
