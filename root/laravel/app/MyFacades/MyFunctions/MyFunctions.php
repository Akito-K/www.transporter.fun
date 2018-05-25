<?php

namespace MyFacade;


use Illuminate\Support\Facades\DB;
use App\Model\Upload;

use App\Model\MessageUnopen;
use App\Model\UserToAuthority;
use App\Model\MyUser;
use App\Model\Pref;

class MyFunctions
{
    public static $wdays = [
        0 => '日',
        1 => '月',
        2 => '火',
        3 => '水',
        4 => '木',
        5 => '金',
        6 => '土',
    ];

    public static function getRootPath(){
        return dirname(dirname(dirname(dirname(__DIR__))));
    }

    // 配列の最初のキーを取得する
    public static function getFirstKey($ary){
        if(!empty($ary)){
            foreach($ary as $k => $v){
                return $k;
                break;
            }
        }
    }

    // ユーザーの氏名
    public static function getUserName($user_id=NULL){
        $data = MyUser::where('user_id', $user_id)->first();

        if($data){
            return $data->sei.$data->mei;
        }else{
            return "該当者なし";
        }
    }

    // 未読メッセージ数を取得
    public static function getUnreadMessageCount($user_id=NULL){
        return MessageUnopen::getUnreadMessageCount($user_id);
    }

    public static function getS3URL(){
        $http = env('S3_SSL', 'http');
        $bucket = env('S3_BUCKET');

        return $http.'://'.$bucket;
    }

    // 自分のアイコン画像パス
    public static function myIcon(){
        if(\Auth::user()->icon_filepath){
            $img = env('IMG').\Auth::user()->icon_filepath;
        }else{
            $img = \Func::getS3URL().'/img/common/no-image.png';
        }

        return $img;
    }

    // DBの画像パス
    public static function getImage($icon_filepath, $size=NULL){
        if($icon_filepath){
            $img = $icon_filepath;
            if($size){
                $img = str_replace('_sm', '_'.$size, $img);
            }
        }else{
            $img = \Func::getS3URL().'/img/common/no-image.png';
        }

        return $img;
    }
/*
    public static function getFilepathByOwnerId( $owner_id ){
        return MyUser::where('owner_id', $owner_id )->value('icon_filepath');
    }

    public static function getFilepathByCarrierId( $carrier_id ){
        return MyUser::where('carrier_id', $carrier_id )->value('icon_filepath');
    }
*/
    // 西暦を元号に
    public static function jpnYear($year){
        $jp = "";
        if($year >= 1989){
            $jp = '平成'.($year - 1989 + 1);
        }elseif($year >= 1926){
            $jp = '昭和'.($year - 1926 + 1);
        }elseif($year >= 1912){
            $jp = '大正'.($year - 1912 + 1);
        }elseif($year >= 1868){
            $jp = '明治'.($year - 1868 + 1);
        }

        return '／'.$jp;
    }

    public static function getUploadId(){
        return Upload::getNewId();
    }

    /**
     * @param string | Datetime Object
     * @param string
     * @return string
     */
    public static function dateFormat($datetime, $format=NULL){
        $result = "";
        if($datetime instanceof \Datetime || $datetime instanceof \DatetimeImmutable){
            $datetime_at = $datetime;
        }elseif(preg_match('/^[0-9]{4}-[0-9]{1, 2}-[0-9]{1, 2}[.]+/', $datetime)){
            $datetime_at = new \Datetime($datetime);
        }

        if(isset($datetime_at)){
            if($format){
                if(preg_match('/\(wday\)/', $format)){
                    $result = $datetime_at->format( str_replace('(wday)', '', $format) );
                    $result .= '（'.\Func::$wdays[ $datetime_at->format('w') ].'）';
                }else{
                    $result = $datetime_at->format($format);
                }
            }else{
                $result = $datetime_at->format('Y/n/j');
            }
        }

        return $result;
    }

    public static function isTelNo($string){
        return preg_match('/[0-9]{2,4}\-[0-9]{2,4}\-[0-9]{2,4}/', $string);
    }

    public static function telFormat($ary=[]){
        $tel = NULL;
        if( $ary[1] && $ary[2] && $ary[3] ){
            $tel = implode('-', $ary);
        }

        return $tel;
    }

