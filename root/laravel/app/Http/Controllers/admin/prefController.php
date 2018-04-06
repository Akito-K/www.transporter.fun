<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pref;
use App\Model\Pagemeta;

class prefController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-PRF-01');
        $datas = Pref::getDatas();

        return view('admin.pref.list', compact('pagemeta', 'datas'));
    }

}
