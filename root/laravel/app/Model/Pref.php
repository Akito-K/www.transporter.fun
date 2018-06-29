<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pref extends Model
{
    protected $table = 'prefs';
    protected $dates = ['created_at'];
    protected $guarded = ['id'];

    public static function getDatas(){
        $datas = Pref::get();

        return $datas;
    }

    public static function getData($pref_id){
        $data = Pref::where('pref_id', $pref_id)->first();

        return $data;
    }

    public static function getNames(){
        $ary = Pref::pluck('name', 'pref_id')->toArray();
        \Func::array_append($ary, [ 0 => '---' ], true);

        return $ary;
    }

    public static function toMatchedId($key){
        $prefs = Pref::getNames();
        $pref_id = '';
        foreach($prefs as $id => $name){
            if(preg_match('/'.$key.'/', $name)){
                $pref_id = $id;
                break;
            }
        }

        return $pref_id;
    }

}
