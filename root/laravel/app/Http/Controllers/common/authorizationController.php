<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Authorization;
use App\Model\MyUser;
use App\Model\Log;

// use App\Mail\MailAuthorization;
// use Illuminate\Support\Facades\Mail;

class authorizationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function authorization($authorization_code){
        Log::saveData( __METHOD__ , 'authorization_code', $authorization_code, true);

        $authorization = Authorization::getData($authorization_code);
        if( $authorization ){
            if( !\Func::isOver($authorization->limit_at) ){
                $user = MyUser::getData( sha1($authorization->user_id) );
                $user->email = $authorization->new_email;
                $user->updated_at = new \Datetime();
                $user->save();
                $authorization->delete();

                $pagemeta = Pagemeta::getPagemeta('CM-AT-000');
                return view('mypage.account.changed_email', compact('pagemeta'));
            }else{
                $authorization->delete();

                $pagemeta = Pagemeta::getPagemeta('CM-AT-001');
                return view('mypage.account.limit_over', compact('pagemeta'));
            }
        }else{

            return view('mypage.account.limit_over');
        }

    }
}
