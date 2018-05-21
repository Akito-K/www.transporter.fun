<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Work;
use App\Model\Carrier;
use App\Model\Pagemeta;
use App\Model\Log;

class workController extends carrierController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-WRK-01');
        $datas = Work::getActiveDatas(\Auth::user()->carrier_id);

        return view('carrier.work.list', compact('pagemeta', 'datas'));
    }

    public function showDetail( $work_id ){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $pagemeta = Pagemeta::getPagemeta('CR-WRK-02');
        $data = Work::getWork($work_id);
        $carrier = Carrier::getData(\Auth::user()->carrier_id);

        return view('carrier.work.detail', compact('pagemeta', 'data', 'carrier'));
    }

}
