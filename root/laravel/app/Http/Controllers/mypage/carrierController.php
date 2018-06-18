<?php
namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;
use Illuminate\Http\Request;
use App\Http\Requests\MyCarrierRequest as MyRequest;

use App\Model\Carrier;
use App\Model\Pref;
use App\Model\Car;
use App\Model\Area;
use App\Model\CarEmpty;
use App\Model\Pagemeta;
use App\Model\Log;

class carrierController extends mypageController
{
    public function showList(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-CR-000');
        $carrier_datas = Carrier::getCarriers();

        return view('mypage.carrier.list', compact('pagemeta', 'carrier_datas', 'prefs'));
    }

    public function showDetail($carrier_id){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('MY-CR-010');
        $carrier_data = Carrier::getData($carrier_id);
        $carrier_data->star = view('include.star', ['star' => $carrier_data->star])->render();
        $prefs = Pref::getNames();

        $car_datas = Car::getCars($carrier_id);
        $empty_datas = CarEmpty::getDatas($carrier_id);
        $area_names = Area::getNames();

        return view('mypage.carrier.detail', compact('pagemeta', 'carrier_data', 'prefs', 'car_datas', 'empty_datas', 'area_names'));
    }
}
