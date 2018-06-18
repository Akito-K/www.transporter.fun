<?php

namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyUser;
use App\Model\Pagemeta;
use App\Model\Log;

class homeController extends ownerController
{

    public function dashboard(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-HM-000');
        $me = MyUser::getMe();

        return view('owner.home.dashboard', compact('pagemeta', 'me'));
    }

}
