<?php

namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;

class homeController extends ownerController
{

    public function dashboard(Request $request){
        $pagemeta = Pagemeta::getDefault();
        $me = $request['me'];

        return view('owner.home.dashboard', compact('pagemeta', 'me'));
    }

}
