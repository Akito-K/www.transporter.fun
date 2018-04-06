<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\UserToAuthority;

class Authority extends Model
{
    use softDeletes;
    protected $table = 'authorities';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas(){
        $datas = Authority::get();

        return $datas;
    }

    public static function getData($unique_id){
        $data = Authority::where('authority_id', $unique_id)->first();

        return $data;
    }

    public static function getNames(){
        return Authority::pluck('name', 'authority_id')->toArray();
    }

    public static function getAuthorities(){
        $ary = [];
        $datas = Authority::getDatas();
        if(!empty($datas)){
            foreach($datas as $data){
                $data->count = UserToAuthority::getAsignedCount($data->authority_id);
                $ary[] = $data;
            }
        }

        return $ary;
    }
}
