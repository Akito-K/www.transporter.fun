<?php

namespace App\Http\Controllers\mypage;
use App\Http\Controllers\mypageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Model\MyUser;
use App\Model\UserToAuthority;
use App\Model\Authority;
use App\Model\Pagemeta;
use App\Model\Pref;
use App\Model\Log;
use App\Model\Upload;
use App\Model\S3;

use App\Model\Authorization;
use App\Mail\MailAuthorization;
use Illuminate\Support\Facades\Mail;

class accountController extends mypageController
{

    public function showDetail(Request $request){
        $me = $request['me'];
        $pagemeta = Pagemeta::getPagemeta('MY-USR-01');
        $data = MyUser::getUser($me->hashed_id);
        $prefs = pref::getNames();
        Log::saveData( __METHOD__ , 'user_id', $data->user_id, true );

        return view('mypage.account.detail', compact('pagemeta', 'data', 'me', 'prefs'));
    }

    public function edit(Request $request){
        $me = $request['me'];

        $pagemeta = Pagemeta::getPagemeta('MY-USR-02');
        $data = MyUser::getUser($me->hashed_id);
        $prefs = pref::getNames();
        \Func::array_append($prefs, [ 0 => '---' ], true);
        Log::saveData( __METHOD__ , 'user_id', $data->user_id, true);

        return view('mypage.account.edit', compact('pagemeta', 'data', 'me', 'prefs'));
    }

    public function update(Request $request){
        $me = $request['me'];
        $user = MyUser::getData($me->hashed_id);

        // Validation
        $this->validateUpdate($request, $user);

        // 画像保存
        if($request['upload_id']){
            $upload = Upload::getData($request['upload_id']);
            $s3 = new S3();
            $icon_filepath = Upload::saveResizedImages($upload, $s3, 'md');
            $http = env('S3_SSL', 'http');
            $request['icon_filepath'] = $http.'://'.$s3->getBucket().'/'.$icon_filepath;
        }
        $request['hashed_id'] = $me->hashed_id;

        // ユーザー情報更新
        MyUser::updateData($request, ['email']);

        Log::saveData( __METHOD__ , 'user_id', $user->user_id, true );

        return redirect('mypage/account');
    }

    public function email(Request $request){
        $me = $request['me'];

        $pagemeta = Pagemeta::getPagemeta('MY-USR-04');
        $data = MyUser::getUser($me->hashed_id);
        Log::saveData( __METHOD__ , 'user_id', $data->user_id, true);

        return view('mypage.account.email', compact('pagemeta', 'data', 'me'));
    }

    public function validateUpdate($request, $user){
        $validates = [
            'name' => 'required|max:20',
            'sei' => 'required|max:20',
            'mei' => 'required|max:20',
            'sei_kana' => 'required|max:20',
            'mei_kana' => 'required|max:20',
            ];

        if($request['login_id'] != $user->login_id){
            $validates['login_id'] = 'required|min:4|max:32|unique:users';
        }
        if($request['password']){
            $validates['password'] = 'required|min:8|max:32|confirmed';
        }

        $this->validate($request, $validates);
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

}
