<?php

namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyUser;
use App\Model\Pagemeta;

class homeController extends ownerController
{

    public function dashboard(Request $request){
        $pagemeta = Pagemeta::getDefault();
        $me = MyUser::getMe();

        return view('owner.home.dashboard', compact('pagemeta', 'me'));
    }

}
