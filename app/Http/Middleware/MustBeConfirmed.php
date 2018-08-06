<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class MustBeConfirmed
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
        $user = User::where(['verified' => 0 , 'email' => $request['email']])->exists();
        if ($user){
            flash('ابتدا حساب خود را فعال کنید.', 'برای شما ایمیلی فرستاده شده.ایمیل خود را چک کنید و حساب خود را فعال کنید.ممکن است ایمیل داخل پوشه هرزنامه(spam) شما ارسال شده باشد.');
            return back();
        }
        return $next($request);
    }
}
