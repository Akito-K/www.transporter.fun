<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;
use App\Model\Log;
use App\Model\MyUser;

class logController extends adminController
{
    protected $per_page = 50;

    public function showList($page=1){
        $pagemeta = Pagemeta::getPagemeta('AD-LG-000');

        $pages = $this->getPages($page);
        $offset = ($pages['current']-1) * $this->per_page;
        $limit = $this->per_page;
        $datas = Log::getLogs($offset, $limit);
        $user_datas = MyUser::getUsersAsUserId();
        $start_number = ($page - 1) * $this->per_page + 1;

        return view('admin.log.list', compact('pagemeta', 'datas', 'pages', 'user_datas', 'start_number'));
    }

    // ~1 は 0, 2~ がページング有効値 1~
    public function getPages($page){
        $count = Log::getCount();
        $total = ceil( $count / $this->per_page );
        $current = $page;

        if( $page >= $total ){
            $current = $total;
        }
        if($page <= 1){
            $current = 1;
        }

        return ['current' => $current, 'total' => $total];
    }

}
