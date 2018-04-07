<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\SignupKey;
use App\Model\MyUser;
use App\Model\Log;

use App\Mail\MailSignup;
use Illuminate\Support\Facades\Mail;

class signupController extends Controller
{
    public function email(Request $request){
        //Log::saveData( 'common\signupController@email', NULL, NULL, true);

        return view('common.signup.email');
    }

    public function sendSignupMail(Request $request){
        $date_at = new \DatetimeImmutable();

        // SignupKey に登録
        $key = SignupKey::getNewKey();
        $data = [
            'email' => $request['email'],
            'key' => $key,
            'limit_at' => $date_at->modify('+'.env('AUTHORIZATION_LIMIT_HOURS', 24).' hours'),
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        SignupKey::insert($data);

        // code を mailbody に渡して認証メール送信
        Mail::to( $request['email'] )
            ->send(new MailSignup($key));

        return view('common.signup.sent_email');
    }

    public function create1($signup_key)
    {
        $signup = SignupKey::getData($signup_key);
        if( $signup ){
            if( !\Func::isOver($signup->limit_at) ){
                $email = $signup->email;

                return view('common.signup.create1', compact('signup_key', 'email'));
            }else{
                $signup->delete();

                return view('mypage.account.limit_over');
            }
        }else{

            return view('mypage.account.limit_over');
        }
    }

    public function create2($signup_key, Request $request)
    {
        $validates = [
            'name' => 'required|max:20',
            'login_id' => 'required|min:4|max:32|unique:users',
            'password' => 'required|min:8|max:32',
            ];
        $this->validate($request, $validates);

        $signup = SignupKey::getData($signup_key);
        $user_id = MyUser::getNewId();
        $hashed_id = sha1( $user_id );
        $date_at = new \DatetimeImmutable();
        $data = [
            'user_id' => $user_id,
            'hashed_id' => $hashed_id,
            'name' => $request['name'],
            'login_id' => $request['login_id'],
            'password' => $request['password'],
            'email' => $signup->email,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        MyUser::insert($data);


        return view('common.signup.create2', compact('hashed_id'));
    }

    public function complete(Request $request){
        $validates = [
            'zip_code' => 'required|max:8',
            'pref_code' => 'required|max:2',
            'city' => 'required',
            'sei' => 'required|max:20',
            'mei' => 'required|max:20',
            ];
        $this->validate($request, $validates);

        $date_at = new \DatetimeImmutable();
        $data = MyUser::getData($request['hashed_id']);
        $data->zip_code = $request['zip_code'];
        $data->pref_code = $request['pref_code'];
        $data->city = $request['city'];
        $data->address = $request['address'];
        $data->sei = $request['sei'];
        $data->mei = $request['mei'];
        $data->updated_at = $date_at;
        $data->save();

        \Auth::login($data);

        return redirect('/mypage');
    }



}
