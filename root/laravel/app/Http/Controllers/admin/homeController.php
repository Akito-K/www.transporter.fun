<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;
use App\Model\News;

class homeController extends adminController
{

    public function dashboard(){
        $pagemeta = Pagemeta::getDefault();

        return view('admin.home.dashboard', compact('pagemeta'));
    }


}
