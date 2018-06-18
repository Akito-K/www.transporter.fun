<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
//use App\Model\Log;

class helpController extends Controller
{
    public function index (){
//        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CM-HL-000');

        return view('common.help.index', compact('pagemeta'));
    }

}
