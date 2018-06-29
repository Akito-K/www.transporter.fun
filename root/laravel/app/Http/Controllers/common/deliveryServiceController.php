<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Order;
use App\Model\Owner;

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
        $commit = 'withintoday';
        Order::editDatas($order_datas, $commit);

        return view('common.delivery_service.withintoday', compact('pagemeta', 'order_datas', 'commit'));
    }

    // 近日中
    public function fewdays(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();
        $commit = 'fewdays';
        Order::editDatas($order_datas, $commit);

        return view('common.delivery_service.fewdays', compact('pagemeta', 'order_datas', 'commit'));
    }

    // 定期案件
    public function Regularly(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();
        $commit = 'Regularly';
        Order::editDatas($order_datas, $commit);

        return view('common.delivery_service.Regularly', compact('pagemeta', 'order_datas', 'commit'));
    }

    // 不定期案件
    public function Occasionally(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $order_datas = Order::getEstimatableOrderDatas();
        $commit = 'Occasionally';
        Order::editDatas($order_datas, $commit);

        return view('common.delivery_service.Occasionally', compact('pagemeta', 'order_datas', 'commit'));
    }

    // カテゴリー
    public function Category(){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');

        return view('common.delivery_service.Category', compact('pagemeta'));
    }

    // フリーテキスト検索
    public function search(Request $request){
        $pagemeta = Pagemeta::getPagemeta('CM-WW-000');
        $words = urldecode($request['keywords']);
        $words = str_replace('　', ' ', $words);
        if(strpos($words, ' ') !== false){
            $keywords = explode(' ', $words);
        }else{
            $keywords = [$words];
        }

        $order_datas = [];
        $checked = [];
        if(!empty($keywords)){
            foreach($keywords as $keyword){
                $matches = Order::searchFreeWords($keyword);
                if(!empty($matches)){
                    foreach($matches as $matched){
                        if( !in_array($matched->id, $checked) ){
                            $checked[] = $matched->id;

                            $owner = Owner::getData($matched->owner_id);
                            $matched->owner_name = $matched->flag_hide_owner? '***（非公開）': $owner->company.' '.$owner->sei.$owner->mei;
                            $matched->owner_name .= '様';
                            $matched->is_withtoday = Order::isWithToday($matched);
                            $matched->is_fewdays = Order::isFewDay($matched);
                            $matched->send = Order::getSendAddress($matched);
                            $matched->arrive = Order::getArriveAddress($matched);

                            $order_datas[] = $matched;
                        }
                    }
                }
            }
        }

        return view('common.delivery_service.search', compact('pagemeta', 'order_datas'));
    }


}
