<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pagemeta extends Model
{
    public static function getPagemeta($page_id){
        $filepath = \Func::getRootPath().'/pagemeta/pagemeta.csv';
        $flag_no_data = false;
        if( !file_exists($filepath) ){
            $flag_no_data = true;
        }else{
            $datas = Pagemeta::getDatas($filepath);
            if( !isset($datas[ $page_id ]) ){
                $flag_no_data = true;
            }else{
                $pagemeta = $datas[ $page_id ];
            }
        }

        if($flag_no_data){
            $pagemeta = Pagemeta::getDefault();
        }

        return $pagemeta;
    }

    public static function getPagemetas(){
        $datas = [];
        $filepath = \Func::getRootPath().'/pagemeta/pagemeta.csv';
        if( file_exists($filepath) ){
            $datas = Pagemeta::getDatas($filepath);
        }

        return $datas;
    }

    public static function getDefault(){
        $pagemeta = new \stdClass();
        $pagemeta->title = "";
        $pagemeta->keywords = "";
        $pagemeta->description = "";
        $pagemeta->body_class = "";

        return $pagemeta;
    }

    public static function getDatas($filepath){
        $datas = [];
        // ファイルポインタをオープン
        $handle = fopen($filepath, "r");
        // ファイル内容を取得
        while ($line = fgets($handle)) {
            if( preg_match('/,/', $line) ){
                $data = explode(',', $line);
                $datas[ $data[0] ] = (object) [
                    'page_id' => $data[0],
                    'title' => $data[1],
                    'description' => $data[2],
                    'body_class' => $data[3],
                ];
            }
        }
        // ファイルポインタをクローズ
        fclose($handle);

        return $datas;
    }

    public static function format($datas){
//        \Func::var_dump($datas);exit;
        $datas = $datas['route'];
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if( !isset($data['ページID']) || !isset($data['名前1']) ){
                    continue;
                }
                $page = new \stdClass();
                $page->page_id = $data['ページID'];
                $page->title = $data['名前1'];
                if( isset($data['名前2']) ){
                    $page->title .= ' '.$data['名前2'];
                }
                $page->description = "";
                if( isset($data['名前3']) ){
                    $page->description .= $data['名前3'];
                }
                $page->body_class = "";
                if( isset($data['階層1']) ){
                    $page->body_class .= 'page-'.$data['階層1'];
                }
                if( isset($data['階層2']) ){
                    $page->body_class .= ' '.$data['階層2'];
                }
                $ary[$data['ページID']] = $page;
            }
        }

        return $ary;
    }

    public static function toCSV($datas){
        $body = "";
        if(!empty($datas)){
            foreach($datas as $data){
                $body .= $data->page_id.",";
                $body .= $data->title.",";
                $body .= $data->description.",";
                $body .= $data->body_class."\n";
            }
        }

        return $body;
    }
}
