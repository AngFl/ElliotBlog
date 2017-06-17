<?php

namespace App\Http\Middleware;

use Closure;

class SignEmailMiddleware
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
        /**
         *  根据Session当中存在的邮箱来验证
         */
        if(is_null(\Session::get('user_email'))){
            return redirect('/user/login');
        }
        return $next($request);
    }
}
