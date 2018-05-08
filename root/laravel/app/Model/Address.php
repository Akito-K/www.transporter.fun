<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\UserToAddress;

class Address extends Model
{
    use softDeletes;
    protected $table = 'addresses';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'ADR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getDatas($user_id){
        $ary = [];
        $datas = UserToAddress::where('user_to_addresses.user_id', $user_id)
                                ->join('addresses', 'user_to_addresses.address_id', '=', 'addresses.address_id')
                                ->select('addresses.*')
                                ->get();

        if(!empty($datas)){
            foreach($datas as $k => $data){
                $data->tels = \Func::telFormatDecode($data->tel);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getNames($user_id){
        $datas = UserToAddress::where('user_to_addresses.user_id', $user_id)
                                ->join('addresses', 'user_to_addresses.address_id', '=', 'addresses.address_id')
                                ->select('addresses.*')
                                ->pluck('addresses.name', 'addresses.address_id')
                                ->toArray();

        return $datas;
    }

    public static function getData($unique_id){
        $data = Address::where('address_id', $unique_id)->first();

        if(!$data){
            $data = new \stdClass();
            $data->id = NULL;
            $data->name = NULL;
            $data->sei = NULL;
            $data->mei = NULL;
            $data->pref_code = NULL;
            $data->city = NULL;
            $data->address = NULL;
            $data->zip1 = NULL;
            $data->zip2 = NULL;
            $data->tel = NULL;
            $data->tels = [ 1 => '', 2 => '', 3 => '' ];
        }else{
            $data->tels = \Func::telFormatDecode($data->tel);
        }

        return $data;
    }

}
