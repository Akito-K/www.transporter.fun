<?php

namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\Pagemeta;
use App\Model\Pref;
use App\Model\Log;
use App\Model\Owner;
use App\Model\Carrier;

use App\Mail\MailAuthorization;
use Illuminate\Support\Facades\Mail;

class startController extends mypageController
{

    public function createOwner(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-STO-01');
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        if( $request->session()->has('start.'.$me->hashed_id) ) {
            $data = $request->session()->get('start.'.$me->hashed_id);
        }else{
            $data = $this->makeEmptyData();
        }
        Log::saveData( 'mypage\startController@createOwner', 'user_id', $me->user_id, true );

        return view('mypage.start.owner.create', compact('pagemeta', 'me', 'prefs', 'data'));
    }

    public function confirmOwner(Request $request){
        // Validation
        $this->validateInsert($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-STO-02');

        $user = MyUser::getUser($me->hashed_id);
        $prefs = pref::getNames();

        $data = $this->makeData( $request, $user );
        $request->session()->forget('start.'.$me->hashed_id);
        $request->session()->put('start.'.$me->hashed_id, $data);

        Log::saveData( 'mypage\startController@confirmOwner', 'user_id', $me->user_id, true );

        return view('mypage.start.owner.confirm', compact('pagemeta', 'data', 'user', 'prefs'));
    }

    public function executeOwner(Request $request){
        $me = $request['me'];
        $user = MyUser::getData($me->hashed_id);

        $data = $request->session()->get('start.'.$me->hashed_id);
        $request->session()->forget('start.'.$me->hashed_id);
        unset($data['tels']);
        unset($data['sei']);
        unset($data['mei']);
        $date_at = new \DatetimeImmutable();

        // 荷主情報登録
        $data['owner_id'] = Owner::getNewId();
        $data['created_at'] = $date_at;
        $data['updated_at'] = $date_at;
        Owner::insert($data);

        // ユーザー情報更新
        $user_data = [
            'owner_id' => $data['owner_id'],
            'updated_at' => $date_at,
        ];
        MyUser::where('hashed_id', $me->hashed_id)->update($user_data);

        Log::saveData( 'mypage\startController@executeOwner', 'user_id', $me->user_id, true );

        return redirect('owner');
    }


    public function makeData($request, $user){
        return [
            'company' => $request['company'],
            'section' => $request['section'],
            'role' => $request['role'],
            'sei' => $user->sei,
            'mei' => $user->mei,
            'zip1' => $request['zip1'],
            'zip2' => $request['zip2'],
            'pref_code' => $request['pref_code'],
            'city' => $request['city'],
            'address' => $request['address'],
            'tel' => \Func::telFormat( $request['tels'] ),
            'tels' => [
                1 => $request['tels'][1],
                2 => $request['tels'][2],
                3 => $request['tels'][3],
            ],
        ];
    }

    public function makeEmptyData(){
        return [
            'company' => '',
            'section' => '',
            'role' => '',
            'sei' => '',
            'mei' => '',
            'zip1' => '',
            'zip2' => '',
            'pref_code' => '',
            'city' => '',
            'address' => '',
            'tel' => '',
            'tels' => [
                1 => '',
                2 => '',
                3 => '',
            ],
        ];
    }

    public function validateInsert($request){
        $validates = [
            'zip1' => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'zip_code' => 'requires|numeric',
            'city' => 'required',
            'address' => 'required',
            'tels.*' => 'required',
            ];

        $this->validate($request, $validates);
    }


    public function createCarrier(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-STC-01');
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        if( $request->session()->has('start.'.$me->hashed_id) ) {
            $data = $request->session()->get('start.'.$me->hashed_id);
        }else{
            $data = $this->makeEmptyData();
        }
        Log::saveData( 'mypage\startController@createCarrier', 'user_id', $me->user_id, true );

        return view('mypage.start.carrier.create', compact('pagemeta', 'me', 'prefs', 'data'));
    }

    public function confirmCarrier(Request $request){
        // Validation
        $this->validateInsert($request);

        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-STC-02');

        $user = MyUser::getUser($me->hashed_id);
        $prefs = pref::getNames();

        $data = $this->makeData( $request, $user );
        $request->session()->forget('start.'.$me->hashed_id);
        $request->session()->put('start.'.$me->hashed_id, $data);

        Log::saveData( 'mypage\startController@confirmCarrier', 'user_id', $me->user_id, true );

        return view('mypage.start.carrier.confirm', compact('pagemeta', 'data', 'user', 'prefs'));
    }

    public function executeCarrier(Request $request){
        $me = $request['me'];
        $user = MyUser::getData($me->hashed_id);

        $data = $request->session()->get('start.'.$me->hashed_id);
        $request->session()->forget('start.'.$me->hashed_id);
        unset($data['tels']);
        unset($data['sei']);
        unset($data['mei']);
        $date_at = new \DatetimeImmutable();

        // 荷主情報登録
        $data['carrier_id'] = Carrier::getNewId();
        $data['created_at'] = $date_at;
        $data['updated_at'] = $date_at;
        Carrier::insert($data);

        // ユーザー情報更新
        $user_data = [
            'carrier_id' => $data['carrier_id'],
            'updated_at' => $date_at,
        ];
        MyUser::where('hashed_id', $me->hashed_id)->update($user_data);

        Log::saveData( 'mypage\startController@executeCarrier', 'user_id', $me->user_id, true );

        return redirect('carrier');
    }


/*
    public function email(Request $request){
        $me = $request['me'];

        $pagemeta = Pagemeta::getPagemeta('MY-USR-04');
        $data = MyUser::getUser($me->hashed_id);
        Log::saveData( 'mypage\accountController@email', 'user_id', $data->user_id, true);

        return view('mypage.account.email', compact('pagemeta', 'data', 'me'));
    }

    public function sendAuthorizationMail(Request $request){
        $date_at = new \DatetimeImmutable();
        $me = $request['me'];

        // Authorization に登録
        $code = Authorization::getNewCode();
        $data = [
            'user_id' => $me->user_id,
            'code' => $code,
            'new_email' => $request['email'],
            'limit_at' => $date_at->modify('+'.env('AUTHORIZATION_LIMIT_HOURS', 24).' hours'),
            'created_at' => $date_at,
            'updated_at' => $date_at,
        ];
        Authorization::insert($data);

        // code を mailbody に渡して認証メール送信
        Mail::to( $request['email'] )
            ->send(new MailAuthorization($code));

        $pagemeta = Pagemeta::getPagemeta('MY-USR-04');

        return view('mypage.account.sent_email', compact('pagemeta'));
    }
*/
}