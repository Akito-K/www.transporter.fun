<?php

namespace App\Http\Controllers\carrier;
use App\Http\Controllers\carrierController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyUser;
use App\Model\Pagemeta;

class homeController extends carrierController
{

    public function dashboard(Request $request){
        $pagemeta = Pagemeta::getDefault();
        $me = MyUser::getMe();

        return view('carrier.home.dashboard', compact('pagemeta', 'me'));
    }

}
