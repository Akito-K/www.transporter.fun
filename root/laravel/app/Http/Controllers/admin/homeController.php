<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;
use App\Model\Log;

class homeController extends adminController
{

    public function dashboard(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('AD-HM-000');

        return view('admin.home.dashboard', compact('pagemeta'));
    }


}
