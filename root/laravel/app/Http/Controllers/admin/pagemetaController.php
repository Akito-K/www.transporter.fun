<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pagemeta;
use App\Model\Upload;
use App\Model\MySpreadsheet;

class pagemetaController extends adminController
{
    public function showList(){
        $datas = Pagemeta::getPagemetas();
        $pagemeta = Pagemeta::getPagemeta('AD-PM-01');

        return view('admin.pagemeta.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-PM-02');

        return view('admin.pagemeta.create', compact('pagemeta'));
    }

    public function confirm(Request $request){
        $pagemeta = Pagemeta::getPagemeta('AD-PM-03');

        $upload_id = $request['upload_id'];
        $file = Upload::getData($upload_id);
        $filepath = \Func::getRootPath().$file->dirpath.'/'.$upload_id.'.'.$file->extension;

        $Excel = new MySpreadsheet();
        $datas = $Excel->getExcelData($filepath);
        $datas = Pagemeta::format($datas);

        return view('admin.pagemeta.confirm', compact('pagemeta', 'upload_id', 'datas'));
    }

    public function update(Request $request){
        $upload_id = $request['upload_id'];
        $file = Upload::getData($upload_id);
        $root = \Func::getRootPath();
        $filepath = $root.$file->dirpath.'/'.$upload_id.'.'.$file->extension;

        $Excel = new MySpreadsheet();
        $datas = $Excel->getExcelData($filepath);
        $datas = Pagemeta::format($datas);
        $csv = Pagemeta::toCSV($datas);

        $fullpath = $root.'/pagemeta';
        if(!file_exists($fullpath)){
            mkdir($fullpath);
        }
        $fullpath .= '/pagemeta.csv';
        // ファイルポインタをオープン
        $handle = fopen($fullpath, "w");
        // ファイルへ書き込み
        fwrite($handle, $csv);
        // ファイルポインタをクローズ
        fclose($handle);

        return redirect('/admin/pagemeta');
    }

}