    public static function telFormatDecode($string=""){
        if( \Func::isTelNo($string) ){
            $ary = explode('-', $string);
            $data = [
                1 => $ary[0],
                2 => $ary[1],
                3 => $ary[2],
            ];
        }else{
            $data = [
                1 => "",
                2 => "",
                3 => "",
            ];
        }

        return $data;
    }

    public static function numberFormatDecode($formated_number=0){
        return str_replace(',', '', $formated_number?: 0);
    }

    public static function getWeekDay($datetime){
        $result = "";
        if($datetime instanceof \Datetime){
            $result = $datetime->format('w');
        }elseif(preg_match('/^[0-9]{4}-[0-9]{1, 2}-[0-9]{1, 2}[.]+/', $datetime)){
            $datetime_at = new \Datetime($datetime);
            $result = $datetime_at->format('w');
        }

        return \Func::$wdays[$result];
    }

    /**
     * 指定された文字列で指定された長さの乱数を返す
     *
     * @param Strings EX) Aa
     * @param Integer
     * @param Integer
     * @return Strings
     */
    public static function getRandStr($char="Aa0", $len=0, $count=1){
        $alphabet_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphabet_lower = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $chars = "";
        $limits = "";
        if(strpos($char, "0") !== false){
            $chars .= $limits = $numbers;
        }
        if(strpos($char, "a") !== false){
            $chars .= $limits = $alphabet_lower;
        }
        if(strpos($char, "A") !== false){
            $chars .= $limits = $alphabet_upper;
        }
        // $count数繰り返す
        $strs = array();
        for($i=0; $i<$count; $i++){
            $str = "";
            $len = ($len)?: rand(16, 24);
            // 1文字目は限定させる
            $pos = rand(0, (strlen($limits)-1) );
            $str = $limits{$pos};
            // 2文字目以降
            for($j=1; $j<$len; $j++){
                $pos = rand(0, strlen($chars)-1 );
                $str .= $chars{$pos};
            }
            $strs[] = $str;
        }
        if($count == 1){
            return $strs[0];
        }else{
            return $strs;
        }
    }

    // var_dump
    public static function var_dump($data, $dev=NULL){
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    // 配列から最初に値にマッチしたものを削除
    public static function my_unset($needle, $ary){
        $key = array_search($needle, $ary);
        if($key !== false){
            if(isset($ary[$key])){
                unset($ary[$key]);
            }
        }

        return $ary;
    }

    public static function rmBR($str){
        return str_replace( array("<br />", "<br>"), "", $str);
    }

    public static function N2BR($str){
        return str_replace( array("\n", "\r\n"), "<br>", $str);
    }


    // CSVファイルをオブジェクトの配列に変換
    public static function CSV_to_Arrays($file_path){
        $csv_data = file_get_contents($file_path);
        $csv_datas = explode("\r\n", $csv_data);

        $keys_str = $csv_datas[0];
        $keys = explode(",", str_replace("\"", "", $keys_str));

        $datas = array();
        for($i=1; $i<count($csv_datas); $i++){
            $a_ary = explode(",", str_replace("\"", "", $csv_datas[$i]));
            if($a_ary[0]){
                $data = array();
                foreach($a_ary as $k => $v){
                    $data[$keys[$k]] = $v;
                }
                $datas[] = $data;
            }
        }

        return $datas;
    }

    public static function freeTextToAry($text){
        $text = str_replace("　", " ", $text);
        if(preg_match('/ /', $text)){
            $ary = explode(" ", $text);
            $words = [];
            foreach($ary as $v){
                if($v && count($words) < 3){
                    $words[] = $v;
                }
            }
        }elseif(strlen($text) > 0){
            $words = [$text];
        }else{
            $words = NULL;
        }

        return $words;
    }

    /**
     * @param string
     * @return ary | NULL
     */
    public static function dateStrToObj($str){
        if(preg_match('/\d{4}\/\d{1,2}\/\d{1,2}/', $str)){
            $ary = explode("/", $str);
            $data = [
                'year' => $ary[0],
                'month' => $ary[1],
                'day' => $ary[2],
                ];

            return $data;
        }else{

            return NULL;
        }
    }

    // 連想配列やオブジェクトを配列にする（キーは保存されない）
    public static function arrayAlignment($datas, $start=0){
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                $ary[ $start ] = $data;
                $start++;
            }
        }

