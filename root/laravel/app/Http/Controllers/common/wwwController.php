<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;

class wwwController extends Controller
{
    public function index (){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-000');

        return view('common.www.index', compact('pagemeta'));
    }

    public function trucks (){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-005');

        return view('common.www.trucks', compact('pagemeta'));
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
