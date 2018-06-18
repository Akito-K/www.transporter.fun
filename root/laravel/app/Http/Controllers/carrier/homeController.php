<?php

namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyUser;
use App\Model\Pagemeta;
use App\Model\Log;

class homeController extends carrierController
{

    public function dashboard(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CR-HM-000');
        $me = MyUser::getMe();

        return view('carrier.home.dashboard', compact('pagemeta', 'me'));
    }

}
