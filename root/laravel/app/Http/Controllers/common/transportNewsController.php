<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;

class transportNewsController extends Controller
{
    public function index (){
        $pagemeta = Pagemeta::getPagemeta('CM-HM-000');
        $datas = $this->getNews();

        return view('common.transport_news.index', compact('pagemeta', 'datas'));
    }

    public function getNews (){
/*
        $logiurl = 'http://www.e-logit.com/loginews/loginews.php';
        $logidata = file_get_contents($logiurl);
        $logidatas = \Func::getURL($logidata);

        $datas = [];
        if(!empty($logidatas[0])){
            foreach($logidatas[0] as $url){
                $data = file_get_contents($url);
                $pattern = '/\<div class\=\"wideNarrow\"\>.+?\<\/div\>/';
                if(preg_match_all( $pattern, $data, $matches)){
                    $datas[] = $matches[0];
                }
                \Func::var_dump( $datas );
                exit;
            }
        }
*/
        return null;
    }




}
