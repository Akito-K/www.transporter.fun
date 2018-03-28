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

    public static function getDatas($unique_id){
        $datas = UserToAuthority::where('user_id', $unique_id)->get();

        return $datas;
    }

    public static function getAuthorityIds($user_id){

        return UserToAuthority::where('user_id', $user_id)->pluck('authority_id')->toArray();
    }

}
