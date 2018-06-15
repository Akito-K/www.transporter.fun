<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Log;

//use App\Mail\MailSignup;
//use Illuminate\Support\Facades\Mail;

class epsilonController extends Controller
{
    public function entry (Request $request){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CM-EP-010');

    }

    public function error (Request $request){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CM-EP-020');

    }

    public function result (Request $request){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('CM-EP-030');

    }

}
