<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\MyUser;

class AdminAuth
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
        $me = MyUser::getMe();
        if( !in_array(99, $me->authorities) ){
            return redirect('/mypage')
                            ->withInput()
                            ->withErrors(['ID' => '権限がありません']);
            exit;
        }

        return $next($request);
    }
}
