<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserToAddress extends Model
{
    use softDeletes;
    protected $table = 'user_to_addresses';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getDatas($unique_id){
        $datas = UserToAddress::where('user_id', $unique_id)->get();

        return $datas;
    }

}
