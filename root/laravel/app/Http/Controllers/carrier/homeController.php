<?php

namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;

class homeController extends carrierController
{

    public function dashboard(Request $request){
        $pagemeta = Pagemeta::getDefault();
        $me = $request['me'];

        return view('carrier.home.dashboard', compact('pagemeta', 'me'));
    }

}
