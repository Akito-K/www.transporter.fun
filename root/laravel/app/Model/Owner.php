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

    public static function getOwner($owner_id){
        $data = Owner::getData($owner_id);
        if($data){
            $data->tels = \Func::telFormatDecode($data->tel);
        }

        return $data;
    }

    public static function updateData($owner_id, $request_data){
        $data = Owner::getData($owner_id);
        $data->sei = $request_data['sei'];
        $data->mei = $request_data['mei'];
        $data->zip1 = $request_data['zip1'];
        $data->zip2 = $request_data['zip2'];
        $data->pref_id = $request_data['pref_id'];
        $data->city = $request_data['city'];
        $data->address = $request_data['address'];
        $data->tel = \Func::telFormat( $request_data['tels'] );
        $data->site_url = $request_data['site_url'];
        $data->message = $request_data['message'];
        $data->save();
    }

}
