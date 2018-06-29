<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Order;

class deliveryServiceController extends Controller
{
    public function index (){
        $pagemeta = Pagemeta::getPagemeta('CM-DS-000');
        $order_datas = Order::getEstimatableOrderDatas();

        return view('common.delivery_service.index', compact('pagemeta', 'order_datas'));
    }

    public function detail ($order_id){
        $pagemeta = Pagemeta::getPagemeta('CM-DS-005');
        $order_data = Order::getOrderFromOwnerSide($order_id);

        return view('common.delivery_service.detail', compact('pagemeta', 'order_data'));
    }

    // 本日まで
    public function withintoday(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();

        return view('common.delivery_service.withintoday', compact('pagemeta', 'order_datas'));
    }

    // 近日中
    public function fewdays(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();

        return view('common.delivery_service.fewdays', compact('pagemeta', 'order_datas'));
    }

    // 定期案件
    public function Regularly(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();

        return view('common.delivery_service.Regularly', compact('pagemeta', 'order_datas'));
    }

    // 不定期案件
    public function Occasionally(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();

        return view('common.delivery_service.Occasionally', compact('pagemeta', 'order_datas'));
    }

    // カテゴリー
    public function Category(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.delivery_service.Category', compact('pagemeta'));
    }


}
