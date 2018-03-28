<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;

class pagemetaController extends adminController
{
    public function showList(){
        $filepath = \Func::getRootPath().'/pagemeta/pagemeta.csv';
        if( !file_exists($filepath) ){
            $pagemeta = Pagemeta::getDefault();
        }else{
            $pagemeta = Pagemeta::getDefault();
/*
            $datas = Pagemeta::getDatas();
            $pagemeta = Pagemeta::getData('AD-PM-01');
            $pagemeta->body_class .= " staff";
            $pagemeta->breadcrumbs = '<li><i class="fa fa-gear"></i> 設定</li>';
*/
        }

        return view('admin.pagemeta.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getDefault();

        return view('admin.pagemeta.create', compact('pagemeta'));
    }

    public function make(Request $request){
    }

}
