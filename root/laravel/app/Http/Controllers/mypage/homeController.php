<?php

namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyUser;
use App\Model\Pagemeta;
use App\Model\Log;

class homeController extends mypageController
{

    public function dashboard(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-HM-000');
        $me = MyUser::getMe();

        return view('mypage.home.dashboard', compact('pagemeta', 'me'));
    }

    public function status(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-ST-000');
        $me = MyUser::getMe();

        return view('mypage.home.status', compact('pagemeta', 'me'));
    }

    public function passwordReset(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-HM-005');

        return view('mypage.home.password_reset', compact('pagemeta'));
    }

}
