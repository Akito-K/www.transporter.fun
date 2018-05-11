<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\MyUser;

class Owner extends Model
{
    use softDeletes;
    protected $table = 'owners';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'OWN-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($unique_id){
        $data = Owner::where('owner_id', $unique_id)->first();

        return $data;
    }

    public static function getUser($owner_id){
        $data = MyUser::where('owner_id', $owner_id)->first();

        return $data;
    }


}
