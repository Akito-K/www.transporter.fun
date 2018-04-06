<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserToAuthority extends Model
{
    use softDeletes;
    protected $table = 'user_to_authorities';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
/*
    public static function getDatas($unique_id){
        $datas = UserToAuthority::where('user_id', $unique_id)->get();

        return $datas;
    }
*/
    public static function getAuthorityIds($user_id){

        return UserToAuthority::where('user_id', $user_id)->pluck('authority_id')->toArray();
    }

    public static function getAsignedCount($authority_id){
        $count = UserToAuthority::where('authority_id', $authority_id)->count();

        return $count;
    }

    public static function updateDatas($request, $user_id){
        $now_at = new \Datetime();

        UserToAuthority::deleteData($user_id);
        if(!empty($request['authorities'])){
            foreach($request['authorities'] as $authority){
                UserToAuthority::create([
                    'user_id' => $user_id,
                    'authority_id' => $authority,
                    'created_at' => $now_at,
                    ]);
            }
        }
    }

    public static function deleteData($user_id){
        UserToAuthority::where('user_id', $user_id)->delete();
    }

}
