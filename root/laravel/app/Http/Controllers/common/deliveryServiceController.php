<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;

class deliveryServiceController extends Controller
{
    public function index (){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.delivery_service.index', compact('pagemeta'));
    }

    public function withintoday(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        // 本日まで

        return view('common.delivery_service.withintoday', compact('pagemeta'));
    }

    public function fewdays(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        // 近日中

        return view('common.delivery_service.fewdays', compact('pagemeta'));
    }

    public function Regularly(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        // 定期案件

        return view('common.delivery_service.Regularly', compact('pagemeta'));
    }

    public function Occasionally(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        // 不定期案件

        return view('common.delivery_service.Occasionally', compact('pagemeta'));
    }

    public function Category(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        // カテゴリー

        return view('common.delivery_service.Category', compact('pagemeta'));
    }


}
