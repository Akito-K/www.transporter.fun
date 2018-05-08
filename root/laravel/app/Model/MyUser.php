<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\UserToAuthority;


class MyUser extends Model
{
    use SoftDeletes;
    protected $table = 'users';
    protected $dates = ['created_at', 'deleted_at', 'last_logined_at', 'banned_at'];
    protected $guarded = ['id'];
    protected $hidden =['password', 'remember_token'];


    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'USR-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getData($hashed_id){
        $data = MyUser::where('hashed_id', $hashed_id)->first();

        return $data;
    }

    public static function getUsers(){
        $datas = MyUser::get();
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $k => $data){
                $data->authorities = UserToAuthority::getAuthorityIds($data->user_id);
                $data->mobiles = \Func::telFormatDecode($data->mobile);
                $data->tels = \Func::telFormatDecode($data->tel);
                $ary[] = $data;
            }
        }

        return $ary;
    }

    public static function getUser($hashed_id){
        $data = MyUser::getData($hashed_id);
        if($data){
            $data->authorities = UserToAuthority::getAuthorityIds($data->user_id);
            $data->mobiles = \Func::telFormatDecode($data->mobile);
            $data->tels = \Func::telFormatDecode($data->tel);
        }

        return $data;
    }

    public static function getEdittableDatas(){
        $datas = MyUser::getUsers();
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if(in_array('AT02', $data->authorities->toArray())){
                    $ary[] = $data;
                }
            }
        }

        return $ary;
    }

    public static function getEdittableUsers(){
        $datas = MyUser::getUsers();
        $ary = [];
        if(!empty($datas)){
            foreach($datas as $data){
                if(in_array('AT02', $data->authorities->toArray())){
                    $ary[ $data->user_id ] = $data;
                }
            }
        }

        return $ary;
    }

    public static function insertData($request, $user_id){
        $now_at = new \Datetime();
        $datas = [
            'user_id' => $user_id,
            'hashed_id' => sha1($user_id),
            'login_id' => $request['login_id'],
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'sei_kana' => $request['sei_kana'],
            'mei_kana' => $request['mei_kana'],
            'email' => $request['email'],
/*
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
*/
            'mobile' => \Func::telFormat( $request['mobiles'] ),
            'tel' => \Func::telFormat( $request['tels'] ),
            'icon_filepath' => $request['icon_filepath'],
            'created_at' => $now_at,
            'updated_at' => $now_at,
            ];

        MyUser::create($datas);
    }

    /**
     * @param Request
     * @return
     */
    public static function updateData($request, $ignores=[]){
        $now_at = new \Datetime();
        $data = [
            'login_id' => $request['login_id'],
            'name' => $request['name'],
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'sei_kana' => $request['sei_kana'],
            'mei_kana' => $request['mei_kana'],
            'email' => $request['email'],

            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],

            'mobile' => \Func::telFormat( $request['mobiles'] ),
            'tel' => \Func::telFormat( $request['tels'] ),
            'icon_filepath' => $request['icon_filepath'],
            'updated_at' => $now_at,
            ];

        if(!empty($ignores)){
            foreach($ignores as $ignore){
                unset($data[$ignore]);
            }
        }

        MyUser::where('hashed_id', $request['hashed_id'])->update($data);
    }

    public static function deleteData($hashed_id){
        MyUser::where('hashed_id', $hashed_id)->delete();
    }

    public static function ban($hashed_id){
        $now_at = new \Datetime();
        $datas = [
            'banned_at' => $now_at,
            'updated_at' => $now_at,
            ];

        MyUser::where('hashed_id', $hashed_id)->update($datas);
    }
}
