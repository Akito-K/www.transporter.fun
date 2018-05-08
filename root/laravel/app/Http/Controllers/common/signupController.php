<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Signup;
use App\Model\MyUser;
use App\Model\Address;
use App\Model\UserToAddress;
use App\Model\Log;
use App\Model\Pref;
use App\Model\Carrier;
use App\Model\Owner;

use App\Mail\MailSignup;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SignupEmailRequest;

class signupController extends Controller
{
    public function email(Request $request){
        $pagemeta = Pagemeta::getPagemeta('CM-SU-');
        //Log::saveData( 'common\signupController@email', NULL, NULL, true);

        return view('common.signup.email', compact('pagemeta'));
    }

    public function sendSignupMail(SignupEmailRequest $request){
        // validated by SignupEmailRequest
        $pagemeta = Pagemeta::getPagemeta('CM-SU-');
        $date_at = new \DatetimeImmutable();
        // Signup に登録
        $key = Signup::getNewKey();
        $data = [
            'email' => $request['email'],
            'key' => $key,
            'limit_at' => $date_at->modify('+'.env('AUTHORIZATION_LIMIT_HOURS', 24).' hours'),
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Signup::insert($data);

        // code を mailbody に渡して認証メール送信
        Mail::to( $request['email'] )
            ->send(new MailSignup($key));

        return view('common.signup.sent_email', compact('pagemeta'));
    }

    public function create($signup_key){
        $signup = Signup::getData($signup_key);
        if( $signup ){
            if( !\Func::isOver($signup->limit_at) ){
                $email = $signup->email;
                if( MyUser::where('email', $signup->email)->count() ){
                    $pagemeta = Pagemeta::getPagemeta('CM-SU-');
                    return view('common.signup.already_exists', compact('pagemeta'));
                }else{
                    $pagemeta = Pagemeta::getPagemeta('CM-SU-');
                    $data = Signup::getData($signup_key);
                    return view('common.signup.create', compact('signup_key', 'email', 'pagemeta', 'data'));
                }
            }else{
                $signup->delete();
                $pagemeta = Pagemeta::getPagemeta('CM-SU-');
                return view('mypage.account.limit_over', compact('pagemeta'));
            }
        }else{
            $pagemeta = Pagemeta::getPagemeta('CM-SU-');
            return view('mypage.account.limit_over', compact('pagemeta'));
        }
    }

    public function insert(Request $request){
        $validates = [
            'name' => 'required|max:20',
            'login_id' => 'required|min:4|max:32|unique:users',
            'password' => 'required|min:8|max:32',
            ];
        $this->validate($request, $validates);

        $signup_key = $request['signup_key'];
        $data = Signup::getData($signup_key);
        $date_at = new \DatetimeImmutable();
        $data->name        = $request['name'];
        $data->login_id    = $request['login_id'];
        $data->password    = bcrypt( $request['password'] );
        $data->updated_at  = $date_at;
        unset($data->mobiles);
        unset($data->tels);
        $data->save();

        return redirect('/signup/'.$signup_key.'/edit');
    }

    public function edit($signup_key, Request $request){
        $pagemeta = Pagemeta::getPagemeta('CM-SU-');
        $prefs = Pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        $data = Signup::getData($signup_key);

        return view('common.signup.edit', compact('signup_key', 'prefs', 'pagemeta', 'data'));
    }

    public function update(Request $request){
        $validates = [
            'zip1' => 'required|size:3',
            'zip2' => 'required|size:4',
            'pref_code' => 'required|size:2',
            'city' => 'required',
            'address' => 'required',
            'sei' => 'required|max:20',
            'mei' => 'required|max:20',
            ];
        $this->validate($request, $validates);

        $date_at = new \DatetimeImmutable();
//        $address_id = Address::getNewId();

        $data = Signup::getData($request['signup_key']);
        $data->sei = $request['sei'];
        $data->mei = $request['mei'];
        $data->sei_kana = $request['sei_kana'];
        $data->mei_kana = $request['mei_kana'];

        $data->zip1 = $request['zip1'];
        $data->zip2 = $request['zip2'];
        $data->pref_code = $request['pref_code'];
        $data->city = $request['city'];
        $data->address = $request['address'];

        $data->mobile = \Func::telFormat( $request['mobiles'] );
        $data->tel = \Func::telFormat( $request['tels'] );
        $data->flag_owner = $request['flag_owner']? true: false;
        $data->flag_carrier = $request['flag_carrier']? true: false;

        $data->updated_at = $date_at;
        unset($data->mobiles);
        unset($data->tels);

        $data->save();
/*
        $data = [
            'address_id' => $address_id,
            'name' => '登録住所',
            'sei' => $request['sei'],
            'mei' => $request['mei'],
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
            'tel' => \Func::telFormat( $request['tels'] ),
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Address::insert($data);
*/
        return redirect('/signup/'.$request['signup_key'].'/accept');
    }

    // 同意と Epsilon 関連
    public function accept( $signup_key, Request $request ){
        $pagemeta = Pagemeta::getPagemeta('CM-SU-');
        $data = Signup::getData($signup_key);
//        $address = Address::getData($data->address_id);
        $prefs = Pref::getNames();

        return view('common.signup.accept', compact('pagemeta', 'signup_key', 'data', 'prefs'));
    }

    // 同意後 運送会社登録ありならエプシロンへのリンク / 無しなら完了へリダイレクト
    public function accepted( $signup_key, Request $request ){
        $pagemeta = Pagemeta::getPagemeta('CM-SU-');
        $data = Signup::getData($signup_key);

        if($data->flag_carrier){
            // エプシロン与信登録開始ページへ
            return view('common.signup.to_epsilon', compact('pagemeta', 'signup_key', 'data'));
        }else{
            // 完了ページへ
            return redirect('/signup/'.$signup_key.'/complete');
        }
    }

    public function completeOwner( $signup_key, Request $request ){
        $signup = Signup::getData($signup_key);

        $user_id = MyUser::getNewId();
        $data = $this->makeUserData($user_id, $signup);
        MyUser::insert($data);

        $date_at = new \DatetimeImmutable();
        if($data['owner_id']){
            $owner = [
                'owner_id' => $data['owner_id'],
                'zip1' => $signup->zip1,
                'zip2' => $signup->zip2,
                'pref_code' => $signup->pref_code,
                'city' => $signup->city,
                'address' => $signup->address,
                'tel' => $signup->tel,
                'created_at' => $date_at,
                'updated_at' => $date_at,
            ];
            Owner::insert($owner);
        }

        if($data['carrier_id']){
            $carrier = [
                'carrier_id' => $data['carrier_id'],
                'zip1' => $signup->zip1,
                'zip2' => $signup->zip2,
                'pref_code' => $signup->pref_code,
                'city' => $signup->city,
                'address' => $signup->address,
                'tel' => $signup->tel,
                'created_at' => $date_at,
                'updated_at' => $date_at,
            ];
            Carrier::insert($carrier);
        }

/*
        $data = [
            'user_id' => $user_id,
            'role' => 'user',
            'address_id' => $signup->address_id,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        UserToAddress::insert($data);
*/
        $user = MyUser::getData( sha1($user_id) );
        \Auth::loginUsingId($user->id);

        $pagemeta = Pagemeta::getPagemeta('CM-SU-');
        return view('common.signup.complete', compact('pagemeta'));
/*
        if($signup->flag_owner && $signup->flag_carrier){
            return view('common.signup.complete_both', compact('pagemeta'));
        }elseif($signup->flag_carrier){
            return view('common.signup.complete_carrier', compact('pagemeta'));
        }else{
            return view('common.signup.complete_owner', compact('pagemeta'));
        }
*/
    }

    public function makeUserData($user_id, $signup){
        $hashed_id = sha1( $user_id );
        $date_at = new \DatetimeImmutable();
        $data = [
            'name' => $signup->name,
            'email' => $signup->email,
            'login_id' => $signup->login_id,
            'password' => $signup->password,
            'user_id' => $user_id,
            'hashed_id' => $hashed_id,
            'sei' => $signup->sei,
            'mei' => $signup->mei,
            'sei_kana' => $signup->sei_kana,
            'mei_kana' => $signup->mei_kana,

            'zip1' => $signup->zip1,
            'zip2' => $signup->zip2,
            'pref_code' => $signup->pref_code,
            'city' => $signup->city,
            'address' => $signup->address,

            'mobile' => $signup->mobile,
            'tel' => $signup->tel,
            'owner_id' => $signup->flag_owner? Owner::getNewId(): NULL,
            'carrier_id' => $signup->flag_carrier? Carrier::getNewId(): NULL,
            'last_logined_at' => $date_at,
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];

        return $data;
    }

}
