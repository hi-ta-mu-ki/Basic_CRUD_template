<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Auth_member
{
    private $auth;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #ユーザーがログインしていない場合は、ログイン画面へリダイレクト
        if( empty( auth()->user() ) ){
            return redirect('db_sample/login');
        }

        //ユーザーの権限チェック
        if (auth()->user()->role == 10) {
            $this->auth = true;
        } else {
            $this->auth = false;
        }

        //ユーザーの権限がOKの場合は、アクセスを許可。
        if ($this->auth === true) {
            return $next($request);
        }

        //それ以外はログイン画面にリダイレクト
        return redirect('db_sample/login')->with('error', '権限がありません');
    }

}