        return $ary;
    }

    // scandir() 改造版
    public static function scanDir($dir){
        if(!$dir){
            return false;
        }else{
            $datas = array();
            $list = scandir($dir);
            if(!empty($list)){
                foreach($list as $v){
                    if(!preg_match("/^\.+$/", $v)){
                        $datas[] = $v;
                    }
                }
            }
            return $datas;
        }
    }

    // scandir() 改造版 - ディレクトリ対応版
    public static function scanDirs($dir){
        if(!$dir){
            return false;
        }else{
            $datas = array();
            if(file_exists($dir)){
                $lists = \Func::scanDir($dir);
                if(!empty($lists)){
                    foreach($lists as $i => $list){
                        $data = new \stdClass();
                        if( is_dir($dir."/".$list) ){
                            $data->name = $list;
                            $data->type = "dir";
                            $data->list = \Func::scanDirs($dir."/".$list);
                        }else{
                            $data->name = $list;
                            $data->type = "file";
                        }
                        $datas[$i] = $data;
                    }
                }
            }
            return $datas;
        }
    }

    // フォルダごとすべて削除
    public static function rmDirs($dir){
        $dir = (preg_match("/(.*)\/$/", $dir))? substr($dir, 0, strlen($dir)-1): $dir;
        if(file_exists($dir)){
            if ($handle = opendir($dir)) {
                while (false !== ($item = readdir($handle))) {
                    if ($item != "." && $item != "..") {
                        if (is_dir($dir.'/'.$item)) {
                            \Func::rmDirs($dir.'/'.$item);
                        } else {
                            unlink($dir.'/'.$item);
                        }
                    }
                }
                closedir($handle);
                rmdir($dir);
            }
        }else{
            echo 'No such file or directory - '.$dir.' !';
            exit;
        }
    }

    // ファイル名から拡張子を小文字で取得
    public static function getExtension($filename){
        $ext = "";
        if(strpos($filename, '.') !== FALSE){
            $arr = explode('.', $filename);
            $ext = strtolower( end($arr) );
        }

        return $ext;
    }

    /**
     * @param array (year: Y, month: n, day: j)
     * @param string
     * @return string
     */
    public static function getNewDatetime($dates, $format=('Y-m-d H:i:s')){
        if( isset($dates['year']) && isset($dates['month']) && isset($dates['day']) ){
//        if( $dates['year'] && $dates['month'] && $dates['day'] ){
            $date = new \Datetime( $dates['year'].'-'.$dates['month'].'-'.$dates['day'] );
            $date_at = $date->format($format);
        }else{
            $date_at = NULL;
        }

        return $date_at;
    }

    // 連想配列に配列を追加する
    public static function array_append(&$bases, $adds, $pre=null){
        if($pre){
            // 先頭に追加
            $bases = array_merge($adds, $bases);
        }else{
            // 末尾に追加
            $bases = array_merge($bases, $adds);
        }
    }

    public static function stringToAnchor($str){
        $body = $str;
        $matches = \Func::getURL($str);
        if(!empty($matches[0])){
            foreach($matches[0] as $url){
                $replace = '<a href="'.$url.'" target="_blank">'.$url.'</a>';
                $body = str_replace($url, $replace, $body);
            }
        }

        return $body;
    }

    public static function getURL($str){
        $pattern = 'https?\:\/\/[\w\/\:%#\$&\?\(\)~\.=\+\-]+';
        if(preg_match_all('/'.$pattern.'/', $str, $matches)){
            return $matches;
        }
    }

    // range オリジナル（連想配列）
    public static function range($start, $end, $step=1){
        $ary = [];
        $range = range($start, $end, $step);
        if(!empty($range)){
            foreach($range as $n){
                $ary[$n] = $n;
            }
        }

        return $ary;
    }

    public static function isDeveloper($user_id=null){
        $user_id = $user_id?: \Auth::user()->user_id;
        $authorities = UserToAuthority::getAuthorityIds($user_id);

        return in_array('9999', $authorities);
    }

    public static function isManager($user_id=null){
        $user_id = $user_id?: \Auth::user()->user_id;
        $authorities = UserToAuthority::getAuthorityIds($user_id);

        return in_array('99', $authorities);
    }

    public static function isCarrier($user_id=null){
        return \Auth::user()->carrier_id !== NULL;
    }

    public static function isOwner($user_id=null){
        return \Auth::user()->owner_id !== NULL;
    }
