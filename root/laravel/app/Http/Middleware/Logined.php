<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\MyUser;
use App\Model\UserToAuthority;
//use App\Model\MessageUnopened;

class Logined
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ログイン記録
        MyUser::where('hashed_id', \Auth::user()->hashed_id)->update([
            'last_logined_at' => new \Datetime(),
            ]);
/*
        $me = \Auth::user();
        // 権限
        $me->authorities = UserToAuthority::getAuthorityIds($me->user_id);

        // Request に混ぜて Controller へ送る
        $request->merge([
            'me' => $me,
        ]);
*/
/*
        // 未読メッセージを取得
        $unreads = MessageUnopened::getUnreads($user->user_id);
        // Request に混ぜて Controller へ送る
        $request->merge([
            'middleware_unreads' => $unreads,
        ]);
*/
        return $next($request);
    }
}
