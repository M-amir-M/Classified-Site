<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

//    protected $redirectTo = '/';

    public function __construct()
    {
        parent::__construct();

        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
//        $this->middleware('MustBeConfirmed', ['only' => 'login']);
    }


    protected function authenticated($request, $user)
    {
        if($user->role == 'admin') {
            return redirect()->intended('/dashboard');
        }

        return redirect()->intended('/banners/mybanners');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:15|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'verified' => true,
        ]);
    }

    public function confirmEmail($token)
    {
        $user = User::whereToken($token)->firstOrFail();
        $user->verified = true;
        $user->token = NULL;
        $user->save();

        flash()->success('تبریک میگیم!', 'ایمیل شما با موفقیت تایید شد و می توانید وارد حساب خود شوید.');
        return redirect()->route('banners.mybanners');
    }
}
