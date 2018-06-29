<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Order;
use App\Model\CarEmpty;
use App\Model\Car;
use App\Model\Area;

class wwwController extends Controller
{
    public function index (){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-000');
        $order_datas = Order::getEstimatableOrderDatas();
        $empty_datas = CarEmpty::getAllEmpties();
        $car_datas = Car::getAllCars();
        $area_names = Area::getNames();

        return view('common.www.index', compact('pagemeta', 'order_datas', 'empty_datas', 'car_datas', 'area_names'));
    }

    public function trucks (){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-005');
        $empty_datas = CarEmpty::getAllEmpties();
        $car_datas = Car::getAllCars();
        $area_names = Area::getNames();

        return view('common.www.trucks', compact('pagemeta', 'empty_datas', 'car_datas', 'area_names'));
    }

    public function company(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-010');

        return view('common.www.company', compact('pagemeta'));
    }

    public function compliance(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-015');

        return view('common.www.compliance', compact('pagemeta'));
    }

    public function transportation(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-020');

        return view('common.www.transportation', compact('pagemeta'));
    }

    public function safety(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-025');

        return view('common.www.safety', compact('pagemeta'));
    }

    public function corporateRules(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-030');

        return view('common.www.corporateRules', compact('pagemeta'));
    }

    public function tokushoho(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-035');

        return view('common.www.tokushoho', compact('pagemeta'));
    }

    public function privacypolicy(){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-040');

        return view('common.www.privacypolicy', compact('pagemeta'));
    }



}
