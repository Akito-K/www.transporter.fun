<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;

class transporterController extends Controller
{
    public function index (){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.transporter.index', compact('pagemeta'));
    }

    public function driver(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.transporter.driver', compact('pagemeta'));
    }

    public function carrier(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.transporter.carrier', compact('pagemeta'));
    }

    public function ranking(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.transporter.ranking', compact('pagemeta'));
    }


}