/*
    public static function isViewer($user_id=null){
        $user_id = $user_id?: \Auth::user()->user_id;
        $authorities = UserToAuthority::getAuthorityIds($user_id);

        return in_array('AT01', $authorities);
    }
*/
    public static function getStaff($user_id){
        $data = MyUser::where('user_id', $user_id)->first();

        return $data;
    }


    public static function myFilePutContents($content, $fullpath=NULL, $flag_add=true){
        $fullpath = $fullpath?: '/usr/home/ae159j6q55/html/mylogs/log';
        $content = date('Y-m-d H:i:s')."\n".$content."\n";
        if($flag_add){
            if(file_exists($fullpath)){
                // ファイルポインタをオープン
                $handle = fopen($fullpath, "r");
                // ファイル内容を取得
                $body = "";
                while ($line = fgets($handle)) {
                  $body .= $line;
                }
                $content = $body.$content;
                // ファイルポインタをクローズ
                fclose($handle);
            }
        }

        // ファイルポインタをオープン
        $handle = fopen($fullpath, "w");
        // ファイルへ書き込み
        fwrite($handle, $content);
        // ファイルポインタをクローズ
        fclose($handle);
    }

    public static function var_var_dump($data) {
        // 出力バッファリング開始
        ob_start();
        var_dump($data);
        // バッファの内容を変数へ格納
        $var = ob_get_contents();
        // 出力バッファを消去してバッファリング終了
        ob_end_clean();

        return $var;
    }

    // 本文抜粋
    public static function getExcerpt($str, $length=44){
        $str = str_replace("\n", "", $str);
        if(mb_strlen($str) > $length){
            $body = mb_substr($str, 0, $length).' ...（残 '.( mb_strlen($str) - $length ).'字）';
        }elseif($str){
            $body = $str;
        }else{
            $body = '-';
        }

        return $body;
    }


    // 年の配列を取得
    /**
     * @param integer
     * @param integer
     * @param string
     * @return ary
     */
    public static function getYearsAry($start=NULL, $finish=NULL, $orderby='DESC'){
        $ary = [];
        if($start === NULL){
            $start = date('Y');
        }
        if($orderby == 'DESC'){
            for($i=$finish; $i>=$start; $i--){
                if($i >= 0){
                    $ary[] = $i;
                }
            }
        }elseif($orderby == 'ASC'){
            for($i=$start; $i<=$finish; $i++){
                $ary[] = $i;
            }
        }

        return $ary;
    }

    /**
     * @param invert
     * date1 が大きい場合: 1
     * date2 が大きい場合: 0
     * date1 と date2 が等しい場合：0
     */
    public static function isOver( \Datetime $date2){
        $date1 = new \Datetime();

        return $date2->diff($date1)->invert? false: true;
     }

     public static function getZipCode($data){
        if( isset($data->zip1) && isset($data->zip2) ){

            return $data->zip1.'-'.$data->zip2;
        }
     }

     public static function getAddress($data, $views=['pref', 'city', 'address']){
        $str = "";
        $bodies = [];
        if( in_array('zip', $views) ){
            if( isset($data->zip1) && isset($data->zip2) ){
                $bodies[] = '〒 '.$data->zip1.' - '.$data->zip2;
            }
        }
        if( in_array('pref', $views) ){
            if( isset($data->pref_code) ){
                $pref = Pref::getData( $data->pref_code );
                $bodies[] = $pref->name;
            }
        }
        if( in_array('city', $views) ){
            if( isset($data->city) ){
                $bodies[] = $data->city;
            }
        }
        if( in_array('address', $views) ){
            if( isset($data->address) ){
                $bodies[] = $data->address;
            }
        }

        if(!empty($bodies)){
            $str = implode('', $bodies);
        }

        return $str;
     }

     public static function getPrefNames(){
        return Pref::getNames();
     }

     public static function isValidated( $errors ){
        \Func::var_dump( $errors );exit;
     }

     public static function isBacked(){
        \Func::var_dump( $_SERVER );exit;
     }


}
