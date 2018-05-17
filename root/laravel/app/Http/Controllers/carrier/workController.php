<?php
namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;
use Illuminate\Http\Request;

use App\Model\Work;
use App\Model\Pagemeta;
use App\Model\Log;

class workController extends carrierController
{
    public function showList(Request $request){
        Log::saveData( __METHOD__ );
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('CR-WRK-01');

        $datas = Work::getDatas($me->carrier_id);

        return view('carrier.work.list', compact('pagemeta', 'datas'));
    }

    public function showDetail($work_id, Request $request){
        Log::saveData( __METHOD__ , 'work_id', $work_id, true);
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('CR-WRK-02');
        $data = Work::getData($work_id);

        return view('carrier.work.detail', compact('pagemeta', 'data'));
    }

}
