<?php

namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;

class homeController extends mypageController
{

    public function dashboard(){
        $pagemeta = Pagemeta::getDefault();
        //$page_id = 'MY-HM-01';
        //$pagemeta = Pagemeta::getData($page_id);
//        $pagemeta->breadcrumbs = '<li><i class="fa fa-gear"></i> ダッシュボード</li>';

        return view('mypage.home.dashboard', compact('pagemeta'));
    }

}
